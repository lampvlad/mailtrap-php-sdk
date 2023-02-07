<?php

namespace Lampvlad\MailtrapSdk\Mailables;

/** @package Lampvlad\MailtrapSdk\Mailables */
class Attachment
{
    /**
     * The Base64 encoded content of the attachment.
     *
     * @var string
     */
    public string $content;

    /**
     * The attachment's filename.
     *
     * @var string
     */
    public string $filename;

    /**
     * The MIME type of the content you are attaching (e.g., “text/plain” or “text/html”).
     *
     * @var string|null
     */
    public ?string $type;

    /**
     * The attachment's content-disposition, specifying how you would like the attachment to be displayed.
     * For example, “inline” results in the attached file are displayed automatically within the message
     * while “attachment” results in the attached file require some action to be taken before it is displayed, such as opening or downloading the file.
     * Allowed values:
     *   inline
     *   attachment
     *
     * @var string|null
     */
    public ?string $disposition;

    /**
     * Create a new address instance.
     *
     * @param  string  $content
     * @param  string|null  $filename
     * @return void
     */
    public function __construct(
        string $content,
        string $filename,
        ?string $type = null,
        ?string $disposition = null
    ) {
        $this->content = $content;
        $this->filename = $filename;

        if (!is_null($type)) {
            $this->type = $type;
        }

        if (!is_null($disposition)) {
            $this->disposition = $disposition;
        }
    }
}
