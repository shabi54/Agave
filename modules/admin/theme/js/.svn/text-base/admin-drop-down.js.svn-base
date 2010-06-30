$(document).ready(function(){
	$("ul.menu-sub").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled - Adds empty span tag after ul.menu-sub
	$("ul.menu-root li a") .mouseover(function() { //When trigger is clicked...
		//Following events are applied to the menu-sub itself (moving menu-sub up and down)
		$(this).parent().find("ul.menu-sub").slideDown(50).show(); //Drop down the menu-sub on click
		$(this).parent().hover(function() {
		}, function(){	
			$(this).parent().find("ul.menu-sub").slideUp(50); //When the mouse hovers out of the menu-sub, move it back up
		});
		//Following events are applied to the trigger (Hover events for the trigger)
		}).hover(function() { 
			$(this).addClass("subhover"); //On hover over, add class "subhover"
		}, function(){	//On Hover Out
			$(this).removeClass("subhover"); //On hover out, remove class "subhover"
	});

});
