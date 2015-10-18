<?php
namespace view;
class NavigationView{
    private $startView;
    private $personalView;
    public function __construct(\view\StartView $startView, \view\PersonalView $personalView){
        $this->startView = $startView;
        $this->personalView = $personalView;
    }
    public function isUserLoggedIn(){
        if(strpos($_SERVER['REQUEST_URI'], "?")){
            $url = $_SERVER['REQUEST_URI'];
            $customUrl = substr($url, strpos($url, "?"));
            return $this->personalView->showPersonalInformation($customUrl);
        }
        else {
            return $this->startView->generateRegisterButton();
        }
    }
}