<?php

require_once 'common.php';

class Color {
	public $id = "";
	public $name = "";
	public $hex = "";
	public $lighter = "";

	function __construct($id, $name, $hex, $lighter) {
		$this->id = $id;
		$this->name = $name;
		$this->hex = $hex;
		$this->lighter = $lighter;
	}
}

function allColors() {
	$db = connectToDB();

	$query = "SELECT * FROM colors; ";

	$result = mysqli_query($db, $query);
	if ($result == false) {
		return false;
	}

	$colors = [];

	while ($row = mysqli_fetch_array($result)) {
		$color = new Color($row['id'],
			$row['name'],
			$row['hex'],
			$row['lighter']);

		$colors[] = $color;
	}

	return $colors;
}
?>
