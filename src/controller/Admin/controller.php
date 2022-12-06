<?php 
namespace Abollinger\PHPStarter\Controller;

class Controller extends FrontendController
{
    public function __construct(
		$params = null
	) {
		parent::__construct($params);
        $this->renderView("admin.html.twig", [
            "renderedTexts" => $this->renderYaml(APP_ROOT . "/config/texts.yaml"),
            "renderedRoutes" => $this->renderYaml(APP_ROOT . "/config/routes.yaml"),
            "controllers" => $this->renderScan(APP_CONTROLLER_PATH, APP_CONTROLLER_PATH)
        ]);
    }
}