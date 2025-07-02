<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Symfony\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Syrniki\Telegram\Interfaces\TelegramClientInterface;

final class SetWebhookCommand extends Command
{
    protected static $defaultName = 'telegram:set-webhook';

    /**
     * @var TelegramClientInterface;
     */
    private $telegramClient;

    /**
     * @var string;
     */
    private $domain;

    /**
     * @var string;
     */
    private $webhookUrl;

    public function __construct(TelegramClientInterface $telegramClient, string $domain, string $webhookUrl)
    {
        parent::__construct(self::$defaultName);

        $this->telegramClient = $telegramClient;
        $this->domain = $domain;
        $this->webhookUrl = $webhookUrl;
    }

    protected function configure()
    {
        parent::configure();

        $this->setName(self::$defaultName);
        $this->setDescription('Set webhook');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $response = $this->telegramClient->setWebhook($this->domain.$this->webhookUrl);

        if ($response->isSuccessfulStatus()) {
            $output->writeln('Set webhook successfully complete!');

            return 0;
        }

        $output->writeln('Set webhook failed, description= '.$response->getDescription().'!');

        return 1;
    }
}
