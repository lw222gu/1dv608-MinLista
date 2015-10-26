<?php
namespace view;
class PersonalView {

    private static $link = 'PersonalView::Link';
    private static $addLink = 'PersonalView::AddLink';
    private static $editLink = 'PersonalView::EditLink';

    private $url;
    private $user;
    private $linkLabelMessage = "Lägg till länk";

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
        /*$userName = $this->user->getName();
        if($userName != ""){
            $userName = " " . $userName;
        }*/

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
            $response = "<p>Du har inte sparat några länkar ännu. Lägg till länkar ovan.</p>";
        }
        return $response;
    }

    public function renderEditButton(){
        $query = array('url' => $this->url, 'edit' => true);
        return '<a href="?' . http_build_query($query) . '" name="' . self::$editLink . '" id="editLink">Redigera länkar</a>';
    }

    public function redirect(){
        $actualLink = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $query = array('url' => $this->url, 'edit' => false);
        header("Location: $actualLink" . "?" . http_build_query($query));
    }
}