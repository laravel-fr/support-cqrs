<?php

namespace App;

use ReflectionClass;
use Illuminate\Support\Str;
use Psr\Container\ContainerInterface;

class CommandBus
{
    public function __construct(
        private ContainerInterface $container,
    ) {}

    public function handle($command): void
    {
        $handlerName = $this->resolveHandlerName($command);

        $handler = $this->container->get($handlerName);

        $handler($command);
    }

    private function resolveHandlerName($command): string
    {
        $reflection = new ReflectionClass($command);

        $handlerName = Str::replaceLast('Command', 'Handler', $reflection->getShortName());

        $namespaceName = $reflection->getNamespaceName();

        return $namespaceName . '\\' . $handlerName;
    }
}
