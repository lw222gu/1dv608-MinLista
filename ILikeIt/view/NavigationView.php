<?php
namespace view;
class NavigationView{

    public function getRegisteredUser(){
       if(isset($_GET['url'])){
           $userDAL = new \model\UserDAL();
           $user = $userDAL->getUserByUrl($_GET['url']);
           return $user;
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
}