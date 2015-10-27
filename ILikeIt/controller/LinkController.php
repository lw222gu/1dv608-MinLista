<?php
namespace controller;

class LinkController {

    private $userDAL;
    private $user;
    private $personalLinkView;
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
                /* deleteLink contains an id of which link to delete */
                $this->userDAL->deleteLink($this->user, $deleteLink);
                $this->user = $this->userDAL->getUserByUrl($this->user->getUrl());
            }
            $editLinksView = new \view\EditLinksView($this->user);
            $this->output = $editLinksView->showPersonalInformation();
        }

        else{
            $this->personalLinkView = new \view\PersonalLinkView($this->user);

            try{
                if($this->personalLinkView->didUserPressAddLinkButton()){
                    $this->link = $this->personalLinkView->getLink();

                    if($this->link != null){
                        $this->saveLink();
                        $this->personalLinkView->redirect();
                    }
                    else {
                        throw new \Exception();
                    }
                }
            }
            catch(\Exception $e){
                $this->personalLinkView->setErrorMessage();
            }
            $this->output = $this->personalLinkView->showPersonalInformation();
        }
    }

    public function saveLink(){
        $this->userDAL->saveLinkByUser($this->user, $this->link);
    }

    /* Returns HTML-output to MasterController. */
    public function getOutput(){
        return $this->output;
    }
}