<?php 
namespace Abollinger\PHPStarter\Controller;

class Controller extends FrontendController
{
    public function __construct(
		$params = null
	) {
		parent::__construct($params);
        $this->renderView("about.html.twig", [
            "readme" => $this->renderMd(APP_ROOT . "/README.md")
        ]);
    }
}