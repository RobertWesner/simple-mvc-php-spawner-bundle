<h1 align="center">
Simple MVC Spawner Bundle
</h1>

<div align="center">

![](https://github.com/RobertWesner/simple-mvc-php-spawner-bundle/actions/workflows/tests.yml/badge.svg)
![](https://raw.githubusercontent.com/RobertWesner/simple-mvc-php-spawner-bundle/image-data/coverage.svg)
![](https://img.shields.io/github/v/release/RobertWesner/simple-mvc-php-spawner-bundle)
[![License: MIT](https://img.shields.io/github/license/RobertWesner/simple-mvc-php-spawner-bundle)](../../raw/main/LICENSE.txt)

</div>

Run background tasks that do not produce synchronous output or require monitoring.

Fire and forget.

Created for my [YouTube playlist viewer with pagination](https://ytplaylist.robert.wesner.io).

## Installation

```bash
composer require robertwesner/simple-mvc-php-spawner-bundle
```

Make sure to load the bundle in your `$PROJECT_ROOT$/configurations/bundles.php`.

```php
use RobertWesner\SimpleMvcPhp\Configuration;
use RobertWesner\SimpleMvcPhpSpawnerBundle\SpawnerBundle;
use RobertWesner\SimpleMvcPhpSpawnerBundle\SpawnerBundleConfiguration;

Configuration::BUNDLES
    ::load(
        SpawnerBundle::class,
        // optional, can be omitted
        new SpawnerBundleConfiguration(
            preExecuteScriptPath: __BASE_DIR__ . '/pre-command.php',
        ),
    );
```

## Usage

### Create configuration

```php
final readonly class MySpawnConfiguration implements SpawnConfigurationInterface
{
    public function __construct(
        private string $foo,
        private string $bar,
    ) {}

    public function __serialize(): array
    {
        return [
            'foo' => $this->foo,
            'bar' => $this->bar,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->foo = $data['foo'];
        $this->bar = $data['bar'];
    }

    public function getFoo(): string
    {
        return $this->foo;
    }

    public function getBar(): string
    {
        return $this->bar;
    }
}

```

### Create background task

```php
class MySpawn implements SpawnInterface
{
    public function run(SpawnConfigurationInterface|MySpawnConfiguration $configuration): void
    {
        // asynchronous task with $configuration->getFoo(), etc...
    }
}
```

### Execute

```php
// spawner accessed through dependency injection
$this->spawner->spawn(
    EchoSpawn::class,
    new EchoSpawnConfiguration(
        'Some value',
        'Another value',
    ),
);
```
