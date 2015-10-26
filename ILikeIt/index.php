<?php

/* Include files needed in project. */
require_once('view/StartView.php');
require_once('view/PersonalLinkView.php');
require_once('view/PersonalListView.php');
require_once('view/NavigationView.php');
require_once('view/LayoutView.php');
require_once('view/EditLinksView.php');
require_once('view/EditListItemsView.php');
require_once('model/User.php');
require_once('model/UserDAL.php');
require_once('model/Link.php');
require_once('model/ListItem.php');
require_once('controller/MasterController.php');
require_once('controller/AddUserController.php');
require_once('controller/LinkController.php');
require_once('controller/ListController.php');

/* Make sure errors are shown */
error_reporting(E_ALL);
ini_set('display_errors', 'On');

/* Initialize navigationView and start masterController */
$navigationView = new view\NavigationView();
$masterController = new controller\MasterController($navigationView);