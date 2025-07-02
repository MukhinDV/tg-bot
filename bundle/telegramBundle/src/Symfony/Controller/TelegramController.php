<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Symfony\Controller;

use App\src\Interfaces\StringServiceInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Syrniki\Telegram\Command\DefaultCommand;
use Syrniki\Telegram\Event\UserAdminEvent;
use Syrniki\Telegram\Interfaces\CommandCollectionInterface;
use Syrniki\Telegram\Interfaces\TelegramDataServiceInterface;
use Syrniki\Telegram\Interfaces\WebhookInputServiceInterface;

final class TelegramController
{
    use LoggerAwareTrait;

    /**
     * @var WebhookInputServiceInterface;
     */
    private $webhookInputService;

    /**
     * @var CommandCollectionInterface
     */
    private $commandCollection;

    /**
     * @var StringServiceInterface
     */
    private $stringService;

    /**
     * @var string
     */
    private $gatewayUrl;

    /**
     * @var TelegramDataServiceInterface
     */
    private $telegramDataService;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(
        WebhookInputServiceInterface $webhookInputService,
        CommandCollectionInterface $commandCollection,
        StringServiceInterface $stringService,
        TelegramDataServiceInterface $telegramDataService,
        EventDispatcherInterface $eventDispatcher,
        string $gatewayUrl
    ) {
        $this->webhookInputService = $webhookInputService;
        $this->commandCollection = $commandCollection;
        $this->stringService = $stringService;
        $this->gatewayUrl = $gatewayUrl;
        $this->telegramDataService = $telegramDataService;
        $this->eventDispatcher = $eventDispatcher;

        $this->setLogger(new NullLogger());
    }

    /**
     * @Route("/telegram/webhook", methods={"POST"})
     */
    public function webhook(): JsonResponse
    {
        try {
            $webhookUpdates = $this->webhookInputService->getWebhookUpdates();
            $commandName = $this->telegramDataService->getCommandName($webhookUpdates);

            $command = $this->commandCollection->getCommand($commandName);
            // todo if user don't create? transfer to adminAbstractCommand
            //            $this->eventDispatcher->dispatch(new UserAdminEvent($webhookUpdates->getChatId()));

            $command->execute($webhookUpdates);

            return new JsonResponse();
        } catch (\Exception $e) {
            $errorMessage = $this->stringService->cutStringFromTo($e->getMessage(), $this->gatewayUrl, '/');

            $this->logger->error(sprintf('Error in command: %s', $errorMessage));

            $this->commandCollection->getCommand(DefaultCommand::COMMAND_NAME)->execute($webhookUpdates);

            return new JsonResponse();
        }
    }
}
