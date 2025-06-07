<?php

declare(strict_types=1);

namespace RobertWesner\SimpleMvcPhpSpawnerBundle\Spawner;

interface SpawnConfigurationInterface
{
    public function __serialize(): array;

    public function __unserialize(array $data): void;
}
