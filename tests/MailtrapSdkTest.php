<?php

declare(strict_types = 1);

namespace Lampvlad\MailtrapSdk\Tests;

use PHPUnit\Framework\TestCase;
use Lampvlad\MailtrapSdk\MailtrapSdk;
use Lampvlad\MailtrapSdk\Mailables\Address;
use Lampvlad\MailtrapSdk\Mailables\Attachment;
use Lampvlad\MailtrapSdk\Mailables\HtmlString;

/**
 * Class MailtrapClientTest
 *
 * @package Tests
 */
class MailtrapSdkTest extends TestCase
{
    /**
     * @var string
     */
    protected const TEST_TOKEN = '123';

    /**
     * @var string
     */
    protected const TEST_ENDPOINT = 'https://stoplight.io/mocks/railsware/mailtrap-api-docs/93404133';

    /**
     * @var \Lampvlad\MailtrapSdk\MailtrapSdk
     */
    protected MailtrapSdk $client;

    /**
     * @var \Lampvlad\MailtrapSdk\Mailables\Address
     */
    protected Address $from;

    /**
     * @var \Lampvlad\MailtrapSdk\Mailables\Address[]
     */
    protected array $to;

    /**
     * @var string
     */
    protected string $subject;

    /**
     * This method is called before each test.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->client = new MailtrapSdk(self::TEST_TOKEN, self::TEST_ENDPOINT);

        $this->from = new Address('test@example.com', 'Lamp Vlad');
        $this->to = [new Address('test1@example.com'), new Address('test1@example.com', 'Vlad Lamp')];
        $this->subject = 'Test Subject';
    }

    /** @test */
    public function testBasicSend(): void
    {
        $text = 'This is a test message.';

        $response = $this->client->send($this->from, $this->to, $this->subject, $text);

        $this->assertTrue($response->success);
        $this->assertIsArray($response->message_ids);
    }

    /** @test */
    public function testSendWithHtml(): void
    {
        $html = new HtmlString("<p>Congratulations on your order no.</p>");

        $response = $this->client->send($this->from, $this->to, $this->subject, null, $html);

        $this->assertTrue($response->success);
        $this->assertIsArray($response->message_ids);
    }

    /** @test */
    public function testSendWithAttachments(): void
    {
        $text = 'This is a test message.';

        $attachments = [
            new Attachment(
                content: "PCFET0NUWVBFIGh0bWw+CjxodG1sIGxhbmc9ImVuIj4KCiAgICA8aGVhZD4KICAgICAgICA8bWV0YSBjaGFyc2V0PSJVVEYtOCI+CiAgICAgICAgPG1ldGEgaHR0cC1lcXVpdj0iWC1VQS1Db21wYXRpYmxlIiBjb250ZW50PSJJRT1lZGdlIj4KICAgICAgICA8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCI+CiAgICAgICAgPHRpdGxlPkRvY3VtZW50PC90aXRsZT4KICAgIDwvaGVhZD4KCiAgICA8Ym9keT4KCiAgICA8L2JvZHk+Cgo8L2h0bWw+Cg==",
                filename: "index.html",
                type: "text/html",
                disposition: "attachment"
            )
        ];

        $response = $this->client->send($this->from, $this->to, $this->subject, $text, null, $attachments);

        $this->assertTrue($response->success);
        $this->assertIsArray($response->message_ids);
    }
}
