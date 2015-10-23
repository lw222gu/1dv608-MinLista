<?php
namespace controller;

class RegisteredUserController {

    private $uniqueUrl;
    private $userDAL;
    private $user;
    private $personalView;
    private $link;

    public function __construct($uniqueUrl){
        $this->uniqueUrl = $uniqueUrl;
        $this->userDAL = new \model\UserDAL();
        $this->user = $this->userDAL->getUserByUrl($uniqueUrl);
        $this->personalView = new \view\PersonalView($this->user);

        if($this->personalView->didUserPressAddLinkButton()){
            $this->link = $this->personalView->getLink();
            $this->saveLink();
        }
    }

    public function saveLink(){
        $this->userDAL->saveLinkByUser($this->user, $this->link);
    }

    public function getOutPut(){
        return $this->personalView->showPersonalInformation($this->uniqueUrl);
    }

    private function getUserDetails(){
    }
}