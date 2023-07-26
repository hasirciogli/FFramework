<?php

namespace app\route;

use app\assignments\view\PAGETYPES;
use app\view\View;

class Router
{
    private array $routes = [];
    private array $namedRoutes = [];
    private array $params = [];

    public string $ruri = "";

    public function __construct()
    {
        $ures = $_SERVER["REQUEST_URI"];
        $ifhaveUnlem    = str_contains($_SERVER["REQUEST_URI"], "?");

        if ($ifhaveUnlem)
            $ures = explode("?", $_SERVER["REQUEST_URI"])[0];


        $this->ruri = $ures;
    }

    // Öneri 5: Yönlendirme grupları için başlangıç yolu ekleyen yöntem
    public function group(string $prefix, callable $callback): void
    {
        if(!str_starts_with($this->ruri, $prefix))
            return;

        $group = new RouterGroup($prefix);
        call_user_func($callback, $group);
        $this->routes = array_merge_recursive($this->routes, $group->getRoutes());
    }


    // Öneri 1: Yönlendirme grupları için bir grup ekleme metodu
    public function addRouteGroup(array $group, callable $callback): void
    {
        foreach ($group as $route) {
            call_user_func($callback, $route);
        }
    }

    public function addRoute(string $method, string $path, callable|string $handler): void
    {
        $this->routes[$method][$path] = $handler;
    }

    public function useMiddleware(callable $middleware): void
    {
        $middleware($this);
    }

    public function handleRequest(string $method, string $path): void
    {
        foreach ($this->routes[$method] as $routePath => $handler) {
            if ($this->matchRoute($path, $routePath)) {
                if (is_callable($handler)) {
                    $handler();
                } else {
                    // Öneri 3: İsimlendirilmiş rotaları desteklemek için işleyici adlarını döndürmek
                    if (strpos($handler, '@') === false) {
                        $handler = $this->getHandlerByName($handler);
                    }

                    // Handle non-callable handlers (e.g., controller and action)
                    list($controller, $action) = explode('@', $handler);
                    $this->callControllerAction($controller, $action);
                }
                return;
            }
        }

        $this->handleNotFound();
    }

    private function matchRoute(string $path, string $routePath): bool
    {
        $pathParts = explode('/', explode("?", $path)[0]);
        $routeParts = explode('/', $routePath);

        if (count($pathParts) !== count($routeParts)) {
            return false;
        }

        for ($i = 0; $i < count($pathParts); $i++) {
            if (strpos($routeParts[$i], ':') === 0) {
                $paramName = ltrim($routeParts[$i], ':');
                $this->params[$paramName] = $pathParts[$i];
            } elseif ($pathParts[$i] !== $routeParts[$i]) {
                return false;
            }
        }

        return true;
    }

    private function callControllerAction(string $controller, string $action): void
    {
        // Implement your controller action handling logic here
        // For example, you can use PHP's reflection to create an instance of the controller
        // and call the specified action method.

        // Example using a simple closure
        $controllerInstance = new $controller();
        $controllerInstance->$action();
    }

    private function handleNotFound(): void
    {
        http_response_code(404);
        // Handle 404 Not Found errors here
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");


        View::Show("404", PAGETYPES::PAGE_TYPE_ERROR);


        //echo "404 Not Found";
    }

    public function getParam(string $paramName): ?string
    {
        return ($rurl = $this->params[$paramName] ?? null) ? urldecode($rurl) : $rurl;
    }

    // Öneri 2: İsimlendirilmiş rotaları eklemek ve döndürmek için yeni bir yöntem
    public function addNamedRoute(string $name, string $method, string $path, callable|string $handler): void
    {
        $this->routes[$method][$path] = $handler;
        $this->namedRoutes[$name] = $path;
    }

    public function getHandlerByName(string $name): ?string
    {
        return $this->routes['GET'][$name] ?? null;
    }

    // Öneri 4: URL oluşturma işlemini destekleyen yöntem
    public function generateUrl(string $name, array $params = []): ?string
    {
        if (!isset($this->namedRoutes[$name])) {
            return null;
        }

        $path = $this->namedRoutes[$name];

        foreach ($params as $paramName => $paramValue) {
            $path = str_replace(":$paramName", $paramValue, $path);
        }

        return $path;
    }


    public static function cfun()
    {
        return new Router();
    }

    public static function Route($url, $waitSecond = -1)
    {
        if($waitSecond > 0)
            header("Refresh: ".$waitSecond.", ".$url);
        else
            header("Location: ".$url);

        die();
    }
}
