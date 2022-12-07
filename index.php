<?php 
namespace Abollinger\Partez;

use Symfony\Component\Dotenv\Dotenv;
use \Abollinger\Partez\Router\AppRouter;

require_once __DIR__ . "/vendor/autoload.php";

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

if (isset($_ENV["APP_ENV"]) && $_ENV["APP_ENV"] === "dev")
    opcache_reset();

/**
 * Calling the config files including main controller & main router that will be extended by each router & contoller
 */
require_once __DIR__ . "/config/bootstrap.php";
require_once APP_CONFIG_PATH . "/helpers.php";
require_once APP_CONFIG_PATH . "/controller.php";
require_once APP_CONFIG_PATH . "/router.php";

/**
 * Call the App Router
 */
require_once APP_ROUTER_PATH . "/App.router.php";

$path = parse_url(str_replace(APP_SUBDIR, "", $_SERVER['REQUEST_URI']), PHP_URL_PATH) ?? "/";
$app = new AppRouter(
    $path, 
    APP_ROOT . "/config/routes.yaml", 
    APP_ROOT . "/config/texts.yaml");
$app->start();
