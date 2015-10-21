<?php
namespace controller;

class RegisteredUserController {

    private $uniqueUrl;
    private $userDAL;
    private $user;
    private $personalView;

    public function __construct($uniqueUrl){
        $this->uniqueUrl = $uniqueUrl;
        $this->userDAL = new \model\UserDAL();
        $this->user = $this->userDAL->getUserByUrl($uniqueUrl);
        $this->personalView = new \view\PersonalView($this->user);
    }

    public function getOutPut(){
        return $this->personalView->showPersonalInformation($this->uniqueUrl);
    }

    private function getUserDetails(){
    }
}