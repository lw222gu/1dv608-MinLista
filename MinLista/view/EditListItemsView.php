<?php

namespace view;
class EditListItemsView {

    private $user;

    public function __construct(\model\User $user){
        $this->user = $user;
    }

    public function showPersonalInformation(){
        return "<p>Här kan du välja att ta bort något ur listan genom att klicka på det nedan.</p><br />
        <ul id='editListItemsList'>" .
        $this->renderUserListItems() .
        "</ul>" .
        $this->renderBackButton();
    }

    public function renderUserListItems(){
        $response = "";
        $userListItems = $this->user->getUserListItems();
        asort($userListItems);
        foreach($userListItems as $listItem){
            $query = array('url' => $this->user->getUrl(), 'editItem' => true, 'deleteItem' => $listItem->getId());
            $response .= "<li><a href='?" . http_build_query($query) . "'>" . $listItem->getDescription() . " [x]</a></li>";
        }
        return $response;
    }

    public function renderBackButton(){
        $query = array('url' => $this->user->getUrl(), 'editItem' => false);
        return '<a href="?' . http_build_query($query) . '" id="backLink">Tillbaka</a>';
    }
}