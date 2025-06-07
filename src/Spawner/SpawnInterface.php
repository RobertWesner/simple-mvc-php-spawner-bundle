<?php

declare(strict_types=1);

namespace RobertWesner\SimpleMvcPhpSpawnerBundle\Spawner;

interface SpawnInterface
{
    public function run(SpawnConfigurationInterface $configuration): void;
}
