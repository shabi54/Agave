<?php
define('SITE_NOT_FOUND', 1);
define('SITE_OFFLINE', 2);
define('VALID_REQUEST', 3);
define('ACCESS_DENIED', 4);
define('DESTINATION_UNKNOWN', 5);

//bootstrap phase definitions
define('BOOTSTRAP_SETTINGS', 0);
define('BOOTSTRAP_AGAVE', 1);
define('BOOTSTRAP_HOST', 2); //check against include/exclude list for hosts and IPs
define('BOOTSTRAP_DB', 3); //make db connection
define('BOOTSTRAP_FAST_ROUTE', 4); //parse request, check for fast-track requests
define('BOOTSTRAP_ENV', 5); //load environment (load settings, parse important paths, set error handler, date/time)
define('BOOTSTRAP_SESSION', 6); //start user session ($user is built here)
define('BOOTSTRAP_ACCESS', 7); //access check against url
define('BOOTSTRAP_LANG', 8); //load language settings
//define('BOOTSTRA_EARLY_CACHE', 9); //TODO: add after HOST phase, look for cache file in $settings, execute some functions to check a cache application such as memcached

//module status definitions
define('MODULE_LOCATION_GLOBAL', 1);
define('MODULE_LOCATION_LOCAL', 0);
define('MODULE_ENABLED', 1);
define('MODULE_NOT_ENABLED', 0);

//hardcode necessary settings for partial bootstrap
$settings = array();
$settings['agave_version'] = '1';

$settings['enabled_modules'] = array('admin','user','schemaManager','fieldManager','themer','fileManager');
$settings['installed_modules'] = array('admin','user','schemaManager','fieldManager','themer','fileManager');
$settings['module_versions'] = array(
	'admin'=>'.1',
	'user'=>'.1',
	'schemaManager'=>'.1',
	'fieldManager'=>'.1',
	'fileManager'=>'.1',
	'themer'=>'.1',
);

$settings['module_data']['admin']['path'] = 'modules/admin/';
$settings['module_data']['user']['path'] = 'modules/user/';
$settings['module_data']['schemaManager']['path'] = 'modules/schemaManager/';
$settings['module_data']['fieldManager']['path'] = 'modules/fieldManager/';
$settings['module_data']['fileManager']['path'] = 'modules/fileManager/';
$settings['module_data']['themer']['path'] = 'modules/themer/';

$settings['home_page'] = 'user/login';
$settings['default_theme'] = 'default';
$settings['clean_urls'] = FALSE;
$settings['footer_message'] = "running_on_agave();";
$settings['sess_method'] = 'database';

//ROUTE INSTALL PROCESS
if(bootstrap()) {
	$mode = $_SESSION['install-mode'];
	if(!isset($mode)) install_begin();
	else {
		switch($mode) {
			case 'core': install_core(); break;
			case 'user': install_user(); break;
			case 'info': install_site_info(); break;
			case 'finish': install_finish(); break;
		}
	}
}



/**
 *	Function pile
 */
function confirmed() {
	return (isset($_GET['confirmed']) && $_GET['confirmed']=='true') ? TRUE : FALSE;
}

function confirm($action) {
	global $agave;
	$error = (isset($_SESSION['error'])) ? "<p><em>ERROR:</em> ".$_SESSION['error']."</p>" : NULL;
	unset($_SESSION['error']);
	$continue = "<a href='".$agave->base_url."install.php?confirmed=true'>Confirm and Continue</a>";
	die("$error<h1>$action</h1><p>Are you sure that you would like to perform the action <em>$action</em>?</p><p>$continue</p>");
}

function install_phase($mode) {
	global $agave;
	$loc = $agave->base_url."install.php";
	$_SESSION['completed'][] = $_SESSION['install-mode'];
	$_SESSION['install-mode'] = $mode;
	header("Location: $loc");
	exit;
}

function install_begin() {
	if(!confirmed()) confirm('Begin Install');
	install_phase('core');
}

function install_user() {
	if(!confirmed()) confirm('Create Admin User');
	
	if($_POST) create_admin_user();
	else write_admin_user_form();
}

function install_finish() {
	global $agave;
	$admin = $agave->load('admin');

	//TODO: add session into agave for admin user to automatically log them into their new site

	foreach($_SESSION as $key=>$value) unset($_SESSION[$key]);
	foreach($agave->settings as $key=>$value) $admin->saveSetting($key, $value);
	$href = $agave->base_url;
	$html = "<h2>Instatllation complete.</h2><p>You may now continue to your site: <a href='$href'>view site</a></p>";
	die($html);
}

