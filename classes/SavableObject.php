<?php
abstract class SavableObject {

	function save() {
		$db = new Database();
		$db -> saveToBase($this);
	}

	function getLastAvailableId() {
		$db = new Database();
		if ($this instanceof Action) {
			return $db -> getNextAvailableID("action");
		} else if ($this instanceof Page) {
			return $db -> getNextAvailableID("page");
		} else {
			throw new Exception('Wrong input object');
		}
	}

}
?>