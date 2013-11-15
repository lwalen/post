
function reloadPosts() {
	console.log('Reloading posts');
	$('.posts').load('posts.php', function() {
		console.log('Reloaded posts');
		$.getScript("/js/colors.js");
	});
}

function addPost() {
	var contents = $('.add-contents').val();

	console.log('Posting: "' + contents + '"');

	if (contents != "") {
		$.post("add_post.php",
				{ contents: contents },
				function() {
					$('.add-contents').val("");
					reloadPosts();
				});
	}
}

function deletePost(id) {
	console.log('Deleting: ' + id);
	$.post( "delete_post.php", 
			{ id: id }, 
			function() {
				reloadPosts();
			});
}

$(document).ready(function() {

	// Add post event
	$('.add-post').on('click', '.add-submit', addPost);

	$('.add-post').on('keypress', '.add-contents', function(event) {
		if(event.which == 13) {
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
		reloadPosts();
	}, 30000);

});
