<?php

namespace controller;

class MasterController {

    private $mainOutput = "";
    private $asideOutput = "";

    public function __construct(\view\NavigationView $navigationView){

        /*
         * Gets information from navigationView to determine whether to run
         * LinkController or AddUserController, depending on if user exists or not.
         */
        $user = $navigationView->getRegisteredUser();

        if($user != null){
            $linkController = new LinkController($user, $navigationView->userWantsToEditLinks(), $navigationView->deleteLink());
            $this->asideOutput = $linkController->getOutput();

            $listController = new ListController($user, $navigationView->userWantsToEditListItems(), $navigationView->deleteListItem());
            $this->mainOutput = $listController->getOutput();
        }

        else {
            $addUserController = new AddUserController();
            $this->mainOutput = $addUserController->getMainOutput();
            $this->asideOutput = $addUserController->getAsideOutput();
        }

        /* Runs layoutView to render output html */
        $layoutView = new \view\LayoutView();
        $layoutView->render($this->mainOutput, $this->asideOutput);
    }
}