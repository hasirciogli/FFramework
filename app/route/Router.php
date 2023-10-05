<?php

namespace app\route;

use app\api\Api;
use app\assignments\view\PAGETYPES;
use app\view\View;

class Router
{
    private array $routes = [];
    private array $middlewares = [];
    private array $namedRoutes = [];
    private array $params = [];


    public string $method = "";
    public string $ruri = "";

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];

        $ures = $_SERVER["REQUEST_URI"];
        $ifhaveUnlem = str_contains($ures, "?");

        if ($ifhaveUnlem)
            $ures = explode("?", $_SERVER["REQUEST_URI"])[0];

        $this->ruri = strlen($ures) > 1 ? rtrim($ures, '/') : $ures;



        if (str_ends_with($ures, "/") && strlen($this->ruri) > 1)
            Router::Route($this->ruri);
    }

    // Öneri 5: Yönlendirme grupları için başlangıç yolu ekleyen yöntem
    public function group(string $prefix, callable |string $handler = null): Router
    {
        if (!str_starts_with($this->ruri, $prefix))
            return $this;

        $group = new RouterGroup($prefix);

        if (is_callable($handler)) {
            call_user_func($handler, $group, $this);
        } else {

            // Handle non-callable handlers (e.g., controller and action)
            list($controller, $action) = explode('@', $handler);
            $this->callControllerAction($controller, $action, $group, $this);
        }

        $this->routes = array_merge_recursive($this->routes, $group->getRoutes());
        $this->middlewares = array_merge_recursive($this->middlewares, $group->getMiddlewares());

        return $this;
    }

    /**
     * @param $method [GET-POST-PUT-HEAD] etc...
     * @param $path your router path you know about this :)
     * @param $handler your handler class function(string) or function for handle this request.
     * 
     * @return Router
     */
    public function addRoute(string $method, string $path, callable |string $handler): Router
    {
        $this->routes[$method][$path] = $handler;
        return $this;
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
     * @param array $tmw
     * @return Router
     */
    private function processMiddleware($tmw): Router
    {
        $callBack = $tmw["callback"];
        $middleware = $tmw["middleware"];
        $dieOnFailed = $tmw["dieonfailed"];

        $mwIsSuccess = true;

        if (is_array($middleware)) {
            foreach ($middleware as $mw) {
                if (!$mwIsSuccess)
                    continue;

                if (is_callable($mw)) {
                    $mwIsSuccess = call_user_func($mw, $this);
                } else {
                    // Handle non-callable handlers (e.g., controller and action)
                    list($controller, $action) = explode('@', $mw);
                    $mwIsSuccess = $this->callControllerAction($controller, $action, $this);
                }
            }
        } elseif (is_callable($middleware)) {
            if ($mwIsSuccess)
                $mwIsSuccess = call_user_func($middleware, $this);
        } else {
            if ($mwIsSuccess) {
                // Handle non-callable handlers (e.g., controller and action)
                list($controller, $action) = explode('@', $middleware);
                $mwIsSuccess = $this->callControllerAction($controller, $action, $this);
            }
        }


        if (!$mwIsSuccess) {
            if (is_array($callBack)) {
                foreach ($callBack as $cb) {

                    if (is_callable($cb)) {
                        call_user_func($cb, $this);
                    } else {
                        // Handle non-callable handlers (e.g., controller and action)
                        list($controller, $action) = explode('@', $cb);
                        $this->callControllerAction($controller, $action, $this);
                    }
                }
            } elseif (is_callable($callBack))
                call_user_func($callBack, $this);
            else {
                list($controller, $action) = explode('@', $callBack);
                $this->callControllerAction($controller, $action, $this);
            }
        }


        if (!$mwIsSuccess && $dieOnFailed)
            die();

        return $this;
    }

    /**
     * @param callable |string|array $callBack
     * @param callable |string|array $middleware
     * @param bool $dieOnFailed
     * @return Router
     */
    public function staticMiddleware(callable |string|array $callBack, callable |string|array $middleware, bool $dieOnFailed = false): Router
    {
        $mwIsSuccess = true;

        if (is_array($middleware)) {
            foreach ($middleware as $mw) {
                if (!$mwIsSuccess)
                    continue;

                if (is_callable($mw)) {
                    $mwIsSuccess = call_user_func($mw, $this);
                } else {
                    // Handle non-callable handlers (e.g., controller and action)
                    list($controller, $action) = explode('@', $mw);
                    $mwIsSuccess = $this->callControllerAction($controller, $action, $this);
                }
            }
        } elseif (is_callable($middleware)) {
            if ($mwIsSuccess)
                $mwIsSuccess = call_user_func($middleware, $this);
        } else {
            if ($mwIsSuccess) {
                // Handle non-callable handlers (e.g., controller and action)
                list($controller, $action) = explode('@', $middleware);
                $mwIsSuccess = $this->callControllerAction($controller, $action, $this);
            }
        }


        if (!$mwIsSuccess) {
            if (is_array($callBack)) {
                foreach ($callBack as $cb) {

                    if (is_callable($cb)) {
                        call_user_func($cb, $this);
                    } else {
                        // Handle non-callable handlers (e.g., controller and action)
                        list($controller, $action) = explode('@', $cb);
                        $this->callControllerAction($controller, $action, $this);
                    }
                }
            } elseif (is_callable($callBack))
                call_user_func($callBack, $this);
            else {
                list($controller, $action) = explode('@', $callBack);
                $this->callControllerAction($controller, $action, $this);
            }
        }


        if (!$mwIsSuccess && $dieOnFailed)
            die();

        return $this;
    }

    /**
     * @param callable |string|array $callBack
     * @param callable |string|array $middleware
     * @param bool $dieOnFailed
     * @return Router
     */
    public function useMiddleware(callable |string|array $callBack, callable |string|array $middleware, bool $dieOnFailed = false): Router
    {
        var_dump($this->routes);
        $lastRoute = $this->getLastRoute();

        if (!$lastRoute)
            return $this;

        var_dump($lastRoute);

        $this->middlewares[$lastRoute[0]][$lastRoute[1]] = [
            "callback" => $callBack,
            "middleware" => $middleware,
            "dieonfailed" => $dieOnFailed
        ];

        return $this;
    }


    public function handleRequest(): void
    {

        $this->addRoute("GET", "/storage/*", function () {
            if (str_contains($this->ruri, "../")) {
                return;
            }

            $fway = configs_site_rootfolder . "/storage/" . str_replace("/storage", "", $this->ruri);


            if (!file_exists($fway)) {
                echo "Böyle bir dosya yok...";
                Router::Route(!empty($_GET["BackUri"]) ? $_GET["BackUri"] : "/u", 3);
                die();
            }

            $fname = explode("/", $fway);
            $fname = end($fname);

            //Define header information
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: 0");
            header('Content-Disposition: attachment; filename="' . $fname . '"');
            header('Content-Length: ' . filesize($fway));
            header('Pragma: public');

            //Clear system output buffer
            flush();

            //Read the size of the file
            readfile($fway);
        });

        $this->group("/api", function (RouterGroup $routerGroup) {
            //require __DIR__ . "/../api/api.php";

            Api::cfun()->use($this, $routerGroup);
        });

        //die($this->ruri);
        foreach ($this->routes[$this->method] ?? [] as $routePath => $handler) {
            if ($this->matchRoute($this->ruri, $routePath)) {

                if (!empty($this->middlewares[$this->method]) && !empty($this->middlewares[$this->method][$routePath]))
                    $this->processMiddleware($this->middlewares[$this->method][$routePath]);

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

        foreach ($this->routes["*"] ?? [] as $routePath => $handler) {
            if ($this->matchRoute($this->ruri, $routePath)) {

                if (!empty($this->middlewares["*"]) && !empty($this->middlewares["*"][$routePath]))
                    $this->processMiddleware($this->middlewares["*"][$routePath]);

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

        if (count($pathParts) !== count($routeParts) && end($routeParts) != "*") {
            return false;
        }

        for ($i = 0; $i < count($pathParts); $i++) {
            if ($routeParts[$i] == "*") { // Yıldız (*) karakterine denk gelen herhangi bir yol için true döndür.
                return true;
            } elseif (strpos($routeParts[$i], ':') === 0) {
                $paramName = ltrim($routeParts[$i], ':');
                $this->params[$paramName] = $pathParts[$i];
            } elseif ($pathParts[$i] !== $routeParts[$i]) {
                return false;
            }
        }

        return true;
    }

    private function callControllerAction(string $controller, string $action, ...$params): mixed
    {
        // Implement your controller action handling logic here
        // For example, you can use PHP's reflection to create an instance of the controller
        // and call the specified action method.

        // Example using a simple closure
        $controllerInstance = new $controller();
        return $controllerInstance->$action(...$params);
    }

    private function handleNotFound(): void
    {
        //echo $this->ruri;
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
    public function addNamedRoute(string $name, string $method, string $path, callable |string $handler): void
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
        if ($waitSecond > 0)
            header("Refresh: " . $waitSecond . ", " . $url);
        else {
            header("Location: " . $url);
            die();
        }
    }
}