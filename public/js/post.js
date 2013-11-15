
function addPost() {
	var contents = $('.add-contents').val();

	console.log('Posting: "' + contents + '"');

	if (contents != "") {
		$.post("add_post.php",
				{ contents: contents },
				function() {
					$('.add-contents').val("");
					$('.posts').load('posts.php');
				});
	}
}

function deletePost(id) {
	console.log('Deleting: ' + id);
	$.post( "delete_post.php", 
			{ id: id }, 
			function() {
				$('.posts').load('posts.php');
			});
}

$(document).ready(function() {

	// Add post event
	$('.add-post').on('click', '.add-submit', addPost);

	$('.add-post').on('keypress', '.add-contents', function(event) {
		if(event.which == 13 && $('.add-contents').val().length > 0) {
			addPost();
		}
	});

	// Delete post
	$('.posts').on('click', '.delete-post', function() {
		var id = $(this).parent().attr('id');
		deletePost(id);
	});

	// Reload posts every 30 seconds
	setInterval(function() {
		$('.posts').load('posts.php');
	}, 30000);

});
