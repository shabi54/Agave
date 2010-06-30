$(document).ready(function() {
	//only add user messaging if user is not anonymous
	if(!agave.user.isAnon && agave.user.userMessaging) {
		//add message container and hide it
		$('body').append("<div id='agave-user-messages'><span id='agave-user-message-count' title='Click to view your notifications.'></span><span id='agave-user-message-header'>Messages</span><div id='agave-user-message-container'></div></div>");
		$('#agave-user-message-count').nextAll().hide();

		//prefill immediately with data available on page load, and start recursive ajax call to update
		updateMessageContent();
		if(agave.user.userMessageAsync) setTimeout(retrieveAgaveMessages, agave.user.userMessageInterval);
		
		//code for remove button
		$('.agave-user-message-remove').live('click', function() {
			var mKey = $(this).children('input').val();
			$(this).parent().hide(300, function(){
				$(this).remove();
				updateMessageCount();
			});
			removeMessage(mKey);
		});
		
		//code to hide/show notifications
		$('#agave-user-message-count').click(function() {
			$(this).nextAll().toggle(100);
		});
	}

});

function removeMessage(messageKey) {
	$.ajax({
		url: agave.base_url+'user/checkin',
		type: 'POST',
		data: 'messageKey='+messageKey
	}); // /end ajax call
}

function retrieveAgaveMessages() {
	$.ajax({
		url: agave.base_url+'user/checkin',
		type: 'POST',
		data: 'userKey='+agave.user.userKey,
		dataType: 'json',
	    success: function (json) {
			if(json) {
				agave.user.userMessages = json;
				updateMessageContent();
			}
	    }
	}); // /end ajax call

	//get number of messages
	setTimeout(retrieveAgaveMessages, agave.user.userMessageInterval);
}

function getMessageCount() {
	var size = $('#agave-user-message-container > div.agave-user-message').size();
	if (size=='0' || !size) size = 0;
	return size;
}

function updateMessageContent() {
	var content='';
	for(var i in agave.user.userMessages){
		content = content+"<div class='agave-user-message agave-user-message-"+agave.user.userMessages[i].type+"'><a class='agave-user-message-remove' title='Remove this message.'><input type='hidden' class='agave-user-message-mKey' value='"+agave.user.userMessages[i].messageKey+"' />x</a>"+"<b>"+agave.user.userMessages[i].time+"</b>: "+agave.user.userMessages[i].message+"</div>";
	}
	//if(content = '') content=null;
	$('#agave-user-message-container').html(content);
	updateMessageCount();
}

function updateMessageCount() {
	$('#agave-user-message-count').html(getMessageCount());
	if(getMessageCount() <= 0){
		$('#agave-user-message-count').nextAll().hide();
		$('#agave-user-messages').hide().addClass('closed');
	}
	else {
		$('#agave-user-messages').show().addClass('open');
	}
}

function death(obj) {
	var oldHTML = $('body').html();

	content = "<ul style='color: #fff;'>";
	for(var i in obj) content += "<li>"+obj[i]+"</li>";
	content += "</ul>";
	
	content += "<a id='deathReturn'>return</a>";
	$('#deathReturn').live('click', function() {
		$('body').html(oldHTML);
	});
	
	$('body').html(content);
}