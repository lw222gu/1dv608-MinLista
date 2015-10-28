<?php

namespace view;
class PersonalListView {

    private static $listItem = 'PersonalListView::listItem';
    private static $addListItem = 'PersonalListView::addListItem';
    private static $editListItem = 'PersonalListView::editListItem';

    private $user;
    private $listItemLabelMessage = "Lägg till något till listan:";

    public function __construct(\model\User $user){
        $this->user = $user;
    }

    public function didUserPressAddListItemButton(){
        if(isset($_POST[self::$addListItem])){
            return true;
        }
        return false;
    }

    public function getListItem(){
        $listItem = strip_tags($_POST[self::$listItem]);
        return $listItem;
    }

    public function setErrorMessage(){
        $this->listItemLabelMessage = "Du angav inte något innehåll. Prova igen!";
    }

    public function showPersonalInformation(){
        $userName = $this->user->getName();
        if($userName != ""){
            $userName = " " . $userName;
        }

        return "<p>Hej" . $userName . "! Här hittar du din lista och din länksamling.</p>" .
        $this->renderAddLinkForm() .
        "<ul id='listItemsList'>" .
        $this->renderUserListItems() . "</ul>" .
        $this->renderEditListItemsButton();
    }

    public function renderAddLinkForm(){
        return '<form method="post" >
                    <label for="' . self::$listItem . '" id="listItemLabel">' . $this->listItemLabelMessage . '</label>
                    <input type="input" name ="' . self::$listItem . '" id="listItemInput" value="" />
                    <input type="submit" name="' . self::$addListItem . '" id="addListItemButton" value="Spara" />
                </form>
        ';
    }

    public function renderUserListItems(){
        $response = "";
        $userListItems = $this->user->getUserListItems();
        asort($userListItems);

        if($userListItems != null){
            foreach($userListItems as $listItem){
                $response .= "<li>" . $listItem->getDescription() . "</li>";
            }
        }
        else {
            $response = '<p>Du har inte sparat något i listan ännu. Lägg till poster ovan.</p>';
        }
        return $response;
    }

    /* Edit button should only appear if user has saved list items. */
    public function renderEditListItemsButton(){
        if($this->user->getUserListItems() != null){
            $query = array('url' => $this->user->getUrl(), 'editItem' => true);
            return '<a href="?' . http_build_query($query) . '" name="' . self::$editListItem . '" id="editListItem">Redigera listan</a>';
        }
        return "";
    }

    /* Redirects and sets query string with unique url. */
    public function redirect(){
        $actualLink = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $query = array('url' => $this->user->getUrl());
        header("Location: $actualLink" . "?" . http_build_query($query));
    }
}