<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Symfony\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Syrniki\Telegram\Interfaces\CommandInterface;

/**
 * @codeCoverageIgnore
 */
final class TelegramExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        $loader->load('services.yaml');
        $loader->load('parameters.yaml');

        $container->registerForAutoconfiguration(CommandInterface::class)
            ->addTag('telegram.command_tag');
    }
}
