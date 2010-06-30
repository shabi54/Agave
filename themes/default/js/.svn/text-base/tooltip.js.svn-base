$(document).ready(function() {
	$('.tooltip').mouseenter(function() {
		var description = "";
		description = $(this).attr('title');
		if (description != '') {
			$("body").append('<div id="popUpWrapper">'+'<div id="popUpBackground"></div>'+'<div id="popUpContent">'+description+'</div>'+'</div>');
		}
	}).mouseleave(function() {
		$('#popUpWrapper').remove();
	});
	//move tooltip on mousemove
	$('.tooltip').mousemove(function(e){
		$("#popUpWrapper").css("top", (e.pageY - 50) + "px").css("left", (e.pageX + 50) + "px");
	});
});