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
        if(strpos("$_SERVER[REQUEST_URI]", "?")){
            return $this->personalView->showPersonalInformation();
        }
        else {
            return $this->startView->generateRegisterButton();
        }
    }
}