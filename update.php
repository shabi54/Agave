<?php

require_once('./core/bootstrap.php');
$status = bootstrap();

switch($status) {
	case SITE_NOT_FOUND: site_not_found(); break;
	case SITE_OFFLINE: site_offline(); break;
	case VALID_REQUEST:
	{
		update();
	}
}

///////////////////////////////

function update() {
	updateCore();
	updateModules();
}

function updateCore() {
	global $agave;
	
}

function updateModules() {
	global $agave;
	
	$installed = json_decode($agave->setting('installed_modules'));
	
}
