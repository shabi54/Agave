$(document).ready(function() {

	//sortable fields
	$('#schema-field-list').sortable({ helper: 'clone' });
	$('#schema-field-list').bind('sortstop', function(event, ui) {
		var weights = $('#schema-field-list').sortable('toArray');
		updateweights(weights);
	});
	
	//new field button
	$('#new-field').click(function() {
		$('#field-edit-frame').remove();
		var metadata = $(this).children('input').val();
		var mode='new';
		editField(metadata, mode);
	});
	
	//edit button
	$('.schema-field-edit').click(function() {
		$('#field-edit-frame').remove();
		var metadata = $(this).siblings('.schema-field-metadata').val();
		var mode='edit';
		editField(metadata, mode);
	});
	
	//cancel
	$('#schema-field-cancel').live('click', function() {
		$('#field-edit-frame').remove();
	});
	
	//delete button
	$('.schema-field-delete').click(function() {
		$('#field-edit-frame').remove();
		var answer = confirm("Are you sure you want to delete this field?  Deleting the field will also delete all data stored from this field.");
		if(answer) {
			var metadata = $(this).siblings('.schema-field-metadata').val();
			deleteField(metadata);
			window.location.reload()
		}
		else {
			$('#field-edit-frame').remove();
		}
	});
	
	//field settings button
	$('#show-field-settings').live('click', function() {
		var metadata = $('#edit-field-metadata').val();
		editFieldSettings(metadata);
	});
	
	//cancel field settings button
	$('#cancelFieldSettings').live('click', function() {
		$('#field-edit-frame').remove();
	});
	
});

function editFieldSettings(metadata) {
	$.ajax({
		url: agave.base_url+'admin/schemata/edit/field/settings',
		type: 'POST',
		data: 'metadata='+encodeURIComponent(metadata),
		dataType: 'html',
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("Error updating fields.  Status: "+XMLHttpRequest.status);
	    },
	    success: function (html) {
			if(html) {
				$('#field-edit-frame').html(html);
			}
	    }
	}); // /end ajax call		
}

//function updates weight fields based on how they were sorted on the page
function updateweights(weights) {
	$.ajax({
		url: agave.base_url+'admin/schemata/update/weights',
		type: 'POST',
		data: 'weightdata='+encodeURIComponent(weights),
		dataType: 'html',
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("Error updating fields.  Status: "+XMLHttpRequest.status);
	    },
	    success: function (html) {
			if(html) alert(html);
	    }
	}); // /end ajax call
}

function deleteField(metadata) {
	$.ajax({
		url: agave.base_url+'admin/schemata/delete/field',
		type: 'POST',
		data: 'metadata='+encodeURIComponent(metadata),
		dataType: 'html',
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("Error deleting field.  Status: "+XMLHttpRequest.status);
	    },
	    success: function (html) {
			if(html) alert(html);
	    }
	}); // /end ajax call
}

function editField(metadata, mode) {
	var urldata = false;
	if(mode=='edit') urldata = 'metadata='+encodeURIComponent(metadata);
	else urldata = 'mode=newfield&metadata='+encodeURIComponent(metadata);

	$.ajax({
		url: agave.base_url+'admin/schemata/edit/field',
		type: 'POST',
		data: urldata,
		dataType: 'html',
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("Error editing field.  Status: "+XMLHttpRequest.status);
	    },
	    success: function (html) {
			if(html){
				$('body').append("<div id='field-edit-frame'>"+html+"<input id='edit-field-metadata' type='hidden' value='"+metadata+"' /></div>");
			}
	    }
	}); // /end ajax call
}
