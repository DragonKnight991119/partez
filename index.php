<?php 
namespace Abollinger\PHPStarter;

use \Abollinger\PHPStarter\Config\Bootstrap;
use \Abollinger\PHPStarter\Config\Helpers;
use \Abollinger\PHPStarter\Router\Router;

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/config/Bootstrap.class.php";
require_once __DIR__ . "/config/Helpers.class.php";

Bootstrap::setConstants();
Bootstrap::setHtaccess(APP_ROOT, APP_SUBDIR);

require_once APP_CONTROLLER_PATH . "/Controller.class.php";

$router = require_once APP_ROUTER_PATH . "/Router.class.php";
$router->setRoute();
