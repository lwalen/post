<?php

require_once 'common.php';

if (currentUser()) {

	$db = connectToDB();

	$query = "SELECT * FROM posts;";

	$result = mysqli_query($db, $query);

	$posts = [];

	while ($row = mysqli_fetch_array($result)) {
		$post = new Post($row['contents'], $row['time'], getUser($row['user_id']));
		$posts[] = $post;
	}

	foreach ($posts as $post) {
		$contents = $post->contents;
		$datetime = $post->datetime;
		$user = $post->user;

		$url_pattern = '@(http)?(s)?(://)?(([-\w]+\.)+([^\s]+)+[^,.\s])@';
		$link_pattern = '<a href="http$2://$4">$1$2$3$4</a>';
		$contents = preg_replace($url_pattern, $link_pattern, $contents);
?>
<div class='post'>
	<div class='user'><?= $user ?></div>
	<div class='datetime'><?= $datetime ?></div>
	<div class='clear'></div>
	<div class='contents'><?= $contents ?></div>
</div>
<?php
	}
} else {
	echo "Must be logged in to view posts.";
}
?>
