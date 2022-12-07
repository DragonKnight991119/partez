<?php
namespace Abollinger\Partez\Config;

define("APP_ROOT", dirname(__DIR__));

class Bricolo
{
    private $method;
    private $params;

    public function __construct(
        $argc,
        $argv
    ) {
        try {
            if (!$argc || $argc < 3) {
                throw new \Exception('No argument. Please pass argument.');
            }
            array_shift($argv);
            $this->method = array_shift($argv);
            $this->params = $argv ?? [];
            if (!method_exists($this, $this->method)) {
                throw new \Exception('The method '.$this->method.' does not exist.');
            }
            $this->{$this->method}($this->params);
        } catch (\Exception $e) {
            echo $e->getMessage();
        } 
    }

    private function addpage(
        $params = []
    ) {
        try {
            if ($params[0] === "") {
                throw new Exception("Please give a name to your page");
            }
            $ucName = ucfirst($params[0]);
            $name = strtolower($params[0]);

            $controllerPath = APP_ROOT . "/src/controller/" . $ucName . ".controller.php";
            
            echo "Creating a new page named " . $ucName . "\r\n";
            copy(APP_ROOT . "/bricolo/templates/controller.php", $controllerPath);
            echo "Page " . $ucName . " created!\r\nPlease edit " . $controllerPath . "/controller.php" . " to configure this new page.\r\nIf you're using the routes.yaml file for the router, don't forget to add this new page in it.";
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        } 
    }
}

new Bricolo($argc, $argv);