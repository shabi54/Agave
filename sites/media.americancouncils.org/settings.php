<?php
//One day, when the DB layer is re-written, we'll change the db definitions to define a 'default' database, then you can also
//define other databases, and set 'targetDB's for queries
//this will allow for working with master/slave replication, and


$db_info['default'] = array(
	'driver' => 'mysql',
	'database' => 'media',
	'username' => 'mediaUser',
	'password' => 'media',
	'host' => '127.0.0.1',
	'port' => '3306',
);



//PHP INI SETTINGS
//ini_set('magic_quotes', '0'); //TODO: look up the magic quotes thing, make sure it's off

//CODE ONLY SETTINGS
//$settings['ip-include'] = "::1";
//$settings['ip-exclude'] = "::1";
//$settings['proj_root'] = "/opt/local/apache2/htdocs/agave_media"; //WARNING: Your project root MUST be in a web-accessible location in order for local JS/CSS/FILES to work
//$settings['proj_url'] = "...";
//$settings['access_log'] = TRUE;

//DB OVERRIDES
//$settings['siteName'] = "i pwn3d ur siteName";


//DEVELOPMENT ONLY SETTINGS - will be unnecessary later
//Note: This setting will be managed during the module install/uninstall process, since that doesn't exist yet it needs to be hard coded here
/*

*/