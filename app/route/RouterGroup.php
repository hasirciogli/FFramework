<?php


namespace app\route;

class RouterGroup
{
    private string $prefix;
    private array $routes = [];

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }

    public function addRoute(string $method, string $path, callable|string $handler): void
    {
        $path = rtrim($this->prefix, '/') . (empty($path) ? '' : '/') . ltrim($path, '/');
        $this->routes[$method][$path] = $handler;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}