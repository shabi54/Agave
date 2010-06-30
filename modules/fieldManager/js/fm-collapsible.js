$(document).ready(function() {
	$(".fm-collapsed").addClass("fm-fieldset-closed").children("legend").nextAll().hide();

	$(".fm-collapsible").children("legend").click(function(){
		if($(this).parent().hasClass("fm-fieldset-closed")) {
			$(this).nextAll().slideDown(300);
			$(this).parent().removeClass("fm-fieldset-closed");
		}
		else {
			$(this).nextAll().slideUp(300);
			$(this).parent().addClass("fm-fieldset-closed");
		}
	});
});