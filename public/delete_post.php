<?php

require_once 'common.php';


$db = connectToDB();

$id = mysqli_real_escape_string($db, $_POST['id']);

if (getAuthorOfPost($id) == currentUser()) {
	$query  = "DELETE FROM posts ";
	$query .= "WHERE id=$id;";

	$result = mysqli_query($db, $query);
}
?>
