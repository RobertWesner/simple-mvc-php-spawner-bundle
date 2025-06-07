<?php

declare(strict_types=1);

namespace RobertWesner\SimpleMvcPhpSpawnerBundle\Spawner;

final readonly class Spawner
{
    public function __construct(
        private ?string $preExecuteScriptPath,
    ) {}

    /**
     * @param class-string<SpawnInterface> $spawn
     */
    public function spawn(string $spawn, SpawnConfigurationInterface $configuration): void
    {
        $baseDir = addslashes(__BASE_DIR__);
        $preExecuteScriptPath = addslashes($this->preExecuteScriptPath ?? '');
        $configurationString = addslashes(serialize($configuration));

        proc_close(
            proc_open(
                'php -r "' . addcslashes(
                    <<<PHP
                        use RobertWesner\SimpleMvcPhp\Routing\ContainerFactory;
                        use RobertWesner\SimpleMvcPhpSpawnerBundle\Spawner\SpawnInterface;
                        
                        const __BASE_DIR__ = "$baseDir";
                        
                        require __BASE_DIR__ . '/vendor/autoload.php';
                        
                        \$container = ContainerFactory::createContainer();
                        
                        if (file_exists(__BASE_DIR__ . '/configurations/container.php')) {
                            require __BASE_DIR__ . '/configurations/container.php';
                        }
                        
                        if (file_exists(__BASE_DIR__ . '/configurations/bundles.php')) {
                            require __BASE_DIR__ . '/configurations/bundles.php';
                        }
                        
                        if ('$preExecuteScriptPath' !== '') {
                            require '$preExecuteScriptPath';
                        }
                        
                        /** @var SpawnInterface \$spawn */
                        \$spawn = \$container->get('$spawn');
                        \$spawn->run(unserialize("$configurationString"));
                        PHP,
                    '"\\$',
                ). '" &',
                [],
                $_,
            ),
        );
    }
}
