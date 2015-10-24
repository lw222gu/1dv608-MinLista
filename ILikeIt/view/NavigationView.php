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
        if(isset($_GET['edit'])){
            return true;
        }
        return false;
    }

    public function getUniqueUrl(){
        return $_GET['url'];
    }
}