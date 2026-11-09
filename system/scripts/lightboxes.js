$(document).ready(function() {

	//open
	$('.lbox-open').click(function() {

		var tar = $(this).data('tar');

		$('body').addClass('fixed');

		$(tar).fadeIn();

	});

	//close
	$('.lbox-close').click(function() {

		$(this).parents('.lbox').fadeOut();

		$('body').removeClass('fixed');
	});	
});