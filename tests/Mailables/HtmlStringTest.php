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
        $this->assertEquals('<div>This is a test</div>', $htmlstring->tohtml());
    }

    /** @test */
    public function testIsEmpty()
    {
        $emptyhtmlstring = new HtmlString('');
        $this->assertTrue($emptyhtmlstring->isempty());

        $nonemptyhtmlstring = new HtmlString('<div>This is a test</div>');
        $this->assertFalse($nonemptyhtmlstring->isempty());
    }

    /** @test */
    public function testIsNotEmpty()
    {
        $emptyhtmlstring = new HtmlString('');
        $this->assertFalse($emptyhtmlstring->isnotempty());

        $nonemptyhtmlstring = new HtmlString('<div>This is a test</div>');
        $this->assertTrue($nonemptyhtmlstring->isnotempty());
    }

    /** @test */
    public function testToString()
    {
        $htmlstring = new HtmlString('<div>This is a test</div>');
        $this->assertEquals('<div>This is a test</div>', $htmlstring->__tostring());
    }
}
