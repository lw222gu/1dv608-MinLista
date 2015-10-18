<?php

namespace model;
class UserDAL {

    private $file = "data/users.xml";

    public function __construct(){

    }

    public function saveNewUser(User $user){
        $xml = simplexml_load_file($this->file);
        $id = $user->getId();
        $url = "?" . password_hash($id, PASSWORD_DEFAULT);
        $xmlUser = $xml->addChild('user');
        $xmlUser->addAttribute("id", $id);
        $xmlUser->addAttribute("name", $user->getName());
        $xmlUser->addAttribute("url", $url);
        $xml->asXML($this->file);
    }

    public function getNumberOfUsers(){
        return simplexml_load_file($this->file)->children()->count();
    }
}