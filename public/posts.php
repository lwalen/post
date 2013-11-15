<?php

require_once 'common.php';

if (currentUser()) {

	$db = connectToDB();

	$query = "SELECT * FROM posts;";

	$result = mysqli_query($db, $query);

	$posts = [];

	while ($row = mysqli_fetch_array($result)) {
		$post = new Post($row['contents'],
			$row['time'],
			getUser($row['user_id']),
			$row['id']);
		$posts[] = $post;
	}

	foreach ($posts as $post) {
		$contents = $post->contents;
		$datetime = $post->datetime;
		$user = $post->user;
		$id = $post->id;

		// greentexting
		$contents = preg_replace('@^>(.*)@', '<em>&gt;$1</em>', $contents);
?>
	<div class='post' id='<?= $id ?>'>
	<div class='user<?= $user == currentUser() ? " self" : "" ?>'><?= $user ?></div>
	<div class='datetime'><?= $datetime ?></div>
	<div class='clear'></div>
<?php
		if ($user == currentUser()) {
?>
	<div class='delete-post'><a href='#'>delete</a></div>
<?php
		}
?>
	<div class='contents'><?= $contents ?></div>
</div>
<?php
	}
} else {
	echo "Must be logged in to view posts.";
}
?>
