$(document).ready(function() {

	//open
	$('.lbox-open').click(function() {

		var tar = $(this).data('tar');

		$('body').addClass('fixed');

		$(tar).fadeIn();

	});

	//close
	$('.lbox.lbox-close').click(function() {

		$(this).fadeOut();

		$('body').removeClass('fixed');
	});	
});