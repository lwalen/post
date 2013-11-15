<?php
require_once 'common.php';
?>

<!DOCTYPE html>
<head>
	<title>posts</title>
<?php stylesheets() ?>
<?php javascripts() ?>
</head>
<body>
	<div class='container'>

<?php
// show sign in and register forms if no user logged in
if (!currentUser()) {
	include 'sign_in.php';
	include 'register.php';
} else {
?>

<div class='controls'>
	<p class='current-user'><?= currentUser() ?></p>
<?php colorSelector() ?>
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
