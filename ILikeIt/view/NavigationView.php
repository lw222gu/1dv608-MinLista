<?php
namespace view;
class NavigationView{

    public function isRegisteredUser(){
        if(strpos($_SERVER['REQUEST_URI'], "?")) {
            return true;
        }
        return false;
    }

    public function getUniqueUrl(){
        $url = $_SERVER['REQUEST_URI'];
        return substr($url, strpos($url, "?"));
    }
}