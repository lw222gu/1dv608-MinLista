<?php

namespace view;
class NavigationView{

    public function getRegisteredUser(){
       if(isset($_GET['url'])){
           $userDAL = new \model\UserDAL();
           $user = $userDAL->getUserByUrl($_GET['url']);
           return $user; /* If url doesn´t match a valid user, $user will be null. */
       }
        return null;
    }

    public function userWantsToEditLinks(){
        if(isset($_GET['edit']) && $_GET['edit'] == true){
            return true;
        }
        return false;
    }

    public function deleteLink(){
        if(isset($_GET['delete'])){
            return $_GET['delete'];
        }
        return null;
    }

    //NYTT!!!
    public function wantsToEditListItems(){
        if(isset($_GET['editItem']) && $_GET['editItem'] == true){
            return true;
        }
        return false;
    }

    public function deleteListItem(){
        if(isset($_GET['deleteItem'])){
            return $_GET['deleteItem'];
        }
        return null;
    }
}