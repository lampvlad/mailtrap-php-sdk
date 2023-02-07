<?php

namespace Lampvlad\MailtrapSdk\Mailables;

/** @package Lampvlad\MailtrapSdk\Mailables */
class Address
{
    /**
     * The email address.
     * @var string
     */
    public string $email;

    /**
     * The name of the recipient.
     * @var string|null
     */
    public ?string $name;

    /**
     * Create a new address instance.
     *
     * @param  string  $email
     * @param  string|null  $name
     * @return void
     */
    public function __construct(
        string $email,
        ?string $name = null
    ) {
        $this->email = $email;

        if (!is_null($name)) {
            $this->name = $name;
        }
    }
}
