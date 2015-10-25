<?php
namespace controller;

class RegisteredUserController {

    private $userDAL;
    private $user;
    private $personalView;
    private $link;
    private $output;

    public function __construct(\model\User $user, $wantsToEditLinks, $deleteLink){
        $this->userDAL = new \model\UserDAL();
        $this->user = $user;

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

            try{
                if($this->personalView->didUserPressAddLinkButton()){
                    $this->link = $this->personalView->getLink();

                    if($this->link != null){
                        $this->saveLink();
                        $this->personalView->redirect();
                    }
                    else {
                        throw new \Exception();
                    }
                }
            }
            catch(\Exception $e){
                $this->personalView->setErrorMessage();
            }
            $this->output = $this->personalView->showPersonalInformation();
        }
    }

    public function saveLink(){
        $this->userDAL->saveLinkByUser($this->user, $this->link);
    }

    public function getOutput(){
        return $this->output;
    }
}