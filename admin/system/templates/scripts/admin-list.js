$(document).ready(function () {
	// sort list
	$('.js-sort-list').click(function () {
		$(this).submit()
	})

	// search bar
	$('#search-bar .icon-box').click(function () {
		$(this).parent().find('button').click()
	})

	$('#search-bar .inp').focus(function () {
		$(this).parent().addClass('active')
	})

	$('#search-bar .inp').blur(function () {
		$(this).parent().removeClass('active')
	})

	$('.js-search').click(function () {
		$(this).parents('form').submit()
	})

	$('.js-search-cancel').click(function () {
		$('.js-search-input').val('')
		$(this).parents('form').submit()
	})

	// pages
	$('.page').click(function () {
		$('.js-current-page').val($(this).data('page'))

		$(this).parent().find('button').click()
	})
})
