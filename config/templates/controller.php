<?php 
namespace Abollinger\PHPStarter\Controller;

class Controller extends FrontendController
{
    public function __construct(
		$params = null
	) {
		parent::__construct($params);
        $this->renderView("template.html.twig");
    }
}