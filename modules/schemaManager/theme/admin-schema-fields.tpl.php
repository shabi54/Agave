<?php
	//default form styles, and schemaManager styles
	$this->addCSS('fieldManager','theme/css/fm-defaults.css');
	$this->addCSS('admin','theme/css/schema-manager.css');
	
	//add jQuery UI dependencies
	$this->addJS(NULL,NULL,NULL,'vendor/jQuery/ui/minified/jquery-ui.min.js');
	$this->addJS(NULL,NULL,NULL,'vendor/jQuery/ui/minified/ui.draggable.min.js');
	$this->addJS(NULL,NULL,NULL,'vendor/jQuery/ui/minified/ui.sortable.min.js');

	//schemaManager js
	$this->addJS('schemaManager','js/schema-manager.js');
?>
<h2>Edit Schemata</h2>
<p>You can add/delete/modify fields for the chosen schema below.  Drag and drop the fields to reorder their position on the page/edit form.</p>

<small>
	<ul>
		<strong>Notes:</strong>
		<li>You cannot rename fields once you create them, there could be unintended consequences in the database.</li>
		<li>Modifying shared fields (marked in red) will affect all schemata in which that field appears.</li>
		<li>Some fields may be locked (striped border) because they have been coded against in other modules.  To make changes (DANGEROUS!), you must use phpmyadmin to either unlock them, or change them in the database.</li>
	</ul>
</small>

<div id='schema-field-container'>
	<a id='new-field'>
		Add field
		<input class='fieldmeta' type='hidden' value='<?php echo $table.".0.".$type ?>' />
	</a>
	<ul id='schema-field-list'>
		<?php if($fields): foreach($fields as $field): ?>
			<?php $listItemClass = ($field[$table."_type"] != $type) ? "class='schema-field schema-shared-field'" : "class='schema-field'"; ?>
			<li <?php echo $listItemClass ?> id='<?php echo $table."_".$field['nodeKey'] ?>'>
				<span class='schema-field-keyName'><?php echo $field['keyName'] ?></span>
				<a class='schema-field-delete schema-field-control'>delete</a> 
				<a class='schema-field-edit schema-field-control'>edit</a>
				<input class='schema-field-metadata' type='hidden' value='<?php echo $table.".".$field['nodeKey'].".".$field[$table.'_type'] ?>' />
			</li>
		<?php endforeach; else: print "No fields :("; endif; ?>
	</ul>
</div>