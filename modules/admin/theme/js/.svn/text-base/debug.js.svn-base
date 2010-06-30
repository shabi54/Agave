$(document).ready(function() {
	$('.debug-header').nextAll().hide();
	$('.debug-header').click(function() {
		$(this).nextAll().toggle(300);
	});

	$('.debug-function-header').click(function() {
		$(this).parent('debug-function').toggleClass('.debug-function-open');
	});

	$('#debug-button').click(function() {
		if($('#debug-background').hasClass('open-debug')) $('#debug-background').removeClass('open-debug');
		else $('#debug-background').addClass('open-debug');
	});
	
});