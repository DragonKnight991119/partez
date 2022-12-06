<?php 
namespace Abollinger\PHPStarter\Router;

use \Abollinger\PHPStarter\Controller\FrontendController;

require_once APP_ROOT . "/config/Router.class.php";

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
        $this->routesOnNavbar = array_filter($this->routes, function($value) {return $value["onNavbar"];});
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
            if (!file_exists(APP_CONTROLLER_PATH . "/" . $this->route["controller"]))
                throw new \Exception("controller", 500);

            require_once APP_CONTROLLER_PATH . "/" . $this->route["controller"]; 
            $this->controller = "\\Abollinger\\PHPStarter\\Controller\\Controller"; 
            new $this->controller([
                "route" => $this->route, 
                "routes" => $this->routesOnNavbar
            ]);
            return true;
        } catch (\Exception $e) {
            $error = new FrontendController([
                "message" => $this->texts["error"][$e->getMessage()], 
                "code" => $e->getCode(), 
                "route" => ["name" => "Error " . $e->getCode()],
                "routes" => $this->routesOnNavbar
            ]);
            $availableErrors = [404 => "404"];
            $error->renderView("errors/" . ($availableErrors[$e->getCode()] ?? "error") . ".twig");
            return false;
        }
    }
}