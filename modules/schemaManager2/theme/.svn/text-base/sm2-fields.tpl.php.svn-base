<?php
	//default form styles, and schemaManager styles
	$this->addCSS('fieldManager','theme/css/fm-defaults.css');
	$this->addCSS('admin','theme/css/schema-manager.css');
	
	//add jQuery UI dependencies
	$this->addJS(NULL,NULL,NULL,'vendor/jQuery/ui/minified/jquery-ui.min.js');
	$this->addJS(NULL,NULL,NULL,'vendor/jQuery/ui/minified/ui.draggable.min.js');
	$this->addJS(NULL,NULL,NULL,'vendor/jQuery/ui/minified/ui.sortable.min.js');

	//schemaManager js
	$this->addJS('schemaManager2','theme/js/schema-manager.js');
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

<?php if ($type && $entity): ?>
<div id='admin-page-controls'>
	<h4>Options</h4>
	<a class='fm-button' href='<?php print $agave->base_url."admin/sm2/field/create&entity=$entity&type=$type" ?>'>Add Field</a>
</div>
<?php endif; ?>

<div id='schema-field-container'>
	<ul id='schema-field-list'>
		<?php foreach($fields as $field): 
			$listItemClass = ($field['isShared'] == TRUE) ? "class='schema-field schema-shared-field'" : "class='schema-field'"; ?>
			
			<li <?php print $listItemClass ?> id='<?php print $field['fieldKey'] ?>'>
				<span class='schema-field-keyName'><?php print $field['field_label'] ?></span>
				<a class='schema-field-delete schema-field-control' href='<?php print $agave->base_url."admin/sm2/field/".$field['fieldKey']."/delete" ?>'>delete</a>
				<a class='schema-field-edit schema-field-control' href='<?php print $agave->base_url."admin/sm2/field/".$field['fieldKey']."/edit" ?>'>edit</a>
				<input class='schema-field-weight' type='hidden' value='<?php print $field['weight'] ?>' />
			</li>
		<?php endforeach; ?>
	</ul>
</div>