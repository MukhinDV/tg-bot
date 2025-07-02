<?php

declare(strict_types=1);

namespace App\Tests;

use App\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TestKernel extends Kernel
{
    public const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    private $resourcesPath = [
        '/bundle/telegramBundle/tests/Resources/config',
    ];

    public function configureContainer(ContainerBuilder $container, LoaderInterface $loader)
    {
        $confDir = $this->getProjectDir().'/config';

        $loader->load($confDir.'/packages/*'.self::CONFIG_EXTS, 'glob');
        if (is_dir($confDir.'/packages/'.$this->environment)) {
            $loader->load($confDir.'/packages/'.$this->environment.'/**/*'.self::CONFIG_EXTS, 'glob');
        }

        $loader->load($confDir.'/services'.self::CONFIG_EXTS, 'glob');
        $loader->load($confDir.'/services_'.$this->environment.self::CONFIG_EXTS, 'glob');

        foreach ($this->resourcesPath as $item) {
            $loader->load($this->getProjectDir().$item.'/services'.self::CONFIG_EXTS, 'glob');
        }
    }
}
