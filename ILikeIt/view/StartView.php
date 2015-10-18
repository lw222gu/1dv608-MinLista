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
            <form method="post" >
                <fieldset>
                    <input type="input" name ="' . self::$name . '" value="" />
                    <input type="submit" name="' . self::$register . '" value="Skapa en egen startsida!" />
                </fieldset>
            </form>
        ';
    }

    public function redirect(){
        echo "Redirects!";
    }
}