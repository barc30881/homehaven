<?php

namespace Framework;

use Framework\Middleware\Authorize;
class Router
{
    protected $routes = [];

    /**
     * Add a new route
     * 
     * @param string $method
     * @param string $uri
     * @param string $action
     * @param array $middleware
     * @return void
     */

    public function registerRoute($method, $uri, $action, $middleware = [])
    {
        list($controller, $controllerMethod) = explode("@", $action);

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod,
            'middleware' => $middleware
        ];
    }


    /**
     * Add a Get route
     * 
     * @param  string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */
    public function get($uri, $controller, $middleware = [])
    {
        return $this->registerRoute('GET', $uri, $controller, $middleware);
    }

    /**
     * Add a POST route
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */

    public function post($uri, $controller, $middleware = [])
    {
        return $this->registerRoute('POST', $uri, $controller, $middleware);
    }

    /**
     * Add a PUT route
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */

    public function put($uri, $controller, $middleware = [])
    {
        return $this->registerRoute('PUT', $uri, $controller, $middleware);
    }

    /**
     * Add a DELETE route
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */
    public function delete($uri, $controller, $middleware = [])
    {
        return $this->registerRoute('DELETE', $uri, $controller, $middleware);
    }


    /**
     * Route the request
     * @param string $uri
     * @param string $method
     * @return void
     */
    public function route($uri)
    {
        inspectAndDie($_GET);
        // Remove the query string from URI if present
        $uri = strtok($uri, '?');
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Check FOR _method input
        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            // overide the request method with the value of _method
            $requestMethod = strtoupper($_POST['_method']);
        }

        // loop through the routes

        foreach ($this->routes as $route) {
            // split the current URI into segments

            $uriSegments = explode('/', trim($uri, '/'));

            // split the route URI into segments
            $routeSegments = explode('/', trim($route['uri'], '/'));

            $match = true;


            // check if the number of the segment matches 
            if (count($uriSegments) === count($routeSegments) && strtoupper($requestMethod) === strtoupper($route['method'])) {
                $params = [];
                $match = true;
                $arr = [
                    'uriSegments' => $uriSegments,
                    'routeSegments' => $routeSegments,
                    'requestMethod' => $requestMethod,
                    'routeMethod' => $route['method']
                ];
           

                //  for($i =0;$i<count($uriSegments); $i++){

                //     // if the URI'S don't match and there is no params
                //  }


                for ($i = 0; $i < count($uriSegments); $i++) {
                    // if the URI'S don't match and there is no paramas 
                    if ($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
                        $match = false;
                        break;
                    }

                    //   check for the param and add to the $params array
                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                }
                if ($match) {
                    foreach($route['middleware'] as $middleware) {
                        (new Authorize())->handle($middleware);

                    }

                    // Extract the controller and controller method
                    $controller = 'App\\controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];



                    // instatiate the controller and the call the method
                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod(...array_values($params));
                
                    return;
                }
                
            }
        }
       redirect('/');
    }
}


