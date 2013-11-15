
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

$(document).ready(function() {

	$('.add-post').on('click', '.add-submit', addPost);

	$('.add-post').on('keypress', '.add-contents', function(event) {
		if(event.which == 13 && $('.add-contents').val().length > 0) {
			addPost();
		}
	});
});
