<?php

require_once 'common.php';

$db = connectToDB();

$contents = $_POST['contents'];

$url_pattern = '@(http)?(s)?(://)?(([-\w]+\.)+([^\s]+)+[^,.\s])@';
$link_pattern = '<a href="http$2://$4">$1$2$3$4</a>';
$contents = preg_replace($url_pattern, $link_pattern, $contents);
$contents = mysqli_real_escape_string($db, $contents);

$user_id = currentUserID();

$query  = "INSERT INTO posts(user_id, contents) ";
$query .= "VALUES ($user_id, '$contents');";

$result = mysqli_query($db, $query);

?>
