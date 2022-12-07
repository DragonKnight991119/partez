<?php 
namespace Abollinger\Partez\Controller;

final class AdminController extends AppController
{
    public function init(

	) {
        $this->renderView("admin.html.twig", [
            "renderedTexts" => $this->renderYaml(APP_ROOT . "/config/texts.yaml"),
            "renderedRoutes" => $this->renderYaml(APP_ROOT . "/config/routes.yaml"),
            "controllers" => $this->renderScan(APP_CONTROLLER_PATH, APP_CONTROLLER_PATH)
        ]);
    }
}