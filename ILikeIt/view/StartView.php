<?php
namespace view;
class StartView {
    private static $register = 'StartView::Register';
    private static $name = 'StartView::Name';

    public function didUserPressRegisterButton(){
        if(isset($_POST[self::$register])){
            return true;
        }
        return false;
    }

    public function getName(){
        $userName = strip_tags($_POST[self::$name]);
        return $userName;
    }

    public function renderWelcomeMessage(){
        return '<p>Välkommen till Min lista!</p><p>Här kan du skapa just listor. En lista för lite vad som helst, och en
            lista med länkar du vill ha nära tillhands. Fyll i ditt namn till höger och klicka på den stora knappen så är
            du igång. Kom ihåg att spara adressen du länkas vidare till - det är nämligen så du kommer åt dina listor senare.
            Ett tips är att spara den som startsida i webbläsaren, eller som ett bokmärke.</p>';
    }

    public function renderRegisterForm(){
        return '
            <form method="post" >
                <label for="' . self::$name . '" id="nameLabel">Ditt namn (valfritt):</label>
                <input type="input" name ="' . self::$name . '" id="nameInput" value="" />
                <input type="submit" name="' . self::$register . '" id="registerButton" value="Skapa din listsida!" />
            </form>
        ';
    }

    public function redirect($url){
        $actualLink = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $query = array('url' => $url);
        header("Location: $actualLink" . "?" . http_build_query($query));
    }
}