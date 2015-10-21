<?php

namespace controller;

class MasterController {

    private $output;

    public function __construct(\view\NavigationView $navigationView){
        $isUserLoggedIn = $navigationView->isRegisteredUser();

        if($isUserLoggedIn){
            $uniqueUrl = $navigationView->getUniqueUrl();
            $registeredUserController = new RegisteredUserController($uniqueUrl);
            $this->output = $registeredUserController->getOutput($uniqueUrl);
        }

        else {
            $addUserController = new AddUserController();
            $this->output = $addUserController->getOutput();
        }

        $layoutView = new \view\LayoutView();
        $layoutView->render($this->output);
    }

    //Blir controllrarna globala om jag inte spar dom i variabler, eller kan jag bara köra new ..?
}