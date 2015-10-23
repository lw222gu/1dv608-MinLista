<?php
namespace model;
class User {

    private $url;
    private $name;
    private $id;
    private $links;

    public function __construct($url = null){
        if($url != null){
            $this->url = $url;
            $this->id = password_verify($url, PASSWORD_DEFAULT);
        }
    }

    public function setUserInformation($name, $id){
        $this->name = $name;
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function getId(){
        return $this->id;
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
}