<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Symfony\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Syrniki\Telegram\Exception\TelegramTransportException;
use Syrniki\Telegram\Interfaces\TelegramClientInterface;

final class GetWebhookInfoCommand extends Command
{
    protected static $defaultName = 'telegram:get-webhook-info';

    /**
     * @var TelegramClientInterface;
     */
    private $telegramClient;

    public function __construct(TelegramClientInterface $telegramClient)
    {
        parent::__construct(self::$defaultName);

        $this->telegramClient = $telegramClient;
    }

    protected function configure()
    {
        parent::configure();

        $this->setName(self::$defaultName);
        $this->setDescription('Get webhook');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $response = $this->telegramClient->getWebhookInfo();

            $output->writeln(sprintf('Status: %s, url: %s.', $response->getStatus(), $response->getUrl()));

            return 0;
        } catch (TelegramTransportException $telegramTransportException) {
            $output->writeln('Get webhook info failed!');

            return 1;
        }
    }
}
