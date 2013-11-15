<?php

require_once 'common.php';

$db = connectToDB();

$contents = mysqli_real_escape_string($db, $_POST['contents']);
$user_id = currentUserID();

$query  = "INSERT INTO posts(user_id, contents) ";
$query .= "VALUES ($user_id, '$contents');";

$result = mysqli_query($db, $query);

?>
