<?php

namespace controller;

class MasterController {

    private $outputMain = "";
    private $outputAside = "";

    public function __construct(\view\NavigationView $navigationView){

        /* Gets information from navigationView to determine whether to run
         * RegisteredUserController or AddUserController, depending on if user exists or not.
         */
        $user = $navigationView->getRegisteredUser();
        if($user != null){
            $registeredUserController = new RegisteredUserController($user, $navigationView->userWantsToEditLinks(), $navigationView->deleteLink());
            $this->outputAside = $registeredUserController->getOutput();

            $listController = new ListController($user, $navigationView->wantsToEditListItems(), $navigationView->deleteListItem());
            $this->outputMain = $listController->getOutput();
        }

        else {
            $addUserController = new AddUserController();
            $this->outputMain = $addUserController->getOutput();
        }

        /* Runs layoutView to render output html */
        $layoutView = new \view\LayoutView();
        $layoutView->render($this->outputMain, $this->outputAside);
    }
}