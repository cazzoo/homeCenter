<?php

require ("loader.php");

if (isset($_REQUEST['page_title']))
	return 1;
else
	return 0;

$p = new Page($_REQUEST['page_title'], $_REQUEST['page_content'], $_REQUEST['page_icon'], $_REQUEST['page_link']);
?>