$(document).ready(function() {
	$(".fm-addable").after("  <a class='fm-add-field' href='' onclick='return false'> </a>");
	//$(".fm-addable-fieldset")....


	//$(".fm-add-fieldset").click...
	//$(".fm-remove-fieldset").click...
	
	$(".fm-add-field").live("click", function(){
		var newField = $(this).parent().clone();
		newField.hide();
		newField.children(".fm-element-title").remove();
		newField.children().removeClass("fm-addable");
		newField.children(".fm-add-field").after(" <a class='fm-remove-field' href='' onclick='return false'> </a>");
		newField.children(".fm-add-field").remove();
		newField.addClass("fm-cloned");
		//TODO get rid of value if present
		$(this).parent().after(newField);
		newField.slideDown(400);
	});

	$(".fm-remove-field").live("click", function(){
		var field = $(this).parent();
		field.fadeOut(300, function() {
			field.remove();
		});
	});
});