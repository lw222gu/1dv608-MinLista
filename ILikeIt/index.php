<?php

//INCLUDE THE FILES NEEDED...
require_once('view/StartView.php');
require_once('view/PersonalView.php');
require_once('view/NavigationView.php');
require_once('view/LayoutView.php');
require_once('model/User.php');
require_once('model/UserDAL.php');
require_once('model/Link.php');
require_once('controller/MasterController.php');
require_once('controller/AddUserController.php');
require_once('controller/RegisteredUserController.php');

//MAKE SURE ERRORS ARE SHOWN...
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$navigationView = new view\NavigationView();
$masterController = new controller\MasterController($navigationView);