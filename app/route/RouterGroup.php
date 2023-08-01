<?php


namespace app\route;

class RouterGroup extends \app\route\Router
{
    private string $prefix;
    private array $middlewares = [];
    private array $routes = [];

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return null|array return last added route
     */
    public function getLastRoute(): null|array
    {
        $lastMethod = array_key_last($this->routes);
        if ($lastMethod !== null) {
            $lastPath = array_key_last($this->routes[$lastMethod]);
            if ($lastPath !== null) {
                return [$lastMethod, $lastPath, $this->routes[$lastMethod][$lastPath]];
            }
        }

        return null;
    }



    /**
     * @param callable |string|array $callBack
     * @param callable |string|array $middleware
     * @param bool $dieOnFailed
     * @return Router
     */
    public function useMiddleware(callable |string|array $callBack, callable |string|array $middleware, bool $dieOnFailed = false): Router
    {
        $lastRoute = $this->getLastRoute();

        if (!$lastRoute)
            return $this;


        $this->middlewares[$lastRoute[0]][$lastRoute[1]] = [
            "callback" => $callBack,
            "middleware" => $middleware,
            "dieonfailed" => $dieOnFailed
        ];

        return $this;
    }

    /**
     * @param string $method Method GET-PUT-POST ... ETC
     * @param string $path path to your bind way
     * @param callable|string function or string for handler you know abot this :)
     * @return RouterGroup
     */
    public function addRoute(string $method, string $path, callable|string $handler): RouterGroup
    {
        $path = rtrim($this->prefix, '/') . (empty($path) ? '' : '/') . ltrim($path, '/');
        $this->routes[$method][$path] = $handler;
        return $this;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}