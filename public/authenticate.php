<?php

require_once 'common.php';

if (isset($_POST['name'])) {
	$name = $_POST['name'];
	$password = $_POST['password'];

	$hashed_password = getHashedPassword($name);

	if (!$hashed_password) {
		// user does not exist
	} else if (password_verify($password, $hashed_password)) {
		$_SESSION['user'] = $name;
		$_SESSION['user_id'] = currentUserID();
	}

	unset($_POST['name']);
	unset($_POST['password']);
	header('Location: //post.walen.me');
} else {
	header('Location: //post.walen.me');
}
?>
