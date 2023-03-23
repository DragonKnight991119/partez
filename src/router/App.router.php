<?php 
namespace Abollinger\Partez\Router;

use \Abollinger\Partez\Controller\AppController;

class AppRouter extends Router 
{
    private $route;
    private $routesOnNavbar;
    private $controller;

    public function __construct(
        $path = "",
        $routesPath = "",
        $textsPath = ""
    ) {
        parent::__construct($path, $routesPath, $textsPath);
        $this->routesOnNavbar = array_filter($this->routes, function($value) {return $value["onNavbar"] ?? true;});
    }

    /**
     * Compare if the requested exists in the declared routes and, if so, set the right controller
     * 
     * @param null
     * @return bool
     */
    public function start(
        $params = null
    ) : bool {
        try {
            $key = array_search($this->path, array_column($this->routes, "route"));
            if ($key === false)
                throw new \Exception("page", 404);

            $this->route = $this->routes[$key];
            $controllerPath = APP_CONTROLLER_PATH . "/" . $this->route["name"] . ".controller.php";
            if (!file_exists($controllerPath))
                throw new \Exception("controller", 500);

            require_once $controllerPath; 
            $this->controller = $this->route["controller"]; 
            new $this->controller([
                "name" => $this->route["name"],
                "title" => $this->route["title"] ?? null, 
                "route" => $this->route["route"] ?? null, 
                "controller" => $this->route["controller"] ?? null, 
                "controllerPath" =>  str_replace(APP_ROOT, "", $controllerPath),
                "routes" => $this->routesOnNavbar
            ]);
            return true;
        } catch (\Exception $e) {
            $error = new AppController([
                "message" => $this->texts["error"][$e->getMessage()], 
                "code" => $e->getCode(), 
                "name" => "Error " . $e->getCode(),
                "routes" => $this->routesOnNavbar
            ]);
            $availableErrors = [404 => "404"];
            $error->renderView("errors/" . ($availableErrors[$e->getCode()] ?? "error") . ".html.twig");
            return false;
        }
    }
}