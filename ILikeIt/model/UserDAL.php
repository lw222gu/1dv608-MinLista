<?php

namespace model;
class UserDAL {

    private $file = "data/users.xml";

    public function saveNewUser(User $user){
        $xml = simplexml_load_file($this->file);
        $url = uniqid();
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
        $xml = simplexml_load_file($this->file);

        for($i = 0; $i < $xml->children()->count(); $i += 1){
            if((string)$xml->children()[$i]['url'] === $url){
                $customUser = new User($url);
                $xmlUser = $xml->children()[$i];

                $j = 0;
                $links = array();
                while($xmlUser->link[$j] != null){
                    $link = new Link((string)$xmlUser->link[$j]['url'], (string)$xmlUser->link[$j]['id']);
                    array_push($links, $link);
                    $j += 1;
                }

                $k = 0;
                $listItems = array();
                while($xmlUser->listItem[$k] != null){
                    $listItem = new ListItem((string)$xmlUser->listItem[$k]['desc'], (string)$xmlUser->listItem[$k]['id']);
                    array_push($listItems, $listItem);
                    $k += 1;
                }

                $customUser->setName((string)$xmlUser['name']);
                $customUser->setUserLinks($links);
                $customUser->setUserListItems($listItems);
                return $customUser;
            }
        }
        return null;
    }

    public function saveLinkByUser(User $user, $url){
        $xml = simplexml_load_file($this->file);

        for($i = 0; $i < $xml->children()->count(); $i += 1){
            if((string)$xml->children()[$i]['url'] === $user->getUrl()){
                $xmlUser = $xml->children()[$i];
                $xmlLink = $xmlUser->addChild('link');
                $xmlLink->addAttribute("url", $url);
                $xmlLink->addAttribute("id", uniqid());
                $xml->asXML($this->file);
            }
        }
    }

    public function deleteLink(User $user, $deleteLink){
        $xml = simplexml_load_file($this->file);

        for($i = 0; $i < $xml->children()->count(); $i += 1) {
            if ((string)$xml->children()[$i]['url'] === $user->getUrl()) {
                $user = $xml->children()[$i];
                for($j = 0; $j < $user->children()->count(); $j += 1) {
                    if((string)$user->children()[$j]['id'] === $deleteLink){
                        unset($user->children()[$j]);
                    }
                }
                $xml->asXML($this->file);
            }
        }
    }

    public function saveListItemByUser(User $user, $listItem){
        $xml = simplexml_load_file($this->file);

        for($i = 0; $i < $xml->children()->count(); $i += 1){
            if((string)$xml->children()[$i]['url'] === $user->getUrl()){
                $xmlUser = $xml->children()[$i];
                $xmlListItem = $xmlUser->addChild('listItem');
                $xmlListItem->addAttribute("desc", $listItem);
                $xmlListItem->addAttribute("id", uniqid());
                $xml->asXML($this->file);
            }
        }
    }

    public function deleteListItem(User $user, $deleteListItem){
        $xml = simplexml_load_file($this->file);

        for($i = 0; $i < $xml->children()->count(); $i += 1) {
            if ((string)$xml->children()[$i]['url'] === $user->getUrl()) {
                $user = $xml->children()[$i];
                for($j = 0; $j < $user->children()->count(); $j += 1) {
                    if((string)$user->children()[$j]['id'] === $deleteListItem){
                        unset($user->children()[$j]);
                    }
                }
                $xml->asXML($this->file);
            }
        }
    }
}