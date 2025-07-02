<?php

declare(strict_types=1);

namespace Syrniki\User\Symfony\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Syrniki\User\Exception\UserOutOfBoundsException;
use Syrniki\User\Interfaces\UserRepositoryInterface;

final class SetAdminToUserCommand extends Command
{
    protected static $defaultName = 'user:set-admin-to-user';

    /**
     * @var UserRepositoryInterface;
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        parent::__construct(self::$defaultName);

        $this->userRepository = $userRepository;
    }

    protected function configure()
    {
        parent::configure();

        $this->setName(self::$defaultName);
        $this->setDescription('Set admin to user');
        $this->addArgument('telegramUserId', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $telegramUserId = (int) $input->getArgument('telegramUserId');

        $user = $this->userRepository->findByTelegramUserId($telegramUserId);

        if (null === $user) {
            throw new UserOutOfBoundsException('User doesn\'t exit by telegramUserId: '.$telegramUserId);
        }

        $user->setAdmin();
        $this->userRepository->save($user);

        $output->writeln('Set admin to user successfully');

        return 1;
    }
}
