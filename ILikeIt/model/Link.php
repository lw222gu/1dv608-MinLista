<?php

namespace model;
class Link{
    private $link;

    public function __construct($link){
        $this->link = $link;
    }

    public function getLink(){
        return $this->link;
    }
}