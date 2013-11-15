<?php
require_once 'common.php';
?>

<!DOCTYPE html>
<head>
	<title>posts</title>

<?php
foreach (scandir('css/') as $file) {
	if (!preg_match('@^\.@', $file)) {
?>
	<link href="css/<?= $file ?>" rel="stylesheet" type="text/css"/>
<?php
	}
}
?>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<?php
foreach (scandir('js/') as $file) {
	if (!preg_match('@^\.@', $file)) {
?>
	<script src='js/<?= $file ?>' type='text/javascript'></script>
<?php
	}
}
?>
</head>
<body>
	<div class='container'>

<?php
$colors = allColors();
$user_color = getUsersColor(currentUser());

if (!isset($_SESSION['user'])) {
	include 'sign_in.php';
	include 'register.php';
} else {
?>

<div class='controls'>
<p class='current-user'><?= currentUser() ?></p>
	<select class='color'>
<?php 
	foreach ($colors as $color) { 
		$codes = $color->id . "|" . $color->hex . "|" . $color->lighter;
?>
	<option value='<?= $codes ?>'<?= $color->name == $user_color->name ? ' selected' : '' ?>>
			<?= $color->name ?>
		</option>
<?php } ?>
	</select>
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
