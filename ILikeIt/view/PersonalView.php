<?php
namespace view;
class PersonalView {
    private $url;
    private $user;

    public function __construct(\model\User $user){
        $this->user = $user;
    }

    public function showPersonalInformation($url){
        $this->url = $url;
        return "Välkommen tillbaka " . $this->user->getName() . "!" . $this->renderUserLinks();
    }

    public function renderUserLinks(){
        return "<br />Dina sparade länkar:";
    }
}