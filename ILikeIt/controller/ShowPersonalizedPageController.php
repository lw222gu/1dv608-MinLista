<?php
namespace controller;
class ShowPersonalizedPageController {
    private $personalView;
    private $user;
    public function __construct(\view\PersonalView $personalView, \model\User $user){
        $this->personalView = $personalView;
        $this->user = $user;
    }
}