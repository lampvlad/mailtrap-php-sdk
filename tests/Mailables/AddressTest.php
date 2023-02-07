<?php

declare(strict_types = 1);

namespace Lampvlad\MailtrapSdk\Tests\Mailables;

use Lampvlad\MailtrapSdk\Mailables\Address;

/** @package Lampvlad\MailtrapSdk\Tests\Mailables */
class AddressTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_creates_a_valid_address_instance(): void
    {
        $address = new Address('foo@example.com', 'Foo Bar');

        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals('foo@example.com', $address->email);
        $this->assertEquals('Foo Bar', $address->name);
    }

    /** @test */
    public function it_creates_a_valid_address_instance_without_name(): void
    {
        $address = new Address('foo@example.com');

        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals('foo@example.com', $address->email);
    }
}