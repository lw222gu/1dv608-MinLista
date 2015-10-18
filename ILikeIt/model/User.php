<?php
namespace model;
class User {

    private $url;
    private $name;
    private $id;

    public function __construct($url = null, $name = null, $id = null){
        if($url != null){
            $this->url = $url;
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

    public function getUserDetails(){
        $name = "Namnet Namnsson";
        return $name;
    }
}