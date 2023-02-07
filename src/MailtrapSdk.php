<?php

namespace Lampvlad\MailtrapSdk;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Lampvlad\MailtrapSdk\Mailables\Address;
use Lampvlad\MailtrapSdk\Mailables\HtmlString;
use GuzzleHttp\Utils;

/** @package Lampvlad\MailtrapSdk */
class MailtrapSdk
{
    /**
     * The default base URL.
     *
     * @var string
     */
    private const MAILTRAP_ENDPOINT = 'https://send.api.mailtrap.io';

    /**
     * The JSON content type identifier.
     *
     * @var string
     */
    private const JSON_CONTENT_TYPE = 'application/json';

    /**
     * The URI prefix.
     *
     * @var string
     */
    private const SEND_URI_PREFIX = '/api/send';

    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * @param string $token
     * @param string $endpoint
     * @param Client $httpClient
     * @return void
     */
    public function __construct(
        private string $token,
        private string $endpoint = self::MAILTRAP_ENDPOINT
    ) {
        $this->httpClient = new Client([
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $token),
                'Content-Type'  => self::JSON_CONTENT_TYPE,
            ],
        ]);
    }

    /**
     * Prepare the request URI.
     *
     * @param string $uri
     * @param array  $query
     *
     * @return string
     */
    private function prepareUri(string $uri = self::SEND_URI_PREFIX): string
    {
        return sprintf('%s%s', $this->endpoint, $uri);
    }

    /**
     * Send a new message.
     *
     * @param Address $from
     * @param Address[]   $to
     * @param string  $subject
     * @param string|null $text
     * @param HtmlString|null $html
     * @param Attachment[]|null $attachments
     *
     * @return array
     */
    public function send(
        Address|array $from,
        array $to,
        string $subject,
        ?string $text = null,
        ?HtmlString $html = null,
        ?array $attachments = null
    ) {
        $data = [
            'from' => (array) $from,
            'to' => array_map(fn ($address) => (array) $address, $to),
            'subject' => $subject,
        ];

        if (!is_null($text)) {
            $data['text'] = $text;
        }

        if (!is_null($html) && $html->isNotEmpty()) {
            $data['html'] = $html->toHtml();
        }

        if (is_null($text) && is_null($html)) {
            throw new \InvalidArgumentException('The text or html field is required.');
        }

        if (!is_null($attachments)) {
            $data['attachments'] = array_map(fn ($attachment) => (array) $attachment, $attachments);
        }

        $response = $this->httpClient
            ->post($this->prepareUri(), [
                'json' => $data,
            ])
            ->getBody()
            ->getContents();

        return Utils::jsonDecode($response);
    }
}
