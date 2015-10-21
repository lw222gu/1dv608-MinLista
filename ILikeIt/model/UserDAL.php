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

        return $url;
    }

    public function getNumberOfUsers(){
        return simplexml_load_file($this->file)->children()->count();
    }

    public function getUserByUrl($url){
        $customUser = new User($url);
        $xml = simplexml_load_file($this->file);

        for($i = 0; $i < $xml->children()->count(); $i += 1){
            if((string)$xml->children()[$i]['url'] === $url){
                $customUser->setUserInformation((string)$xml->children()[$i]['name'], (string)$xml->children()[$i]['id']);
            }
        }
        return $customUser;

        /*foreach($xml->children() as $user) {
            if(strcmp($user['url'], $url)){
                $customUser->setUserInformation($user['name'], $user['id']);
                return $customUser;
            }
        }*/
    }
}