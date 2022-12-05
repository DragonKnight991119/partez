<?php 
namespace Abollinger\PHPStarter;

use \Abollinger\PHPStarter\Router\Router;

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/config/Bootstrap.class.php";
require_once __DIR__ . "/config/Helpers.class.php";

require_once APP_CONTROLLER_PATH . "/Controller.class.php";
require_once APP_ROUTER_PATH . "/Router.class.php";

$path = parse_url(str_replace(APP_SUBDIR, "", $_SERVER['REQUEST_URI']), PHP_URL_PATH) ?? "/";
$app = new Router($path);
$app->start();
