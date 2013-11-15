<?php

require_once 'common.php';

unset($_SESSION['user']);
session_destroy();
header('Location: //post.walen.me');

?>
