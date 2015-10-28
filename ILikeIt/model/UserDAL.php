<?php

namespace model;
class UserDAL {

    private $file = "data/users.xml";
    private static $urlAttr = 'url';
    private static $idAttr = 'id';
    private static $nameAttr = 'name';
    private static $descAttr = 'desc';
    private static $userElement = 'user';
    private static $linkElement = 'link';
    private static $listItemElement = 'listItem';

    public function saveNewUser(User $user){
        $xml = simplexml_load_file($this->file);
        $url = uniqid();
        $xmlUser = $xml->addChild(self::$userElement);
        $xmlUser->addAttribute(self::$nameAttr, $user->getName());
        $xmlUser->addAttribute(self::$urlAttr, $url);
        $xml->asXML($this->file);

        return $url;
    }

    public function getNumberOfUsers(){
        return simplexml_load_file($this->file)->children()->count();
    }

    public function getUserByUrl($url){
        $xml = simplexml_load_file($this->file);

        for($i = 0; $i < $xml->children()->count(); $i += 1){
            /* Finds actual user in xml-file and creates user object. */
            if((string)$xml->children()[$i][self::$urlAttr] === $url){
                $customUser = new User($url);
                $xmlUser = $xml->children()[$i];

                /* Create user link objects, and push to list. */
                $j = 0;
                $links = array();
                while($xmlUser->link[$j] != null){
                    $link = new Link((string)$xmlUser->link[$j][self::$urlAttr], (string)$xmlUser->link[$j][self::$idAttr]);
                    array_push($links, $link);
                    $j += 1;
                }

                /* Create user list items objects, and push to list. */
                $k = 0;
                $listItems = array();
                while($xmlUser->listItem[$k] != null){
                    $listItem = new ListItem((string)$xmlUser->listItem[$k][self::$descAttr], (string)$xmlUser->listItem[$k][self::$idAttr]);
                    array_push($listItems, $listItem);
                    $k += 1;
                }

                /* Sets user object attributes, and returns user. */
                $customUser->setName((string)$xmlUser[self::$nameAttr]);
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
            /* Finds actual user in xml-file and adds link element. */
            if((string)$xml->children()[$i][self::$urlAttr] === $user->getUrl()){
                $xmlUser = $xml->children()[$i];
                $xmlLink = $xmlUser->addChild(self::$linkElement);
                $xmlLink->addAttribute(self::$urlAttr, $url);
                $xmlLink->addAttribute(self::$idAttr, uniqid());
                $xml->asXML($this->file);
            }
        }
    }

    public function deleteLink(User $user, $deleteLink){
        $xml = simplexml_load_file($this->file);

        for($i = 0; $i < $xml->children()->count(); $i += 1) {
            /* Finds actual user in xml-file and deletes link element. */
            if ((string)$xml->children()[$i][self::$urlAttr] === $user->getUrl()) {
                $user = $xml->children()[$i];
                for($j = 0; $j < $user->children()->count(); $j += 1) {
                    if((string)$user->children()[$j][self::$idAttr] === $deleteLink){
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
            /* Finds actual user in xml-file and adds list item element. */
            if((string)$xml->children()[$i][self::$urlAttr] === $user->getUrl()){
                $xmlUser = $xml->children()[$i];
                $xmlListItem = $xmlUser->addChild(self::$listItemElement);
                $xmlListItem->addAttribute(self::$descAttr, $listItem);
                $xmlListItem->addAttribute(self::$idAttr, uniqid());
                $xml->asXML($this->file);
            }
        }
    }

    public function deleteListItem(User $user, $deleteListItem){
        $xml = simplexml_load_file($this->file);

        for($i = 0; $i < $xml->children()->count(); $i += 1) {
            /* Finds actual user in xml-file and deletes list item element. */
            if ((string)$xml->children()[$i][self::$urlAttr] === $user->getUrl()) {
                $user = $xml->children()[$i];
                for($j = 0; $j < $user->children()->count(); $j += 1) {
                    if((string)$user->children()[$j][self::$idAttr] === $deleteListItem){
                        unset($user->children()[$j]);
                    }
                }
                $xml->asXML($this->file);
            }
        }
    }
}