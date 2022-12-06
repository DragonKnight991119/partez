<?php 
namespace Abollinger\PHPStarter\Router;

use \Abollinger\PHPStarter\Config\Helpers;

class Router 
{
    protected $path;
    protected $routes;
    protected $texts;

    public function __construct(
        $path = "",
        $routesPath = "",
        $textsPath = ""
    ) {
        $this->setPath($path);
        $this->setRoutes($routesPath);
        $this->setTexts($textsPath);
    }

    /**
     * Set the path use to determine with route will be run
     * 
     * @param string $path  Path of the requested route
     * @return bool true
     */
    protected function setPath(
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
    protected function setRoutes(
        $routesPath = ""
    ) : bool {
        $this->routes = Helpers::getYaml($routesPath);
        return true;
    }

    /**
     * Set a array of the texts set in the config/texts.yaml file
     * 
     * @param null
     * @return bool true
     */
    private function setTexts(
        $textsPath = ""
    ) : bool {
        $this->texts = Helpers::getYaml($textsPath);
        return true;
    }
}