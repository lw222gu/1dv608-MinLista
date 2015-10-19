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
        return $_POST[self::$name];
    }

    public function generateRegisterButton(){
        return '
            <p>Välkommen till I like it! Här skapar du en personlig startsida med de länkar du vill ha nära till hands.
            Fyll i ditt namn nedan och klicka på den stora knappen så är du igång. Kom ihåg att spara adressen du länkas
            vidare till - det är nämligen så du kommer åt dina länkar senare. Spar den som startsida i webbläsaren, eller
            som ett bokmärke.</p>
            <form method="post" >
                <label for="' . self::$name . '" id="nameLabel">Ditt namn</label>
                <input type="input" name ="' . self::$name . '" id="nameInput" value="" />
                <input type="submit" name="' . self::$register . '" id="registerButton" value="Skapa din startsida!" />
            </form>
        ';
    }

    public function redirect(){
        echo "Redirects!";
    }
}