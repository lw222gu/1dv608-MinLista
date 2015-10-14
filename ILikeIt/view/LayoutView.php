<?php
namespace view;
class LayoutView {
    private $startView;
    private $personalView;
    private $navigationView;
    public function __construct(\view\StartView $startView, \view\PersonalView $personalView, \view\NavigationView $navigationView){
        $this->startView = $startView;
        $this->personalView = $personalView;
        $this->navigationView = $navigationView;
    }
    public function render(){
        //Let layout view check url and decide whether to start the view for starting a personalized page,
        // or to start the main start page (start view)
        echo'<!DOCTYPE html>
            <html>
                <head>
                    <meta charset="utf-8">
                    <title>I like it!</title>
                </head>
        <body>
        <h1>I like it!</h1>
          ' . $this->navigationView->isUserLoggedIn() . '
         </body>
      </html>
    ';
    }
}