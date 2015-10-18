<?php
namespace view;
class PersonalView {
    private $url;
    private $customUser;
    private $userDAL;

    public function __construct(\model\UserDAL $userDAL){
        $this->userDAL = $userDAL;
    }
    public function showPersonalInformation($url){
        $this->url = $url;
        $this->customUser = $this->userDAL->getUserByUrl($this->url);
        return "Välkommen tillbaka " . $this->customUser->getName() . "!" . $this->renderUserLinks();
    }

    public function renderUserLinks(){
        return "<br />Dina sparade länkar:";
    }
}