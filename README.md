# Laravel Slack Log Driver (Block Kit with Incoming webhooks)

Laravel Log Driver for sending Block Kit messages to incoming webhooks in Slack.

[![Latest](https://poser.pugx.org/sunaoka/laravel-slack-block-kit-web-hook-driver/v)](https://packagist.org/packages/sunaoka/laravel-slack-block-kit-web-hook-driver)
[![License](https://poser.pugx.org/sunaoka/laravel-slack-block-kit-web-hook-driver/license)](https://packagist.org/packages/sunaoka/laravel-slack-block-kit-web-hook-driver)
[![PHP](https://img.shields.io/packagist/php-v/sunaoka/laravel-slack-block-kit-web-hook-driver)](composer.json)
[![Laravel](https://img.shields.io/badge/laravel-10.x%20%7C%2011.x-red)](https://laravel.com/)
[![Test](https://github.com/sunaoka/laravel-slack-block-kit-web-hook-driver/actions/workflows/test.yml/badge.svg?branch=develop)](https://github.com/sunaoka/laravel-slack-block-kit-web-hook-driver/actions/workflows/test.yml)
[![codecov](https://codecov.io/gh/sunaoka/laravel-slack-block-kit-web-hook-driver/branch/develop/graph/badge.svg)](https://codecov.io/gh/sunaoka/laravel-slack-block-kit-web-hook-driver)

----

## Installation

```bash
composer require sunaoka/laravel-slack-block-kit-web-hook-driver
```

## Setup

`config/logging.php` configuration file:

```php
return [
    'channels' => [
        'slack' => [
            'driver'   => 'custom',  // Set "custom" driver
            'url'      => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => env('LOG_SLACK_USERNAME', 'Laravel Log'),
            'level'    => env('LOG_LEVEL', 'info'),
            'via'      => \Sunaoka\Laravel\Log\Slack::class
        ],
    ],
];
```

## Usage

```php
<?php

$blocks = [
    'username' => config('logging.channels.slack.username'),
    'blocks' => [
        [
            'type' => 'section',
            'text' => [
                'type' => 'mrkdwn',
                'text' => "You have a new request:\n*<fakeLink.toEmployeeProfile.com|Fred Enriquez - New device request>*",
            ],
        ],
        [
            'type' => 'section',
            'fields' => [
                ['type' => 'mrkdwn', 'text' => "*Type:*\nComputer (laptop)"],
                ['type' => 'mrkdwn', 'text' => "*When:*\nSubmitted Aut 10"],
                ['type' => 'mrkdwn', 'text' => "*Last Update:*\nMar 10, 2015 (3 years, 5 months)"],
                ['type' => 'mrkdwn', 'text' => "*Reason:*\nAll vowel keys aren't working."],
                ['type' => 'mrkdwn', 'text' => "*Specs:*\n\"Cheetah Pro 15\" - Fast, really fast\""],
            ],
        ],
    ],
];

\Log::channel('info')->error(json_encode($blocks));
```
