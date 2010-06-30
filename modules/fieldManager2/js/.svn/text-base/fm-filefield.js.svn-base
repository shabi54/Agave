$(document).ready(function() {

	//TODO: addability

	$(".fm-filefield").change(function() {
		$(this).siblings('.file-status').val('NEWFILE');
	});

	$(".fm-file-delete").click(function() {
		$(this).parent().siblings('.file-status').val('DELETE');
		$(this).parent('.fm-file-controls').html("This file will be deleted once the form is submitted.");
		//TODO fade out
	});

	$(".fm-file-replace").click(function() {
		$(this).parent().siblings('.file-status').val('REPLACE');
		var name = $(this).parent().siblings('.file-status').attr('name');
		alert(name);
		$(this).parent().parent().prepend("<input type='file' name='"+name+"' />");
		$(this).parent().siblings('.fm-file').remove();
		$(this).parent('.fm-file-controls').remove();
	});
	
});