<?php
require_once ("SavableObject.php");
class Action extends SavableObject {

    // Declarations
    public $_id = 0;
    public $_name = 'placeholder_name';
    public $_description = 'placeholder_description';
    public $_state = 0;

    // Methods
    function __construct($name, $description, $id = -1) {
        if (is_string($name) && is_string($description)) {
            if ($id == -1)
                $this -> _id = $this -> getLastAvailableId();
            else
                $this -> _id = $id;
            $this -> _name = trim(str_replace(" ", "", $name));
            $this -> _description = $description;
            $this -> updateState();
        } else {
            throw new Exception('Wrong input type(s)');
        }
    }

    //create file in path
    public function activate() {
        if ($this -> _state == 0) {
            $fp = fopen('actions/' . $this -> _name . '.do', 'w');
            fwrite($fp, "Action name = " . $this -> _name . "\nAction description = " . $this -> _description);
            fclose($fp);
            $this -> updateState();
        } elseif ($this -> _state == 1) {
            if (DEBUG_LEVEL > 0)
                echo 'Action ' . $this -> _name . ' already activated!';
        }
    }

    //delete file in path
    public function deactivate() {
        if (file_exists('actions/' . $this -> _name . '.do'))
            unlink('actions/' . $this -> _name . '.do');
        $this -> updateState();
    }

    //return the state of the action
    public function getState() {
        return $this -> _state;
    }

    //update the state of the action looking if the file exists or not
    public function updateState() {
        ((file_exists('actions/' . $this -> _name . '.do')) == TRUE ? $this -> _state = 1 : $this -> _state = 0);
        if (DEBUG_LEVEL > 1)
            echo 'Action ' . $this -> _name . ($this -> _state == 1 ? ' activated' : ' deactivated') . "!<br />";
    }

    function __destruct() {
        foreach ($this as $key => $value) {
            unset($this -> $key);
        }
    }

}
?>