
function updateColors() {
	if ($('.color')[0]) {
		var colors = $('.color').val().split('|');
		$('.self').css('color', '#' + colors[1]);
		$('.container').css('background-color', '#' + colors[2]);
		console.log('Updated colors');
	}
}

function setColor() {
	var color_id = $('.color').val().split('|')[0];
	$.post("set_color.php", 
			{ id: color_id }, 
			function() {
				console.log('Set color')	
			});
}


$(document).ready(function() {
	updateColors();

	$('.controls').on('change', '.color', function(event) {
		updateColors();
		setColor();
	});
});
