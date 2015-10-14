<?php
namespace controller;
class AddUserController {
    private $startView;
    private $user;
    public function __construct(\view\StartView $startView, \model\User $user){
        $this->startView = $startView;
        $this->user = $user;
        $this->checkUserInput();
    }
    private function checkUserInput(){
        if($this->startView->didUserPressRegisterButton()){
            $this->user->saveUser($this->startView->getName());
            $this->startView->setIsUserSaved($this->user->getIsUserSavedStatus());
        }
    }
}