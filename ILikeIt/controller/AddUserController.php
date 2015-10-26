<?php
namespace controller;
class AddUserController {

    private $startView;
    private $user;
    private $userDAL;

    public function __construct(){
        $this->startView = new \view\StartView();
        $this->userDAL = new \model\UserDAL();
        $this->saveUser();
    }

    private function saveUser(){
        if($this->startView->didUserPressRegisterButton()){
            $this->user = new \model\User();
            $this->user->setName($this->startView->getName());
            $url = $this->userDAL->saveNewUser($this->user);
            $this->startView->redirect($url);
        }
    }

    /* Gets html output and returns it to MasterController. */
    public function getMainOutput(){
        return $this->startView->renderWelcomeMessage();
    }

    public function getAsideOutput(){
        return $this->startView->renderRegisterForm();
    }
}