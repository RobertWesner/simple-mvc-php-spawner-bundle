<?php

declare(strict_types=1);

namespace RobertWesner\SimpleMvcPhpSpawnerBundle\Tests\Spawner;

use RobertWesner\SimpleMvcPhpSpawnerBundle\Spawner\Spawner;
use RobertWesner\SimpleMvcPhpSpawnerBundle\Tests\BaseTestCase;
use RobertWesner\SimpleMvcPhpSpawnerBundle\Tests\Spawner\Fixtures\EchoSpawn;
use RobertWesner\SimpleMvcPhpSpawnerBundle\Tests\Spawner\Fixtures\EchoSpawnConfiguration;

class Test extends BaseTestCase
{
    public function test(): void
    {
        $filename = tempnam(sys_get_temp_dir(), 'spawner_test_');

        new Spawner(null)->spawn(
            EchoSpawn::class,
            new EchoSpawnConfiguration(
                $filename,
                'FooBar',
            ),
        );

        // since it's asynchronous, we need to potentially wait
        while (file_get_contents($filename) === '') {
            sleep(1);
        };

        self::assertSame('FooBar', file_get_contents($filename));
    }
}