function install_site_info() {
	global $agave;
	if($_POST) {
		$admin = $agave->load('admin');
		foreach($_POST as $key=>$value) $admin->saveSetting($key, $value);
		install_phase('finish');
	}
	else {
		$fm = $agave->load('fieldManager');
		
		$elements = array();
		$elements[] = array(
			'name'=>'general/siteName',
			'type'=>'text',
			'label'=>"Site's name:",
			'default'=>$agave->setting('siteName')
		);
		$elements[] = array(
			'name'=>'general/footer_message',
			'type'=>'textarea',
			'cols'=>'40',
			'rows'=>'5',
			'label'=>'Footer text',
			'default'=>$agave->setting('footer_message')
		);
		$elements[] = array(
			'name'=>'contact/admin_name',
			'type'=>'text',
			'label'=>"Site admin's name:",
			'default'=>$agave->setting("admin_name")
		);
		$elements[] = array(
			'name'=>'contact/admin_email',
			'type'=>'text',
			'label'=>"Site admin's email:",
			'default'=>$agave->setting("admin_email")
		);
		$elements[] = array(
			'name'=>'security/SALT',
			'label'=>"SALT string",
			'type'=>'text',
			'help'=>"Setting a SALT string will greatly increase the security of your site",
			'size'=>60,
			'default'=>$agave->setting('SALT')
		);
		
		$form = $fm->startForm(NULL, "post");
		$form .= $fm->generateElements($elements);
		$form .= $fm->endForm("Continue w/ these settings");
		
		die($form);
	}
}

function create_admin_user() {
	global $agave;
	
	foreach($_POST as $key=>$value) $$key = mysql_real_escape_string($value);
	
	if(!$lname || !$fname || !$login || !$email || !$pword || !$pwordConfirm) {
		$_SESSION['error'] = "You must complete all fields in the form.";
		$agave->redirect("install.php");
	}
	
	if($pword != $pwordConfirm) {
		$_SESSION['error'] = "The passwords you entered don't match.";
		$agave->redirect("install.php");
	}
		
	$query = "INSERT INTO `users` (`firstName`,`lastName`,`login`,`password`,`email`,`date_added`) VALUES('$fname','$lname','$login','".md5($pword)."','$email','".time()."')";
	$agave->doSQLQuery($query);
	
	install_phase('info');
}

function write_admin_user_form() {
	global $agave;
	$fm = $agave->load('fieldManager');
	
	$elements = array();
	$elements[] = array(
		'name'=>'fname',
		'type'=>'text',
		'label'=>'First name'
	);
	$elements[] = array(
		'name'=>'lname',
		'type'=>'text',
		'label'=>'Last name'
	);
	$elements[] = array(
		'name'=>'email',
		'type'=>'text',
		'label'=>'Email'
	);
	$elements[] = array(
		'name'=>'login',
		'type'=>'text',
		'label'=>'Login'
	);
	$elements[] = array(
		'name'=>'pword',
		'type'=>'password',
		'label'=>'Password'
	);
	$elements[] = array(
		'name'=>'pwordConfirm',
		'type'=>'password',
		'label'=>'Confirm password'
	);
	
	//generate form
	$form = "<h2>Create Site Root User</h2>";
	$form .= $fm->startForm(NULL, "post");
	$form .= $fm->generateElements($elements);
	$form .= $fm->endForm("Create Admin User");
	
	die($form);
}

function install_core() {
	global $agave;
	
	if(!confirmed()) confirm('Install Core');
	
	//install all core tables first by calling just _info_install hooks
	foreach($agave->setting('installed_modules') as $module) include_once($agave->modulePath($module).$module.".info");
	foreach($agave->setting('installed_modules') as $module) {
		$func = $module."_info_install";
		if(function_exists($func)) call_user_func($func);
	}

	//now call all the other stuff to populate the core tables
	$admin = $agave->load('admin');
	foreach($agave->setting('installed_modules') as $module) {
		if(function_exists($module."_info_actions")) $admin->installActions(call_user_func($module."_info_actions"), $module);
		if(function_exists($module."_info_cron")) $admin->installCron(call_user_func($module."_info_cron"), $module);
		if(function_exists($module."_info_menu")) $admin->installMenu(call_user_func($module."_info_menu"), $module);
		if(function_exists($module."_info_menu_items")) $admin->installMenuItems(call_user_func($module."_info_menu_items"), $module);
		if(function_exists($module."_info_messages")) $admin->installMessages(call_user_func($module."_info_messages"), $module);
		if(function_exists($module."_info_panels")) $admin->installPanels(call_user_func($module."_info_panels"), $module);
		if(function_exists($module."_info_system_uri")) $admin->installSystemUri(call_user_func($module."_info_system_uri"), $module);
		if(function_exists($module."_info_system_variables")) $admin->installSystemVariables(call_user_func($module."_info_system_variables"));
		if(function_exists($module."_info_user_access")) $admin->installUserAccess(call_user_func($module."_info_user_access"), $module);
		$meta = call_user_func($module."_info_meta");

		//set versions for core modules
		$versions[$module] = $meta['version'];
	}
		
	$_SESSION['installing_agave'] = TRUE;

	install_phase('user');
}

