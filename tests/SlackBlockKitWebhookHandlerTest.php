<?php

declare(strict_types=1);

namespace Sunaoka\Laravel\Log\Tests;

use Monolog\Handler\Curl;
use Monolog\Level;
use Monolog\LogRecord;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use Sunaoka\Laravel\Log\Handler\SlackBlockKitWebhookHandler;

class SlackBlockKitWebhookHandlerTest extends TestCase
{
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_successful(): void
    {
        \Mockery::mock('overload:'.Curl\Util::class)
            ->makePartial()
            ->shouldReceive('execute')
            ->andReturn('ok');

        $handler = new SlackBlockKitWebhookHandler(
            webhookUrl: 'https://hooks.slack.com/services/T00000000/B00000000/XXXXXXXXXXXXXXXXXXXXXXXX',
            level: 'debug',
            bubble: false,
        );

        $actual = $handler->handle(new LogRecord(
            datetime: new \DateTimeImmutable(),
            channel: 'channel',
            level: Level::Debug,
            message: 'message',
            context: [],

        ));

        self::assertTrue($actual);
    }
}
