<?php
namespace model;
class User {

    private $url;
    private $name;
    private $links;
    private $listItems;

    public function __construct($url = null){
        if($url != null){
            $this->url = $url;
        }
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function getUrl(){
        return $this->url;
    }

    public function setUserLinks($links){
        $this->links = $links;
    }

    public function getUserLinks(){
        return $this->links;
    }

    public function setUserListItems($listItems){
        $this->listItems = $listItems;
    }

    public function getUserListItems(){
        return $this->listItems;
    }
}