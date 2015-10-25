<?php

namespace controller;

class MasterController {

    private $output;

    public function __construct(\view\NavigationView $navigationView){

        /* Gets information from navigationView to determine whether to run
         * RegisteredUserController or AddUserController, depending on $_GET from url.
         */
        if($navigationView->isRegisteredUser()){
            $uniqueUrl = $navigationView->getUniqueUrl();
            $registeredUserController = new RegisteredUserController($uniqueUrl, $navigationView->userWantsToEditLinks(), $navigationView->deleteLink());
            $this->output = $registeredUserController->getOutput();
        }

        else {
            $addUserController = new AddUserController();
            $this->output = $addUserController->getOutput();
        }

        /* Runs layoutView to render output html */
        $layoutView = new \view\LayoutView();
        $layoutView->render($this->output);
    }
}