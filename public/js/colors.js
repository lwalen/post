
function updateColors() {
	if ($('.color-selector')[0]) {
		var colors = $('.color-selector').val().split('|');
		$('.self').css('color', '#' + colors[1]);
		$('.container').css('background-color', '#' + colors[2]);
		console.log('Updated colors');
	}
}

function setColor() {
	var color_id = $('.color-selector').val().split('|')[0];
	$.post("set_color.php", 
			{ id: color_id }, 
			function() {
				console.log('Set color')	
			});
}


$(document).ready(function() {
	updateColors();

	$('.controls').on('change', '.color-selector', function(event) {
		updateColors();
		setColor();
	});
});
