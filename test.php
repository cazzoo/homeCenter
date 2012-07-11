<?php

require ("loader.php");

if (isset($_REQUEST['page_title']))
	echo 'form submitted';

$title = $_REQUEST['page_title'];
$content = $_REQUEST['page_content'];
$icon = $_REQUEST['page_icon'];
$link = $_REQUEST['page_link'];

$p = new Page($title, $content, $icon, $link);
var_dump($p);
$p -> save();
?>