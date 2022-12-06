<?php 
namespace Abollinger\PHPStarter\Router;

use \Abollinger\PHPStarter\Config\Helpers;

class Router 
{
    protected $path;
    protected $routes;
    protected $texts;

    /**
     * Base class for any router need
     * 
     * @param string $path          The path required for the router
     * @param string|array $routes  Can be an single string pathname the a yaml file containing the routes OR an array of multiples files pathnames
     * @param string|array $texts   As the routes, this can be a single string pathname the a yaml containing the texts used, OR an arrayof multiples files pathnames
     */
    public function __construct(
        $path = null,
        $routes = null,
        $texts = null
    ) {
        $this->setPath($path);
        $this->setRoutes($routes);
        $this->setTexts($texts);
    }

    /**
     * Set the path use to determine with route will be run
     * 
     * @param string $path  Path of the requested route
     * @return bool true
     */
    protected function setPath(
        $path = null
    ) : bool {
        if ($path === null) return false;
        $this->path = $path;
        return true;
    }

    /**
     * Set a array of the availables routes edited files passed as arguments
     * 
     * @param string|array $routes  String or array of strings of the yaml files paths to set the routes
     * @return bool true
     */
    protected function setRoutes(
        $routes = null
    ) : bool {
        if ($routes === null) return false;
        switch (gettype($routes)) 
        {
            case "string": 
                $this->routes = Helpers::getYaml($routes);
                break;
            case "array": 
                $this->routes = array_merge(...array_map(function($v){
                    return Helpers::getYaml($v);
                }, $routes));
                break;
        }
        return true;
    }

    /**
     * Set a array of the texts set files passed as arguments
     * 
     * @param string|array $texts  String or array of strings of the yaml files paths to set the texts
     * @return bool true
     */
    protected function setTexts(
        $texts = null
    ) : bool {
        if ($texts === null) return false;
        switch (gettype($texts)) 
        {
            case "string": 
                $this->texts = Helpers::getYaml($texts);
                break;
            default: 
                $this->texts = array_merge(...array_map(function($v){
                    return Helpers::getYaml($v);
                }, $texts));
                break;
        }
        return true;
    }
}