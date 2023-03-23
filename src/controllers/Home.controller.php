<?php 
namespace Abollinger\Partez\Controller;

final class HomeController extends AppController
{
    public function init(
        
	) {
        $this->renderView("home.html.twig");
    }
}