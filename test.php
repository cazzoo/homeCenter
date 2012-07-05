<?php
require_once ("classes/Database.php");
require_once ("classes/Page.php");
require_once ("classes/Action.php");

$action = new Action(1, "myAction", "This is a first action that should create a file");

$action -> activate();
$action -> deactivate();

$db = new Database();
//$db -> saveToBase($action);
//$db -> loadFromBase();
?>