<?php

namespace model;
class ListItem {

    private $description;
    private $id;

    public function __construct($description, $id){
        $this->description = $description;
        $this->id = $id;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getId(){
        return $this->id;
    }
}