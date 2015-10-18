<?php
namespace view;
class PersonalView {
    private $user;
    private $url;
    private $userInformation;

    public function __construct(){
    }
    public function showPersonalInformation($url){
        $this->url = $url;
        return "Personal View" . $this->userInformation;
    }

    public function isUrlSet(){
        if($this->url == null){
            return false;
        }
        return true;
    }

    public function setUserDetails($userInformation){
        $this->userInformation = $userInformation;
    }
}