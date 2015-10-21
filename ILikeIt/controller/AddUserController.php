<?php
namespace controller;
class AddUserController {

    private $startView;
    private $user;
    private $userDAL;

    public function __construct(){
        $this->startView = new \view\StartView();
        $this->userDAL = new \model\UserDAL();

        $this->checkUserInput();
    }

    private function checkUserInput(){
        if($this->startView->didUserPressRegisterButton()){
            $this->user = new \model\User();
            $this->user->setUserInformation($this->startView->getName(), $this->userDAL->getNumberOfUsers()+1);
            $url = $this->userDAL->saveNewUser($this->user);
            $this->startView->redirect($url);
        }
    }

    public function getOutput(){
        return $this->startView->generateRegisterForm();
    }
}