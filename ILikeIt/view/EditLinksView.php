<?php

namespace view;
class EditLinksView {

    private $user;

    public function __construct(\model\User $user){
        $this->user = $user;
    }

    public function renderUserLinks(){
        $response = "";
        foreach($this->user->getUserLinks() as $link){
            $response .= "<li>" . $link . "<a href=''>[x]</a></li>";
        }
        return $response;
    }
}