function bootstrap() {
	//TODO: Change this to look for sites.php
	/*
	 * This is the first phase, in here Agave simply looks for the proper settings.php file, corresponding to the request received...
	 * For example, a request to www.russnet.org/homepage/look/lol will resolve to agave_root/sites/www.russnet.org/settings.php
	 * Likewise, if the site root is www.livefromrussia.org/stage1, the request will resolve to agave_root/sites/www.livefromrussia.org.stage1/settings.php
	 */
	 
	$confdir = 'sites';
	$uri = explode('/', $_SERVER['SCRIPT_NAME'] ? $_SERVER['SCRIPT_NAME'] : $_SERVER['SCRIPT_FILENAME']);
	$server = explode('.', implode('.', array_reverse(explode(':', rtrim($_SERVER['HTTP_HOST'], '.')))));
	for ($i = count($uri) - 1; $i > 0; $i--) {
		for ($j = count($server); $j > 0; $j--) {
			$dir = implode('.', array_slice($server, -$j)) . implode('.', array_slice($uri, 0, $i));
			if(file_exists("$confdir/$dir/settings.php")) {
				$initFile = "$confdir/$dir/settings.php";				
				return bootstrap_agave($initFile);
			}
		}
	}
	
	die("<h1>Could not find <code>settings.php</code> file.  Installation cannot continue.</h1>");
}

function bootstrap_agave($initFile) {
	global $agave, $settings, $db_info;
	include($initFile);
	include('./core/db/olddb.object');
	include('./core/agave.object');
	$agave = new agave();
	$agave->settings = $settings;
	$agave->cache = FALSE;
	$agave->installed = FALSE;

	//core agave paths
	$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
	$url = $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
	$agave->base_url = substr($protocol.$url, 0, -11); //chops off "install.php", it MAY get rewritten with ?dest=
	$agave->agave_base_url = substr($protocol.$url, 0, -11); //chops off "install.php" //this one does NOT get rewritten with ?dest= - it's a URL to be used for files that are in a subdirectory of agave root
	$agave->web_root = $_SERVER['DOCUMENT_ROOT']; //avoid using this for anything, not used anywhere, please don't use it
	$agave->agave_root = explode("/", dirname(__FILE__));
	array_pop($agave->agave_root);
	$agave->agave_root = implode("/", $agave->agave_root)."/";

	//check for special project_root
	$agave->site_dir = (isset($agave->settings['proj_root'])) ? rtrim($agave->settings['proj_root'], "/")."/" : dirname($initFile)."/";
	$agave->site_url = (isset($agave->settings['proj_url'])) ? rtrim($agave->settings['proj_url'], "/")."/" : $agave->agave_base_url.$agave->site_dir;
	
	//include core files
	include("core/user.object");
	
	//start basic php session
	session_start();
	
	//connect to db
	$agave->connect($db_info); 
	$query = "SHOW TABLES";
	$result = $agave->doSQLQuery($query, 1);

	//die if db not empty, or if we're not continuing the install process to a new step
	if(!empty($result) && !$_SESSION['installing_agave']) die("<h1>The database for this site is not empty - installation can only be performed on an empty database.</h1>");

	$agave->loadModules();
	
	return TRUE;
}

function __autoload($object) {
	/*
	 * Provides support for autoloading in classes that are being extended or implemented
	 */
	global $agave;
	$file = (isset($agave->module_env['objects'][$object])) ? $agave->module_env['objects'][$object] : FALSE;
	if(!$file) die("Request could not be completed because a necessary object could not be loaded.  The module that provides the requested object (<b>$object</b>) may not be installed/enabled.");
	if(file_exists($file)) include($file);
	else {
			$agave->message('error', 'FAILED_DEPENDENCY');
			$agave->log('build_error', "Failed loading dependency '$object'");
			$agave->redirect();
	}
}
