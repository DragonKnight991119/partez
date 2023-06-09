<?php
namespace Abollinger\Partez\Config;

/**
 * Bootstrap for the web app
 * 
 * Abstract class that allow to define the constants for the app
 */
abstract class Bootstrap 
{
    /**
     * Set the constants for the all app
     * 
     * @param null
     * @return boolean
     */
    static public function setConstants(
        $params = null
    ) : bool {
        // APP TITLE
        // 📌 The best way to define the title of your app is to create a APP_TITLE variable in a .env file at the root of the project. But you can also define the title here
        define("APP_TITLE", $_ENV["APP_TITLE"] ?? "title");

        // APP Paths contants used in the app
        // 🚨 If you change this constants, the app may have bugs. Please be sure of what you're doing when manipulating this constants.
        define("APP_ROOT", str_replace("\\", "/", dirname(__DIR__)));
        define("APP_SUBDIR", str_replace(str_replace("\\", "/",$_SERVER["DOCUMENT_ROOT"]), "", APP_ROOT));
        define("APP_CONFIG_PATH", __DIR__);
        define("APP_YAML_PATH", APP_CONFIG_PATH . "/yaml");
        define("APP_MODEL_PATH", APP_ROOT . "/src/models");
        define("APP_CONTROLLER_PATH", APP_ROOT . "/src/controllers"); 
        define("APP_ROUTER_PATH", APP_ROOT . "/src/router");
        define("APP_TEMPLATES_PATH", APP_ROOT . "/templates");

        // API constants
        define("API_URL", str_replace("\\", "/", dirname(__DIR__) . "/api"));
        return true;
    }

    /**
     * Set sub-directory in .htaccess for Apache server (useless when running php -S)
     * 
     * @param string $app_root Root of the app server
     * @param string app_subdir Sub-directory when app is not on the server root
     * 
     * @return boolean  
     */
    static public function setHtaccess(
		$app_root = "",
		$app_subdir = ""
	) : bool {
		$fp = fopen($app_root . "/.htaccess", "w");
		fwrite($fp, "RewriteEngine On
RewriteCond %{REQUEST_URI} !^".$app_subdir."/public [NC]
RewriteCond %{REQUEST_URI} !^".$app_subdir."/api [NC]
RewriteRule . index.php [L,QSA]");
		fclose($fp);
        return true;
	}
}

Bootstrap::setConstants();
Bootstrap::setHtaccess(APP_ROOT, APP_SUBDIR);