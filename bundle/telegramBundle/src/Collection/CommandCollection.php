<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Collection;

use Syrniki\Telegram\Exception\TelegramOutOfBoundsException;
use Syrniki\Telegram\Interfaces\CommandCollectionInterface;
use Syrniki\Telegram\Interfaces\CommandInterface;

final class CommandCollection implements \Iterator, CommandCollectionInterface
{
    /**
     * @var array
     */
    private $commands;

    public function __construct(iterable $commands)
    {
        $this->commands = iterator_to_array($commands);
    }

    /**
     * @return CommandInterface|false
     */
    public function current()
    {
        return current($this->commands);
    }

    public function next(): void
    {
        next($this->commands);
    }

    public function valid(): bool
    {
        return null !== $this->key();
    }

    public function rewind(): void
    {
        reset($this->commands);
    }

    public function key()
    {
        return key($this->commands);
    }

    public function getCommand(string $name): CommandInterface
    {
        /** @var CommandInterface $command */
        foreach ($this->commands as $command) {
            if ($command->getName() === $name) {
                return $command;
            }
        }

        throw new TelegramOutOfBoundsException('Command not found by name: '.$name);
    }
}
