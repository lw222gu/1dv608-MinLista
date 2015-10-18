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

    public function getUserByUrl($url){
        $customUser = new User($url);
        $xml = simplexml_load_file($this->file);

        foreach($xml->children() as $user) {
            if($user['url'] == $url){
                $customUser->setUserInformation($user['name'], $user['id']);
                break;
            }
        }
        return $customUser;
    }
}