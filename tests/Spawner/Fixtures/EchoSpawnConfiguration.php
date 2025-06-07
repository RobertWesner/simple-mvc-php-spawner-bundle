<?php

declare(strict_types=1);

namespace RobertWesner\SimpleMvcPhpSpawnerBundle\Tests\Spawner\Fixtures;

use RobertWesner\SimpleMvcPhpSpawnerBundle\Spawner\SpawnConfigurationInterface;

final readonly class EchoSpawnConfiguration implements SpawnConfigurationInterface
{
    public function __construct(
        private string $filename,
        private string $text,
    ) {}

    public function __serialize(): array
    {
        return [
            'filename' => $this->filename,
            'text' => $this->text,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->filename = $data['filename'];
        $this->text = $data['text'];
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
