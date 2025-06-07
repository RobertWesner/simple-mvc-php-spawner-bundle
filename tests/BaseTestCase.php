<?php

declare(strict_types=1);

namespace RobertWesner\SimpleMvcPhpSpawnerBundle\Tests;

use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        if (!defined('__BASE_DIR__')) {
            define('__BASE_DIR__', __DIR__ . '/..');
        }
    }
}
