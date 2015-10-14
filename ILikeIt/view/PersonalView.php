<?php
namespace view;
class PersonalView {
    private $user;
    public function __construct(\model\User $user){
        $this->user = $user;
    }
    public function showPersonalInformation(){
        return "Personal View";
    }
}