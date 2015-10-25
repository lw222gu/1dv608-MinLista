<?php
namespace view;
class LayoutView {
    private $startView;
    private $personalView;
    private $navigationView;


    public function render($output){
        echo'<!DOCTYPE html>
            <html>
                <head>
                    <meta charset="utf-8">
                    <title>Min lista</title>
                    <link rel="stylesheet" href="content/css/style.css" />
                </head>
                <body>
                    <main>
                        ' . $this->renderHeader() . '
                        ' . $output . '
                    </main>
                 </body>
              </html>
            ';
    }

    public function renderHeader(){
        return '<header>
                    <img src="content/css/images/logotype.svg" alt="Logotyp för minlista.se">
                </header>';
    }
}