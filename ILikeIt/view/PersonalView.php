<?php
namespace view;
class PersonalView {

    private static $link = 'PersonalView::Link';
    private static $addLink = 'PersonalView::AddLink';
    private static $editLink = 'PersonalView::EditLink';

    private $url;
    private $user;

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
        //Lägg till validering här. Tex, inga hmtl-taggar.
        return $_POST[self::$link];
    }

    public function showPersonalInformation(){
        return  "<p>Välkommen tillbaka " . $this->user->getName() . "!</p>" . $this->renderRegisterLinkForm() .
                "<br /><p>Dina sparade länkar:</p><ul id='linkList'>" .
                $this->renderUserLinks() . "</ul>" .
                $this->renderEditButton();
    }

    public function renderRegisterLinkForm(){
        return '<form method="post" >
                    <label for="' . self::$link . '" id="linkLabel">Lägg till länk</label>
                    <input type="input" name ="' . self::$link . '" id="linkInput" value="" />
                    <input type="submit" name="' . self::$addLink . '" id="addLinkButton" value="Spara länken" />
                </form>
        ';
    }

    public function renderUserLinks(){
        $response = "";
        foreach($this->user->getUserLinks() as $link){
            $response .= "<li><a href='//" . $link . "'>" . $link . "</a></li>";
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