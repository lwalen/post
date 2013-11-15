<!DOCTYPE html>
<head>
	<title>posts</title>

	<link href="/css/main.css" rel="stylesheet" type="text/css"/>
	<link href="/css/controls.css" rel="stylesheet" type="text/css"/>
	<link href="/css/post.css" rel="stylesheet" type="text/css"/>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src='/js/post.js' type='text/javascript'></script>
</head>
<body>
	<div class='container'>

<?php

require_once 'common.php';

if (!isset($_SESSION['user'])) {
	include 'sign_in.php';
	include 'register.php';
} else {
?>

<div class='controls'>
	<p class='current-user'><?= currentUser() ?></p>
	<p class='sign-out'><a href='/sign_out.php'>sign out</a></p>
	<div class='clear'></div>
</div>

<div class='posts'>
<?php	include 'posts.php' ?>
</div>

<div class='add-post'>
	<table>
		<tr>
			<td class='expand'>
				<input type='text' name='contents' class='add-contents'/>
			</td>
			<td>
				<input type='button' value='Post' class='add-submit'/>
			</td>
		</tr>
	</table>
</div>

<?php
}
?>
	</div>
</body>
</html>
