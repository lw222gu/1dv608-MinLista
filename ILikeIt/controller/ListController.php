<?php

namespace controller;
class ListController {

    private $output;
    private $user;
    private $listItem;

    public function __construct(\model\User $user, $wantsToEditListItems, $deleteListItem){
        $this->userDAL = new \model\UserDAL();
        $this->user = $user;

        /*
         * wantsToEditListItems status from masterController decides
         * whether to display editLinksView or personalView
         */
        if($wantsToEditListItems){
            if($deleteListItem != null){
                /* deleteListItem contains an id of which listItem to delete */
                $this->userDAL->deleteListItem($this->user, $deleteListItem);
                $this->user = $this->userDAL->getUserByUrl($this->user->getUrl());
            }
            $editListItemsView = new \view\EditListItemsView($this->user);
            $this->output = $editListItemsView->showPersonalInformation();
        }

        else{
            $personalListView = new \view\PersonalListView($this->user);

            try{
                if($personalListView->didUserPressAddListItemButton()){
                    $this->listItem = $personalListView->getListItem();

                    if($this->listItem != null){
                        $this->saveListItem();
                        $personalListView->redirect();
                    }
                    else {
                        throw new \Exception();
                    }
                }
            }
            catch(\Exception $e){
                $personalListView->setErrorMessage();
            }
            $this->output = $personalListView->showPersonalInformation();
        }
    }

    public function saveListItem(){
        $this->userDAL->saveListItemByUser($this->user, $this->listItem);
    }

    /* Returns HTML-output to MasterController. */
    public function getOutput(){
        return $this->output;
    }
}