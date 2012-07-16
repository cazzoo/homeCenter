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

if (isset($_REQUEST['formAction'])) {
    if ($_REQUEST['formAction'] == "Delete")
        echo 'Asking to delete : ' . $_REQUEST['id'];
    $d = new Database();
    $d -> removeObject('action', $_REQUEST['id']);
}
?>