<?php 
namespace Abollinger\PHPStarter\Router;

use \Abollinger\PHPStarter\Config\Helpers;
use \Abollinger\PHPStarter\Controller\FrontendController;

class Router 
{
    private $path;
    private $route;
    private $routes;
    private $routesOnNavbar;
    private $controller;
    private $texts;

    public function __construct(
        $path = ""
    ) {
        $this->setPath($path);
        $this->setRoutes();
        $this->setTexts();
    }

    /**
     * Set the path use to determine with route will be run
     * 
     * @param string $path  Path of the requested route
     * @return bool true
     */
    private function setPath(
        $path = ""
    ) : bool {
        $this->path = $path;
        return true;
    }

    /**
     * Set a array of the availables routes edited in the config/routes.yaml file
     * 
     * @param null
     * @return bool true
     */
    private function setRoutes(
        $params = null
    ) : bool {
        $this->routes = Helpers::getYaml(APP_ROOT . "/config/routes.yaml");
        $this->routesOnNavbar = array_filter($this->routes, function($value) {return $value["onNavbar"];});
        return true;
    }

    /**
     * Set a array of the texts set in the config/texts.yaml file
     * 
     * @param null
     * @return bool true
     */
    private function setTexts(
        $params = null
    ) : bool {
        $this->texts = Helpers::getYaml(APP_ROOT . "/config/texts.yaml");
        return true;
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