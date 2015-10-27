<?php

namespace view;
class NavigationView{

    public function getRegisteredUser(){
       if(isset($_GET['url'])){
           $userDAL = new \model\UserDAL();
           $user = $userDAL->getUserByUrl($_GET['url']);
           return $user; /* If url doesn´t match a valid user, $user will be set to null in UserDAL. */
       }
        return null;
    }

    public function userWantsToEditLinks(){
        if(isset($_GET['editLink']) && $_GET['editLink'] == true){
            return true;
        }
        return false;
    }

    public function deleteLink(){
        if(isset($_GET['deleteLink'])){
            return $_GET['deleteLink'];
        }
        return null;
    }

    public function userWantsToEditListItems(){
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