<?php

declare(strict_types=1);

namespace RobertWesner\SimpleMvcPhpSpawnerBundle\Tests\Spawner\Fixtures;

use RobertWesner\SimpleMvcPhpSpawnerBundle\Spawner\SpawnConfigurationInterface;
use RobertWesner\SimpleMvcPhpSpawnerBundle\Spawner\SpawnInterface;

class EchoSpawn implements SpawnInterface
{
    public function run(SpawnConfigurationInterface|EchoSpawnConfiguration $configuration): void
    {
        file_put_contents($configuration->getFilename(), $configuration->getText());
    }
}
