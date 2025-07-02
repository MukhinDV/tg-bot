<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Symfony\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Syrniki\Telegram\Interfaces\TelegramClientInterface;

final class UnsetWebhookCommand extends Command
{
    protected static $defaultName = 'telegram:unset-webhook';

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
        $this->setDescription('Unset webhook');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $response = $this->telegramClient->deleteWebhook();

        if ($response->isSuccessfulStatus()) {
            $output->writeln('Delete webhook successfully complete!');

            return 0;
        }

        $output->writeln('Delete webhook failed, description= '.$response->getDescription().'!');

        return 1;
    }
}
