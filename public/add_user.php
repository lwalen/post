<?php

require_once 'common.php';

list ($result, $error) = addUser($_POST['name'], $_POST['password'], $_POST['confirm_password']);

$data = array('result' => $result, 'error' => $error);

print json_encode($data);

?>
