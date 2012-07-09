<?php

require("loader.php");

if (isset($_REQUEST['page_title']))
	echo "form submitted!";

$p = new Page($_REQUEST['page_title'], $_REQUEST['page_content'], $_REQUEST['page_icon'], $_REQUEST['page_link']);

?>