<?php
namespace controller;

class RegisteredUserController {

    private $uniqueUrl;
    private $userDAL;
    private $user;
    private $personalView;
    private $link;
    private $output;

    public function __construct($uniqueUrl, $wantsToEditLinks, $deleteLink){
        $this->uniqueUrl = $uniqueUrl;
        $this->userDAL = new \model\UserDAL();
        $this->user = $this->userDAL->getUserByUrl($uniqueUrl);

        /*
         * wantsToEditLinks status from masterController decides
         * whether to display editLinksView or personalView
         */
        if($wantsToEditLinks){
            if($deleteLink != null){
                /* deleteLink contains an index of which link to delete */
                $this->userDAL->deleteLink($this->user, $deleteLink);
                $this->user = $this->userDAL->getUserByUrl($this->user->getUrl());
            }
            $editLinksView = new \view\EditLinksView($this->user);
            $this->output = $editLinksView->showPersonalInformation();
        }

        else{
            $this->personalView = new \view\PersonalView($this->user);
            $this->output = $this->personalView->showPersonalInformation();

            if($this->personalView->didUserPressAddLinkButton()){
                $this->link = $this->personalView->getLink();
                $this->saveLink();
                $this->personalView->redirect();
            }
        }
    }

    public function saveLink(){
        $this->userDAL->saveLinkByUser($this->user, $this->link);
    }

    public function getOutput(){
        return $this->output;
    }
}