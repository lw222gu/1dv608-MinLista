<?php
namespace view;
class LayoutView {
    private $startView;
    private $personalView;
    private $navigationView;


    public function render($output){
        //Let layout view check url and decide whether to start the view for starting a personalized page,
        // or to start the main start page (start view)
        echo'<!DOCTYPE html>
            <html>
                <head>
                    <meta charset="utf-8">
                    <title>I like it!</title>
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
                    <img src="content/css/images/logotype.png" alt="Logotyp för ilikeit.se">
                </header>';
    }
}