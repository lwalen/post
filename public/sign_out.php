<?php

require_once 'common.php';

unset($_SESSION['user']);
unset($_SESSION['user_id']);
session_destroy();
header('Location: //post.walen.me');

?>
