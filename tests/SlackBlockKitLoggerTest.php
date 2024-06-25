<?php

declare(strict_types=1);

namespace Sunaoka\Laravel\Log\Tests;

use Sunaoka\Laravel\Log\Handler\SlackBlockKitWebhookHandler;
use Sunaoka\Laravel\Log\Slack;

class SlackBlockKitLoggerTest extends TestCase
{
    public function test_successful(): void
    {
        $actual = (new Slack())->__invoke([
            'url' => 'https://hooks.slack.com/services/T00000000/B00000000/XXXXXXXXXXXXXXXXXXXXXXXX',
            'level' => 'debug',
            'bubble' => true,
        ]);

        self::assertSame('slack', $actual->getName());
        self::assertInstanceOf(SlackBlockKitWebhookHandler::class, $actual->getHandlers()[0]);
    }
}
