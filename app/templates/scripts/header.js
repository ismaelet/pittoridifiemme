$(document).ready(function () {
	$('#navHm_inp').change(function () {
		if ($('#navHm').is(':visible')) {
			$('body').addClass('fixH')
		} else {
			$('body').removeClass('fixH')
		}
	})
})
