<?php
function schemaManager_return_field_element_form($field) {
	global $agave;
	$form = array();
	$form['action'] = $agave->base_url.'admin/schemata/save/field';
	$form['method'] = 'post';
	$form['blockNum'] = $block;
	$form['redirect'] = array(
		'success'=>'content/%',
		'error'=>'content/%/edit',
	);
	$form['saveorder'] = array('contentNode');
	$form['submit'] = array(
		'value'=>"Save",
		'js'=>'js_validate_contentNode_edit',
		'cookie'=>TRUE,
	);

	//figure out which fields to add
	if(isset($nodeKey)) {
		$query = "SELECT * FROM `".$stem."_schema` WHERE `nodeKey`='$nodeKey'";
		$field = $agave->doSQLQuery($query, 2);
	}
	$elements = array();
	$elements[] = array(
		'name'=>'fieldName',
		'type'=>'text',
		'label'=>'Name of field',
		'size'=>20,
		'weight'=>0,
		'default'=> (isset($nodeKey)) ? $field['keyName'] : ''
	);
	$elements[] = array(
		'name'=>'type',
		'type'=>'select',
		'label'=>'Form element',
		'values'=> returnAvailableFieldTypes(),
		'default'=>(isset($nodeKey)) ? $field['type'] : 'text',
		'weight'=>1
	);
	$elements[] = array(
		'name'=>'label',
		'type'=>'text',
		'label'=>"Label",
		'size'=>20,
		'weight'=>2,
		'default'=> (isset($nodeKey)) ? $field['label'] : ''
	);
	$label = ($field['showLabel']) ? array('show') : NULL; //figure true/false for showlabel
	$elements[] = array(
		'name'=>'showLabel',
		'type'=>'checkbox',
		'label'=>'Show label',
		'values'=>array('show'),
		'default'=>array('show'),
		'nolabel'=>true,
		'weight'=>3,
		'default'=> (isset($nodeKey)) ? $label : array('show')
	);
	$elements[] = array(
		'name'=>'helpText',
		'type'=>'text',
		'size'=>20,
		'label'=>'Help text',
		'default'=> (isset($nodeKey)) ? $field['help'] : ''
	);
	$elements[] = array(
		'name'=>'access',
		'type'=>'text',
		'label'=>"Access argument",
		'size'=>20,
		'weight'=>4,
		'default'=> (isset($nodeKey)) ? $field['access'] : ''
	);
	$elements[] = array(
		'name'=>'types',
		'type'=>'text',
		'label'=>"Types",
		'help'=>'Enter a comma delimited string for the types this field should affect. TODO: change to checkboxes',
		'size'=>20,
		'weight'=>4,
		'default'=> (isset($nodeKey)) ? $field[$stem.'_type'] : $type
	);
	//add hidden elements for table/nodeKey
	$elements[] = array(
		'type'=>'hidden',
		'name'=>'stem',
		'value'=>$stem
	);
	$elements[] = array(
		'type'=>'hidden',
		'name'=>'mode',
		'value'=>'savefield'
	);
	if(isset($nodeKey)) {
		$elements[] = array(
			'type'=>'hidden',
			'name'=>'nodeKey',
			'value'=>$nodeKey
		);
	}

	$form['fields'] = $elements;
}

function schemaManager_return_field_element_settings_form($values, $settings=FALSE) {
	global $agave;
	
}