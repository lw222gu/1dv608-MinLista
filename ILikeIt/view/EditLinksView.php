<?php

namespace view;
class EditLinksView {

    private $user;

    public function __construct(\model\User $user){
        $this->user = $user;
    }

    public function showPersonalInformation(){
        return "<p>Här kan du välja att ta bort en länk genom att klicka på den nedan.</p><br />
        <ul id='editLinksList'>" .
            $this->renderUserLinks() .
        "</ul>" .
        $this->renderBackButton();
    }

    public function renderUserLinks(){
        $response = "";
        $userLinks = $this->user->getUserLinks();
        asort($userLinks);
        foreach($userLinks as $link){
            $query = array('url' => $this->user->getUrl(), 'edit' => true, 'delete' => $link->getId());
            $response .= "<li><a href='?" . http_build_query($query) . "'>" . $link->getLink() . " [x]</a></li>";
        }
        return $response;
    }

    public function renderBackButton(){
        $query = array('url' => $this->user->getUrl(), 'edit' => false);
        return '<a href="?' . http_build_query($query) . '" id="backLink">Tillbaka</a>';
    }
}