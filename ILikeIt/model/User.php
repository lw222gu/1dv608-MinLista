<?php
namespace model;
class User {

    private $isUserSaved = false;

    public function saveUser($name){
        //Using simple xml it wont generate a properly indented xml-file...
        $file = "data/users.xml";
        $xml = simplexml_load_file($file);
        $id = $xml->children()->count() + 1;
        $url = $this->generateRandomUrl($id);
        $user = $xml->addChild('user');
        $user->addAttribute("id", $id);
        $user->addAttribute("name", $name);
        $user->addAttribute("url", $url);
        $xml->asXML($file);
        $this->isUserSaved = true;
    }

    //generate and return random unique link
    public function generateRandomUrl($id){
        $url = "?" . password_hash($id, PASSWORD_DEFAULT);
        return $url;
    }

    public function getIsUserSavedStatus(){
        return $this->isUserSaved;
    }
}