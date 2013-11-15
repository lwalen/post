<?php

require_once 'common.php';

$db = connectToDB();

$color_id = $_POST['id'];
$user_id = currentUserID();

$color_id = mysqli_real_escape_string($db, $color_id);

$query  = "UPDATE users ";
$query .= "SET color_id = $color_id ";
$query .= "WHERE id = $user_id; ";

$result = mysqli_query($db, $query);

?>
