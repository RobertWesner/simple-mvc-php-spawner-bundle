<?php

declare(strict_types=1);

namespace RobertWesner\SimpleMvcPhpSpawnerBundle;

use RobertWesner\SimpleMvcPhp\Bundles\BundleInterface;
use RobertWesner\SimpleMvcPhp\Configuration\Container;
use RobertWesner\SimpleMvcPhpSpawnerBundle\Spawner\Spawner;

final class SpawnerBundle implements BundleInterface
{
    /**
     * @param SpawnerBundleConfiguration|null $configuration
     */
    public static function load(mixed $configuration = null): void
    {
        Container::register(Spawner::class, new Spawner($configuration?->preExecuteScriptPath));
    }
}
