<?php
namespace controller;
class ShowPersonalizedPageController {
    private $personalView;
    private $user;

    public function __construct(\view\PersonalView $personalView, \model\User $user){
        $this->personalView = $personalView;
        $this->user = $user;
        $this->getUserDetails();
    }

    private function getUserDetails(){
      //  if($this->personalView->isUrlSet()){
            //model...DAL
            $userInformation = $this->user->getUserDetails();
            $this->personalView->setUserDetails($userInformation);
      //  }
    }
}