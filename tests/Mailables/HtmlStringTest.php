<?php

declare(strict_types = 1);

namespace Lampvlad\MailtrapSdk\Tests\Mailables;

use Lampvlad\MailtrapSdk\Mailables\HtmlString;

/** @package Lampvlad\MailtrapSdk\Tests\Mailables */
class HtmlStringTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function testConstructor()
    {
        $htmlstring = new HtmlString('<div>This is a test</div>');
        $this->assertInstanceOf(HtmlString::class, $htmlstring);
        $this->assertEquals('<div>This is a test</div>', $htmlstring->toHtml());
    }

    /** @test */
    public function testIsEmpty()
    {
        $emptyhtmlstring = new HtmlString('');
        $this->assertTrue($emptyhtmlstring->isEmpty());

        $nonemptyhtmlstring = new HtmlString('<div>This is a test</div>');
        $this->assertFalse($nonemptyhtmlstring->isEmpty());
    }

    /** @test */
    public function testIsNotEmpty()
    {
        $emptyhtmlstring = new HtmlString('');
        $this->assertFalse($emptyhtmlstring->isNotEmpty());

        $nonemptyhtmlstring = new HtmlString('<div>This is a test</div>');
        $this->assertTrue($nonemptyhtmlstring->isNotEmpty());
    }

    /** @test */
    public function testToString()
    {
        $htmlstring = new HtmlString('<div>This is a test</div>');
        $this->assertEquals('<div>This is a test</div>', $htmlstring->__toString());
    }
}
