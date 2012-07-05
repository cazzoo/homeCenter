<?php
class Page {

	// Declarations
	public $_id = 0;
	public $_title = 'placeholder_title';
	public $_content = 'placeholder_content';
	public $_icon = 'placeholder_icon';
	public $_link = 'placeholder_link';
	private $_actions = array();

	// Methods
	function __construct($id, $title, $content, $icon, $link) {
		if (is_int($id) && is_string($title) && is_string($content) && is_string($icon) && is_string($link)) {
			$this -> _id = $id;
			$this -> _title = $title;
			$this -> _content = $content;
			$this -> $_icon = $icon;
			$this -> $_link = $link;
		} else {
			throw new Exception('Wrong input type');
		}
	}

	public function addAction(Action $action) {
		$this -> _actions . array_push($action);
	}

	function __destruct() {
		foreach ($this as $key => $value) {
			unset($this -> $key);
		}
	}

}
?>