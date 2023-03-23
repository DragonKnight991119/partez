<?php 
namespace Abollinger\Partez\Controller;

final class AboutController extends AppController
{
    public function init(

        ) {
        $this->renderView("about.html.twig", [
            "readme" => $this->renderMd(APP_ROOT . "/README.md")
        ]);
    }
}