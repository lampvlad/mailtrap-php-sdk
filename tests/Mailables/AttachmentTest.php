<?php

declare(strict_types=1);

namespace Lampvlad\MailtrapSdk\Tests\Mailables;

use Lampvlad\MailtrapSdk\Mailables\Attachment;

/** @package Lampvlad\MailtrapSdk\Tests\Mailables */
class AttachmentTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function testConstructor()
    {
        $attachment = new Attachment('base64encodedcontent', 'filename.pdf', 'text/plain', 'inline');
        $this->assertEquals('base64encodedcontent', $attachment->content);
        $this->assertEquals('filename.pdf', $attachment->filename);
        $this->assertEquals('text/plain', $attachment->type);
        $this->assertEquals('inline', $attachment->disposition);
    }
}
