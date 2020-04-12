<?php

declare(strict_types = 1);

namespace Framework\Command;


use Symfony\Component\DependencyInjection\ContainerBuilder;

class RegisterRoutesCommand implements CommandInterface
{
    protected $routeCollection;

    protected $containerBuilder;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->containerBuilder = $containerBuilder;
    }

    public function execute()
    {
        $this->routeCollection = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routing.php';
        $this->containerBuilder->set('route_collection', $this->routeCollection);
    }

    public function getRoutes()
    {
        return $this->routeCollection;
    }
}