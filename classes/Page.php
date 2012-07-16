<?php
require_once ("SavableObject.php");
class Page extends SavableObject {

    // Declarations
    public $_id = 0;
    public $_title = 'placeholder_title';
    public $_content = 'placeholder_content';
    public $_icon = 'placeholder_icon';
    public $_link = 'placeholder_link';
    private $_actions = array();

    // Methods
    function __construct($title, $content, $icon, $link, $id = -1) {
        if (is_string($title) && is_string($content) && is_string($icon) && is_string($link)) {
            if ($id == -1)
                $this -> _id = $this -> getLastAvailableId();
            else
                $this -> _id = $id;
            $this -> _title = $title;
            $this -> _content = $content;
            $this -> _icon = $icon;
            $this -> _link = $link;
        } else {
            throw new Exception('Wrong input type');
        }
    }

    public function addAction(Action $action) {
        $this -> _actions . array_push($action);
    }

    public function actionsToString() {
        $toRender = '';
        $countActions = count($this -> _actions);
        if ($countActions > 0) {
            $i = 1;
            foreach ($this -> _actions as $value) {
                $toRender += $value;
                while ($i < $countActions) {
                    $toRender += ',';
                }
                $i++;
            }
        }
        return $toRender;
    }

    function __destruct() {
        foreach ($this as $key => $value) {
            unset($this -> $key);
        }
    }

}
?>