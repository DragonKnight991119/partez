<?php 
namespace Abollinger\PHPStarter\Controller;

use \Abollinger\PHPStarter\Config\Helpers;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use \Twig\Extra\Html\HtmlExtension;
use \Twig\Extra\Intl\IntlExtension;
use \Twig\Extension\DebugExtension;

class FrontendController 
{
    private $twig;
    public $params;

    public function __construct(
        $params = null
    ) {
        $this->params = $params;
        $this->setTwig();
    }

    /**
     * Sets the Twig instance that will render the HTML page. Also sets some globals variables that can be used in the twig's templates
     * 
     * @param string|boolean $cache The directory for the cache. Default is set to false (no cache used)
     * @return bool true
     */
    private function setTwig(
        $cache = false
    ) : bool {
        $loader = new FilesystemLoader(APP_MODEL_PATH);
        $this->twig = new Environment($loader, [
            "cache" => $cache,
            "debug" => true
        ]);
        $this->twig->addExtension(new HtmlExtension());
        $this->twig->addExtension(new DebugExtension());
        $this->twig->addExtension(new IntlExtension());
        $this->twig->addGlobal("app_title", APP_TITLE);
        $this->twig->addGlobal("app_subdir", APP_SUBDIR);
        $this->twig->addGlobal("_params", $this->params);
        return true;
    }

    /**
     * Render a HTML view based on twig's templates. 
     * 
     * @param string $file  Name of the twig file to be rendered
     * @param array $params An array of variables passes to the twig template
     * @return bool 
     */
    public function renderView(
        $file = "",
        $params = []
    ) : bool {
        try {
            if (!file_exists(APP_MODEL_PATH . "/views/" . $file)) {
                throw new \Exception("model", 500);
            }
			echo $this->twig->render("views/" . $file, $params);
            return true;
        } catch(Exception $e) {
			throw new \Exception($e);
            return false;
		}
    }

    /**
     * Public function to render a Markdown written file. Based on erusev/parsedown package.
     * 
     * @param string $file      Name of the Markdown file to be read
     * @return string|bool   Return a HTML string of the file or false if an error occured.
     */
    public function renderMd(
		$file = ""
	) {
        try {
            if (!file_exists($file)) {
                throw new \Exception("file", 500);
            }
            $text = file_get_contents($file);
            $text = str_replace("public/images", APP_SUBDIR."/public/images", $text);
            $Parsedown = new \Parsedown();
            return $Parsedown->text($text);
        } catch(Exception $e) {
			throw new \Exception($e);
            return false;
		}
	}

    /**
     * Public function to render a Yaml written file as a HTML list. Based on Helpers::getYaml & Helpers::printArray functions.
     * 
     * @param string $file      Name of the Markdown file to be read
     * @return string|bool   Return a HTML string of the file or false if an error occured.
     */
    public function renderYaml(
        $file = ""
    ) {
        try {
            if (!file_exists($file)) {
                throw new \Exception("file", 500);
            }
            $text = Helpers::getYaml($file);
            return Helpers::printArray($text);
        } catch(Exception $e) {
			throw new \Exception($e);
            return false;
		}
    }

        /**
     * Public function to render a directoryu Scan as an HTML list. Based on Helpers::getYaml & Helpers::printArray functions.
     * 
     * @param string $file      Name of the Markdown file to be read
     * @return string|bool   Return a HTML string of the file or false if an error occured.
     */
    public function renderScan(
        $file = "",
        $root = ""
    ) {
        try {
            if (!file_exists($file)) {
                throw new \Exception("file", 500);
            }
            $text = Helpers::getScan($file, $root);
            return Helpers::printArray($text);
        } catch(Exception $e) {
			throw new \Exception($e);
            return false;
		}
    }
}
