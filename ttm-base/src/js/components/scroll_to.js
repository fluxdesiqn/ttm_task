import $ from "jquery";

$(document).ready(function() {
	$('.scrollTo').on('click', function(e) {
		e.preventDefault();
		const target = $(this).attr('href');
		if ($(target)) {
			$('html, body').animate({
				scrollTop: $(target).offset().top - $('#mainNav').height()
			}, 500);
		}
	})
})
