<?php
namespace view;
class StartView {
    private static $register = 'StartView::Register';
    private static $name = 'StartView::Name';
    private $isUserSaved = false;
    /* Right now i´m not using this member. Delete it if it is of no use later on, and remember to delete
    the setIsUserSaved function below, and the call to it from addUserController */
    public function didUserPressRegisterButton(){
        if(isset($_POST[self::$register])){
            return true;
        }
        return false;
    }
    public function getName(){
        return $_POST[self::$name];
    }
    public function setIsUserSaved($isUserSaved){
        $this->isUserSaved = $isUserSaved;
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
}