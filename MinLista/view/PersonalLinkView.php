<?php
namespace view;
class PersonalLinkView {

    private static $link = 'PersonalLinkView::Link';
    private static $addLink = 'PersonalLinkView::AddLink';
    private static $editLink = 'PersonalLinkView::EditLink';

    private $url;
    private $user;
    private $linkLabelMessage = "Lägg till länk:";

    public function __construct(\model\User $user){
        $this->user = $user;
        $this->url = $this->user->getUrl();
    }

    public function didUserPressAddLinkButton(){
        if(isset($_POST[self::$addLink])){
            return true;
        }
        return false;
    }

    public function getLink(){
        $addLink = strip_tags($_POST[self::$link]);
        return $addLink;
    }

    public function setErrorMessage(){
        $this->linkLabelMessage = "Du angav ingen länk. Prova igen!";
    }

    public function showPersonalInformation(){
        return  $this->renderAddLinkForm() .
                "<ul id='linkList'>" .
                $this->renderUserLinks() . "</ul>" .
                $this->renderEditButton();
    }

    public function renderAddLinkForm(){
        return '<form method="post" >
                    <label for="' . self::$link . '" id="linkLabel">' . $this->linkLabelMessage . '</label>
                    <input type="input" name ="' . self::$link . '" id="linkInput" value="" />
                    <input type="submit" name="' . self::$addLink . '" id="addLinkButton" value="Spara" />
                </form>
        ';
    }

    public function renderUserLinks(){
        $response = "";
        $userLinks = $this->user->getUserLinks();
        asort($userLinks);

        if($userLinks != null){
            foreach($userLinks as $link){
                $response .= "<li><a href='//" . $link->getLink() . "' target='_blank'>" . $link->getLink() . "</a></li>";
            }
        }
        else {
            $response = '<p>Du har inte sparat några länkar ännu. Lägg till länkar ovan.</p>';
        }
        return $response;
    }

    /* Edit button should only appear if user has saved links. */
    public function renderEditButton(){

        if($this->user->getUserLinks() != null){
            $query = array('url' => $this->url, 'editLink' => true);
            return '<a href="?' . http_build_query($query) . '" name="' . self::$editLink . '" id="editLink">Redigera länkar</a>';
        }
        return "";
    }

    public function redirect(){
        $actualLink = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $query = array('url' => $this->url);
        header("Location: $actualLink" . "?" . http_build_query($query));
    }
}