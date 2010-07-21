<?php
function schemaManager_return_field_element_form($data=FALSE) {
	global $agave;

	$table = $data['table'];
	$nodeKey = $data['nodeKey'];
	$type = $data['type'];
	if($nodeKey == 0) $nodeKey = FALSE;

	$form = array();
	$form['action'] = $agave->base_url.'admin/schemata/save/field';
	$form['method'] = 'post';
	$form['cancel'] = TRUE;

	//figure out which fields to add
	if($nodeKey != '0') {
		$query = "SELECT * FROM `".$table."_schema` WHERE `nodeKey`='$nodeKey'";
		$field = $agave->doSQLQuery($query, 2);
	}

	$elements = array();
	$elements[] = array(
		'#name'=>'fieldName',
		'#type'=>'text',
		'#label'=>'Name of field',
		'#size'=>20,
		'#weight'=>0,
		'#default'=> ($nodeKey) ? $field['keyName'] : NULL,
	);
	$elements[] = array(
		'#name'=>'type',
		'#type'=>'select',
		'#label'=>'Form element',
		'#values'=> returnAvailableFieldTypes(),
		'#default'=>($nodeKey) ? $field['type'] : 'text',
		'#weight'=>1
	);
	$elements[] = array(
		'#name'=>'label',
		'#type'=>'text',
		'#label'=>"Label pwn3d",
		'#size'=>20,
		'#weight'=>2,
		'#default'=> ($nodeKey) ? $field['label'] : NULL,
	);
	$label = (isset($field['showLabel'])) ? array('show') : NULL; //figure true/false for showlabel
	$elements[] = array(
		'#name'=>'showLabel',
		'#type'=>'checkbox',
		'#label'=>'Show label',
		'#values'=>array('show'),
		'#default'=>array('show'),
		'#nolabel'=>true,
		'#weight'=>3,
		'#default'=> ($nodeKey) ? $label : array('show'),
	);
	$elements[] = array(
		'#name'=>'helpText',
		'#type'=>'text',
		'#size'=>20,
		'#label'=>'Help text',
		'#default'=> ($nodeKey) ? $field['help'] : NULL,
	);
	$elements[] = array(
		'#name'=>'access',
		'#type'=>'text',
		'#label'=>"Access argument",
		'#size'=>20,
		'#weight'=>4,
		'#default'=> ($nodeKey) ? $field['access'] : NULL,
	);
	$elements[] = array(
		'#name'=>'types',
		'#type'=>'text',
		'#label'=>"Types",
		'#help'=>'Enter a comma delimited string for the types this field should affect. TODO: change to checkboxes',
		'#size'=>20,
		'#weight'=>4,
		'#default'=> ($nodeKey) ? $field[$table.'_type'] : $type,
	);
	//add hidden elements for table/nodeKey
	$elements[] = array(
		'#type'=>'hidden',
		'#name'=>'stem',
		'#value'=>$table,
	);
	if($nodeKey) {
		$elements[] = array(
			'#type'=>'hidden',
			'#name'=>'nodeKey',
			'#value'=>$nodeKey,
		);
	}

	$form['fields'] = $elements;
	return $form;
}

function schemaManager_return_field_element_settings_form($values, $settings=FALSE) {
	global $agave;

	//for fields load fieldManager, have it returnElementSettings, or whatever
}