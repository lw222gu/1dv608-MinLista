<?php

namespace controller;

class MasterController {

    private $output;

    public function __construct(\view\NavigationView $navigationView){
        $isUserLoggedIn = $navigationView->isRegisteredUser();

        if($isUserLoggedIn){
            $uniqueUrl = $navigationView->getUniqueUrl();
            $wantsToEditLinks = false;

            if($navigationView->userWantsToEditLinks()){
                $wantsToEditLinks = true;
            }

            $registeredUserController = new RegisteredUserController($uniqueUrl, $wantsToEditLinks);
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