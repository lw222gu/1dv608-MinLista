<?php

namespace controller;

class MasterController {

    private $output;

    public function __construct(\view\NavigationView $navigationView){
        $isUserLoggedIn = $navigationView->isRegisteredUser();

        if($isUserLoggedIn){
            $uniqueUrl = $navigationView->getUniqueUrl();
            $registeredUserController = new RegisteredUserController($uniqueUrl, $navigationView->userWantsToEditLinks(), $navigationView->deleteLink());
            $this->output = $registeredUserController->getOutput();
        }

        else {
            $addUserController = new AddUserController();
            $this->output = $addUserController->getOutput();
        }

        $layoutView = new \view\LayoutView();
        $layoutView->render($this->output);
    }
}