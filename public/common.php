<?php
session_start();

require_once '/srv/http/post/include/config.inc';
require_once 'colors.php';

class Post {
	public $contents = "";
	public $datetime = "";
	public $user = "";
	public $id = "";

	function __construct($contents, $datetime, $user, $id) {
		$this->contents = $contents;
		$date = new DateTime($datetime);
		$this->datetime = $date->format("n.j.y g:i");
		$this->user = $user;
		$this->id = $id;
	}
}

function connectToDB() {
	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if (!$db) {
		die('Connect Error ('.mysqli_connect_errno(). ') '.mysqli_connect_error());
	} else {
		return $db;
	}
}

function addUser($name, $password, $confirm_password) {
	$db = connectToDB();

	if ($password != $confirm_password) {
		return array("Passwords do not match", true);
	}

	$safe_name = mysqli_real_escape_string($db, $name);
	$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$query  = "INSERT INTO users (name, password, color_id) ";
	$query .= "VALUES ('$safe_name', '$hashed_password', 0);";

	$result = mysqli_query($db, $query);

	header("Location: //post.walen.me");
}

function getAuthorOfPost($id) {
	$db = connectToDB();

	$query  = "SELECT name FROM users, posts ";
	$query .= "WHERE posts.id = $id ";
	$query .= "AND posts.user_id = users.id; ";

	$result = mysqli_query($db, $query);
	if ($result == false) {
		return false;
	}

	$user = "";

	while ($row = mysqli_fetch_array($result)) {
		$user = $row['name'];
	}

	return $user;
}

function getUser($id) {
	$db = connectToDB();

	$query  = "SELECT name FROM users ";
	$query .= "WHERE id=$id; ";

	$result = mysqli_query($db, $query);
	if ($result == false) {
		return false;
	}

	$user = "";

	while ($row = mysqli_fetch_array($result)) {
		$user = $row['name'];
	}

	return $user;
}

function getUsersColor($name) {
	$db = connectToDB();

	$query  = "SELECT c.id, c.name, c.hex, c.lighter ";
	$query .= "FROM colors as c, users ";
	$query .= "WHERE users.name = '$name' ";
	$query .= "AND users.color_id = c.id; ";

	$result = mysqli_query($db, $query);
	if ($result == false) {
		return false;
	}

	$color = "";

	while ($row = mysqli_fetch_array($result)) {
		$color = new Color($row['id'],
			$row['name'],
			$row['hex'],
			$row['lighter']);
	}

	return $color;
}

function getHashedPassword($name) {
	$db = connectToDB();

	$safe_name = mysqli_real_escape_string($db, $name);

	$query  = "SELECT password FROM users ";
	$query .= "WHERE name='$safe_name'; ";

	$result = mysqli_query($db, $query);
	if ($result == false) {
		return false;
	}

	$hashed_password = "";

	while ($row = mysqli_fetch_array($result)) {
		$hashed_password = $row['password'];
	}

	return $hashed_password;
}

function currentUser() {
	if (isset($_SESSION['user'])) {
		return $_SESSION['user'];
	} else {
		return false;
	}
}

function currentUserID() {
	if (currentUser()) {
		if (isset($_SESSION['user_id'])) return $_SESSION['user_id'];

		$db = connectToDB();

		$query  = "SELECT id FROM users ";
		$query .= "WHERE name='".currentUser()."'; ";

		$result = mysqli_query($db, $query);
		if ($result == false) {
			return false;
		}

		$user_id = "";

		while ($row = mysqli_fetch_array($result)) {
			$user_id = $row['id'];
		}

		return $user_id;
	} else {
		return false;
	}
}

function stylesheets() {
	foreach (scandir('css/') as $file) {
		if (!preg_match('@^\.@', $file)) {
?>
	<link href="css/<?= $file ?>" rel="stylesheet" type="text/css"/>
<?php
		}
	}
}

function javascripts() {
	foreach (scandir('js/') as $file) {
		if (!preg_match('@^\.@', $file)) {
?>
	<script src='js/<?= $file ?>' type='text/javascript'></script>
<?php
		}
	}
}

function colorSelector() {
?>
	<select class='color-selector'>
<?php
	$colors = allColors();
	$user_color = getUsersColor(currentUser());

	foreach ($colors as $color) { 
		$codes = $color->id . "|" . $color->hex . "|" . $color->lighter;
		$selected = $color->name == $user_color->name ? ' selected' : '';
?>
		<option value='<?= $codes ?>'<?= $selected ?>><?= $color->name ?></option>
<?php 
	}
?>
	</select>
<?php
} 
?>
