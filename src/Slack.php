<?php

declare(strict_types=1);

namespace Sunaoka\Laravel\Log;

use Monolog\Level;
use Monolog\Logger as Monolog;
use Psr\Log\LogLevel;
use Sunaoka\Laravel\Log\Handler\SlackBlockKitWebhookHandler;

class Slack
{
    /**
     * @param  array{url: string, level?: value-of<Level::VALUES>|value-of<Level::NAMES>|Level|LogLevel::*, bubble?: bool}  $config
     */
    public function __invoke(array $config): Monolog
    {
        $handler = new SlackBlockKitWebhookHandler(
            $config['url'],
            $config['level'] ?? 'debug',
            $config['bubble'] ?? true
        );

        return new Monolog('slack', [$handler]);
    }
}
