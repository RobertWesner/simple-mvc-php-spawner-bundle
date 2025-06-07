<?php

declare(strict_types=1);

namespace RobertWesner\SimpleMvcPhpSpawnerBundle;

final readonly class SpawnerBundleConfiguration
{
    public function __construct(
        public ?string $preExecuteScriptPath = null,
    ) {}
}
