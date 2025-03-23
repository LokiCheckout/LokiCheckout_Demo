<?php

declare(strict_types=1);

namespace Yireo\LokiCheckoutDemo\Test\Unit\Component\GridLayout;

use PHPUnit\Framework\TestCase;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\GetObjectManager;
use Yireo\LokiCheckoutDemo\Component\GridLayout\GridLayoutRepository;
use Yireo\LokiComponents\Component\ComponentContextInterface;
use Yireo\LokiComponents\Component\ComponentInterface;

final class GridLayoutRepositoryTest extends TestCase
{
    use GetObjectManager;

    final public function testGetValue()
    {
        $context = $this->createMock(ComponentContextInterface::class);

        $component = $this->createMock(ComponentInterface::class);
        $component->method('getContext')->willReturn($context);

        $repository = new GridLayoutRepository();
        $repository->setComponent($component);

        $this->assertEquals('foobar', $repository->getValue());
    }

    final public function testSaveValue()
    {
        $context = $this->createMock(ComponentContextInterface::class);

        $component = $this->createMock(ComponentInterface::class);
        $component->method('getContext')->willReturn($context);

        $repository = new GridLayoutRepository();
        $repository->setComponent($component);

        $repository->saveValue('foobar');
        $this->assertTrue(false);
    }
}
