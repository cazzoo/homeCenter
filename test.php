<?php
require ("loader.php");

if (isset($_REQUEST['page_title'])) {
    $title = $_REQUEST['page_title'];
    $content = $_REQUEST['page_content'];
    $icon = $_REQUEST['page_icon'];
    $link = $_REQUEST['page_link'];
    $p = new Page($title, $content, $icon, $link);
    $p -> save();
}

if (isset($_REQUEST['action_name'])) {
    $name = $_REQUEST['action_name'];
    $description = $_REQUEST['action_description'];
    $a = new Action($name, $description);
    $a -> save();
}

?>