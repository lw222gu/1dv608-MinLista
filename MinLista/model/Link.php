<?php

namespace model;
class Link{

    private $link;
    private $id;

    public function __construct($link, $id){
        $this->link = $link;
        $this->id = $id;
    }

    public function getLink(){
        return $this->link;
    }

    public function getId(){
        return $this->id;
    }
}