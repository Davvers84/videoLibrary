<?php
namespace Vibrary\Controllers;

require ROOTPATH . '/config/app.php';

class RouteController {

    private $route;
    private $requestController;
    private $requestMethod;
    private $requestPayload;

    private $controllerIndex = 1;
    private $methodIndex = 2;
    private $payloadIndex = 3;

    public $controller;

    function __construct() {
        $this->route = $_SERVER['REQUEST_URI'];
        $routeParts = explode("/", $this->route);
        if(array_key_exists($this->controllerIndex, $routeParts) && $routeParts[1] != null && $routeParts[1] != '') {
            $this->requestController = $routeParts[$this->controllerIndex];
            if(array_key_exists($this->methodIndex, $routeParts)) {
                $this->requestMethod = $routeParts[$this->methodIndex];
            }
            if(array_key_exists($this->payloadIndex, $routeParts)) {
                $this->requestPayload = $routeParts[$this->payloadIndex];
            }
        } else {
            $this->requestController = 'Home';
            $this->requestMethod = 'index';
        }
        $this->route();
    }

    function route() {
        $controllerName = ucfirst($this->requestController) . 'Controller';
        $controller = '\\Vibrary\\Controllers\\' . $controllerName;
        $method = $this->requestMethod;

        if(file_exists( ROOTPATH . '/src/Controllers/' . $controllerName . '.php')) {
            $this->controller = new $controller;
        } else {
            echo '404';
            // @todo call error blade with 404 not found
            return;
        }
        if(method_exists($this->controller, $method)) {
            $this->controller->$method($this->requestPayload);
        } else {
            echo '422';
            /* @todo call error blade with 422 not found
            * The 422 (Unprocessable Entity) status code means the server
            * understands the content type of the request entity (hence a
            * 415(Unsupported Media Type) status code is inappropriate), and the
            * syntax of the request entity is correct (thus a 400 (Bad Request)
            * status code is inappropriate) but was unable to process the contained
            * instructions.  For example, this error condition may occur if an XML
            * request body contains well-formed (i.e., syntactically correct), but
            *semantically erroneous, XML instructions.
            */
            return;
        }
    }
}