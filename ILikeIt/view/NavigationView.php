<?php
namespace view;
class NavigationView{

    public function isRegisteredUser(){
       if(isset($_GET['url'])){
            return true;
        }
        return false;
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

    public function getUniqueUrl(){
        return $_GET['url'];
    }
}