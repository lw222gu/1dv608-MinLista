<?php
namespace controller;
class AddUserController {

    private $startView;
    private $user;
    private $userDAL;

    public function __construct(\view\StartView $startView, \model\User $user, \model\UserDAL $userDAL){
        $this->startView = $startView;
        $this->user = $user;
        $this->userDAL = $userDAL;
        $this->checkUserInput();
    }

    private function checkUserInput(){
        if($this->startView->didUserPressRegisterButton()){
            $this->user->setUserInformation($this->startView->getName(), $this->userDAL->getNumberOfUsers()+1);
            $this->userDAL->saveNewUser($this->user);
            $this->startView->redirect();
        }
    }
}