<?php

//INCLUDE THE FILES NEEDED...
require_once('view/StartView.php');
require_once('view/PersonalView.php');
require_once('view/NavigationView.php');
require_once('view/LayoutView.php');
require_once('model/User.php');
require_once('model/UserDAL.php');
require_once('controller/MasterController.php');
require_once('controller/AddUserController.php');
require_once('controller/RegisteredUserController.php');

//MAKE SURE ERRORS ARE SHOWN...
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE MODEL OBJECTS
//$user = new model\User();
//$userDAL = new model\UserDAL();

//CREATE OBJECTS OF THE VIEWS
//$startView = new view\StartView();
//$personalView = new view\PersonalView($userDAL);
$navigationView = new view\NavigationView();
//$layoutView = new view\LayoutView($startView, $personalView, $navigationView);

//START CONTROLLERS
$masterController = new controller\MasterController($navigationView);
//$addUserController = new controller\AddUserController($startView, $user, $userDAL);
//$showPersonalizedPageController = new controller\ShowPersonalizedPageController($personalView, $user);

//START APPLICATION
//$layoutView->render();