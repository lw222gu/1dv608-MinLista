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

        if($wantsToEditLinks){
            if($deleteLink != null){
                $this->userDAL->deleteLink($this->user, $deleteLink);
                $this->user = $this->userDAL->getUserByUrl($uniqueUrl);
            }
            $editLinksView = new \view\EditLinksView($this->user);
            $this->output = $editLinksView->showPersonalInformation();
        }

        else{
            $this->personalView = new \view\PersonalView($this->user);
            $this->output = $this->personalView->showPersonalInformation($this->uniqueUrl);

            if($this->personalView->didUserPressAddLinkButton()){
                $this->link = $this->personalView->getLink();
                $this->saveLink();
                $this->personalView->redirect($uniqueUrl);
            }
        }
    }

    public function saveLink(){
        $this->userDAL->saveLinkByUser($this->user, $this->link);
    }

    public function getOutPut(){
        return $this->output;
        //return $this->personalView->showPersonalInformation($this->uniqueUrl);
    }
}