<?php

declare(strict_types=1);

namespace Sunaoka\Laravel\Log\Handler;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\Curl;
use Monolog\Level;
use Monolog\LogRecord;
use Psr\Log\LogLevel;

class SlackBlockKitWebhookHandler extends AbstractProcessingHandler
{
    /**
     * @param  string  $webhookUrl  Slack Webhook URL
     * @param  value-of<Level::VALUES>|value-of<Level::NAMES>|Level|LogLevel::*  $level  The minimum logging level at which this handler will be triggered
     * @param  bool  $bubble  Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct(
        private readonly string $webhookUrl,
        int|string|Level $level = Level::Debug,
        bool $bubble = true
    ) {
        parent::__construct($level, $bubble);
    }

    #[\Override]
    protected function write(LogRecord $record): void
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $this->webhookUrl,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Content-type: application/json'],
            CURLOPT_POSTFIELDS => $record->message,
            CURLOPT_TIMEOUT => 10,
        ]);

        Curl\Util::execute($ch);
    }
}
