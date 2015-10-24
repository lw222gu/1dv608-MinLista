<?php

namespace view;
class EditLinksView {

    private $user;

    public function __construct(\model\User $user){
        $this->user = $user;
    }

    public function showPersonalInformation(){
        return  "<p>Hej " . $this->user->getName() . "!
        Här kan du välja att ta bort en länk genom att klicka på den nedan.</p><br />
        <ul id='editLinksList'>" .
        $this->renderUserLinks() . "</ul>" .
        $this->renderBackButton();
    }

    public function renderUserLinks(){
        $response = "";
        $count = 0;
        foreach($this->user->getUserLinks() as $link){
            $query = array('url' => $this->user->getUrl(), 'edit' => true, 'delete' => $count);
            $response .= "<li><a href='?" . http_build_query($query) . "' id='" . $count . "'>" . $link . " [x]</a></li>";
            $count++;
        }
        return $response;
    }

    public function renderBackButton(){
        $query = array('url' => $this->user->getUrl(), 'edit' => false);
        return '<a href="?' . http_build_query($query) . '" id="backLink">Tillbaka</a>';
    }
}