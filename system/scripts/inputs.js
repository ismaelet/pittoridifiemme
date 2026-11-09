$(document).ready(function() {
	
	$('.inp-nospace').keypress(function(e) {
		
		if (e.which === 32) return false;
	});
});


