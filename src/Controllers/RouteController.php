<?php
namespace Vibrary\Controllers;

class RouteController
{

    private $route;
    private $requestController;
    private $requestMethod;
    private $requestPayload;

    private $controllerIndex = 1;
    private $methodIndex = 2;
    private $payloadIndex = 3;

    public $controller;
    public $view;
    public $data;

    function __construct()
    {
        $this->route = $_SERVER['REQUEST_URI'];
        $payloadParts = explode("?", $this->route);

        if (array_key_exists(1, $payloadParts)) {
            $this->route = $payloadParts[0];
            $this->requestPayload = $payloadParts[1];
        }

        $routeParts = explode("/", $this->route);

        if (array_key_exists($this->controllerIndex, $routeParts) && $routeParts[1] != null && $routeParts[1] != '') {
            $this->requestController = $routeParts[$this->controllerIndex];
            if (array_key_exists($this->methodIndex, $routeParts)) {
                $this->requestMethod = $routeParts[$this->methodIndex];

                $pos = strpos('?', $this->requestMethod);
                if ($pos !== false) {
                    $callback = substr($this->requestMethod, $pos, strlen($this->requestMethod) - $pos);
                    echo '<h1>' . $callback . '</h1>';
                }
            }
            if (array_key_exists($this->payloadIndex, $routeParts) && !$this->requestPayload) {
                $this->requestPayload = $routeParts[$this->payloadIndex];
            }
        } else {
            $this->requestController = 'Home';
            $this->requestMethod = 'index';
        }

        $this->route();
    }

    function route()
    {
        $controllerName = ucfirst($this->requestController) . 'Controller';
        $controller = '\\Vibrary\\Controllers\\' . $controllerName;

        if ($controllerExists = file_exists(ROOTPATH . '/src/Controllers/' . $controllerName . '.php')) {
            $this->controller = new $controller;
        } else {
            $_SESSION['error_message'] = '404 Page Not Found';
            header('Location: ' . filter_var('/error/page', FILTER_SANITIZE_URL));
            exit;
        }

        $method = $this->requestMethod;

        if ($methodExists = method_exists($this->controller, $method)) {
            $viewData = $this->controller->$method($this->requestPayload);
            $this->view = $viewData['view'];
            $this->data = $viewData['data'];
        } else {
            $_SESSION['error_message'] = '422 Unprocessable Entity';
            header('Location: ' . filter_var('/error/page', FILTER_SANITIZE_URL));
            exit;
        }
    }
}
