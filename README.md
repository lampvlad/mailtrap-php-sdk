# Mailtrap.io PHP SDK

![GitHub Actions](https://github.com/lampvlad/mailtrap-sdk/actions/workflows/main.yml/badge.svg)

Extendable object with a method that will send an email using the Mailtrap Email Sending API https://api-docs.mailtrap.io/docs/mailtrap-api-docs/. The send() method should be able to receive a number of parameters, some of them optional.

## Installation

You can install the package via composer:

```bash
composer require lampvlad/mailtrap-sdk
```

## Usage

In order to use the MailtrapSdk class, you need to instantiate it by providing your token and optional endpoint.

```php
$mailtrapsdk = new \Lampvlad\MailtrapSdk\MailtrapSdk($token, $endpoint);
```

The MailtrapSdk class provides a send() method which allows you to send a message.

This method requires the following parameters:


`$from` - an Address object or array representing the sender

`$to` - an array of Address objects representing the recipients

`$subject` - the message subject

`$text` - the message body in plain text

`$html` - an htmlstring object representing the html version of the message body

`$attachments` - an array of Attachment objects representing any files to be attached to the message


The `send()` method returns an array containing the response from the mailtrap api.

```php
// Usage example here

$client = new MailtrapSdk(self::TEST_TOKEN, self::TEST_ENDPOINT);

$from = new Address('test@example.com', 'Lamp Vlad');

$to = [
    new Address('test1@example.com'),
    new Address('test1@example.com', 'Vlad Lamp')
];

$subject = 'Test Subject';

$text = 'This is a test message.';

$response = $this->client->send($from, $to, $subject, $text);

// example of HTML message
$html = new HtmlString("<p>Congratulations on your order no.</p>");

// example of attachments
$attachments = [
    new Attachment(
        content: "PCFET0NUWVBFIGh0bWw+CjxodG1sIGxhbmc9ImVuIj4KCiAgICA8aGVhZD4KICAgICAgICA8bWV0YSBjaGFyc2V0PSJVVEYtOCI+CiAgICAgICAgPG1ldGEgaHR0cC1lcXVpdj0iWC1VQS1Db21wYXRpYmxlIiBjb250ZW50PSJJRT1lZGdlIj4KICAgICAgICA8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCI+CiAgICAgICAgPHRpdGxlPkRvY3VtZW50PC90aXRsZT4KICAgIDwvaGVhZD4KCiAgICA8Ym9keT4KCiAgICA8L2JvZHk+Cgo8L2h0bWw+Cg==",
        filename: "index.html",
        type: "text/html",
        disposition: "attachment"
    )
];

```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email slavalampdev@googlemail.com instead of using the issue tracker.

## Credits

-   [Vladislav Nalyvaiko](https://github.com/lampvlad)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
