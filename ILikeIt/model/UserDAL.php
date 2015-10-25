<?php

namespace model;
class UserDAL {

    private $file = "data/users.xml";

    public function saveNewUser(User $user){
        $xml = simplexml_load_file($this->file);
        $url = "?" . uniqid();
        $xmlUser = $xml->addChild('user');
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
                $xmlUser = $xml->children()[$i];

                $j = 0;
                $links = array();
                while($xmlUser->link[$j] != null){
                    $link = new Link((string)$xmlUser->link[$j]['url']);
                    array_push($links, $link->getLink());
                    $j += 1;
                }
                $customUser->setName((string)$xmlUser['name']);
                $customUser->setUserLinks($links);
            }
        }
        return $customUser;
    }

    public function saveLinkByUser(User $user, $url){
        $xml = simplexml_load_file($this->file);

        for($i = 0; $i < $xml->children()->count(); $i += 1){
            if((string)$xml->children()[$i]['url'] === $user->getUrl()){
                $xmlUser = $xml->children()[$i];
                $xmlLink = $xmlUser->addChild('link');
                $xmlLink->addAttribute("url", $url);
                $xml->asXML($this->file);
            }
        }
    }

    public function deleteLink(User $user, $deleteLink){
        $xml = simplexml_load_file($this->file);

        for($i = 0; $i < $xml->children()->count(); $i += 1) {
            if ((string)$xml->children()[$i]['url'] === $user->getUrl()) {
                $user = $xml->children()[$i];
                unset($user->children()[(int)$deleteLink]);
                $xml->asXML($this->file);
            }
        }
    }
}