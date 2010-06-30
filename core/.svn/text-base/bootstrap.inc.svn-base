<?php
/*
 * To add phases into the bootstrap process:
 * 	1. first define a phase for your item such as BOOTSTRAP_MYPHASE
 * 	2. Insert that phase into the function bootstrap()'s switch statement
 * 	3. Add the function to this file, at the end, make sure it returns a call to bootstrap with the next phase, also set $agave->status = BOOTSTRAP_MYPHASE
 * 	4. Make sure the bootstrap function that should execute BEFORE your phase returns a call to bootstrap with your new phase
 */



//bootstrap status definitions
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

function bootstrap($phase=BOOTSTRAP_SETTINGS, $vars=NULL) {
	switch($phase) {
		//TODO: fit caching in here somewhere
		case BOOTSTRAP_SETTINGS : $status = bootstrap_settings($vars); break;
		case BOOTSTRAP_AGAVE : $status = bootstrap_agave($vars); break;
		case BOOTSTRAP_HOST : $status = bootstrap_host($vars); break;
		//case BOOTSTRAP_EARLY_CACHE : $status = bootstrap_early_cache(); break;  //this is for something like memcached, if we ever start using it - a path to a cache file must be included in $settings - that code will be loaded and executed to let your cacheing app do whatever
		case BOOTSTRAP_DB : $status = bootstrap_db($vars); break;
		case BOOTSTRAP_FAST_ROUTE : $status = bootstrap_fast_route($vars); break;
		case BOOTSTRAP_ENV : $status = bootstrap_env($vars); break;
		case BOOTSTRAP_SESSION : $status = bootstrap_session($vars); break;
		case BOOTSTRAP_ACCESS : $status = bootstrap_access($vars); break;
		case BOOTSTRAP_LANG : $status = bootstrap_lang($vars); break;
	}
	return $status;
}

function bootstrap_settings() {
	//TODO: Change this to look for sites.php
	/*
	 * This is the first phase, in here Agave simply looks for the proper settings.php file, corresponding to the request received...
	 * For example, a request to www.russnet.org/homepage/look/lol will resolve to agave_root/sites/www.russnet.org/settings.php
	 * Likewise, if the site root is www.livefromrussia.org/stage1, the request will resolve to agave_root/sites/www.livefromrussia.org.stage1/settings.php
	 */
	global $settings;
	if(isset($settings['proj_root'])) {
		$initFile = $settings['proj_root']."settings.php";
		return bootstrap(BOOTSTRAP_AGAVE, $initFile);
	}
	else {		
		$confdir = 'sites';
		$uri = explode('/', $_SERVER['SCRIPT_NAME'] ? $_SERVER['SCRIPT_NAME'] : $_SERVER['SCRIPT_FILENAME']);
		$server = explode('.', implode('.', array_reverse(explode(':', rtrim($_SERVER['HTTP_HOST'], '.')))));
		for ($i = count($uri) - 1; $i > 0; $i--) {
			for ($j = count($server); $j > 0; $j--) {
				$dir = implode('.', array_slice($server, -$j)) . implode('.', array_slice($uri, 0, $i));
				if(file_exists("$confdir/$dir/settings.php")) {
					global $initFile;
					$initFile = "$confdir/$dir/settings.php";				
					return bootstrap(BOOTSTRAP_HOST);
				}
			}
		}
	}
	
	return SITE_NOT_FOUND;
}

function bootstrap_host() {
	/*
	 * Second phase, a quick check against any banned hosts specified in your settings.php file
	 */
	//TODO: take into account proxies (?) look at Drupal for an example if you need it
	global $settings;
	if(isset($settings['ip-include']) && !in_array($_SERVER['REMOTE_ADDR'], $settings['ip-include'])) banned_location();
	if(isset($settings['ip-exclude']) && in_array($_SERVER['REMOTE_ADDR'], $settings['ip-exclude'])) banned_location();
	
	return bootstrap(BOOTSTRAP_AGAVE);
}

function bootstrap_agave() {
	
	/*
	 * Third phase: based on what's in settings.php, we determine core paths for agave
	 * 
	 */
	global $agave, $settings, $db_info, $initFile;
	include($initFile);
	//TODO: we'll be changing this to point at core/db/db.object
	include('./core/db/olddb.object');
	include('./core/agave.object');
	$agave = new agave();
	$agave->connect($db_info);
	//$agave->db = new db($db_info);

	//TODO: check for site_offline
	
	
	//core agave paths
	$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
	$url = $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
	$agave->base_url = substr($protocol.$url, 0, -9); //chops off "index.php", it MAY get rewritten with ?dest=
	$agave->agave_base_url = substr($protocol.$url, 0, -9); //chops off "index.php" //this one does NOT get rewritten with ?dest= - it's a URL to be used for files that are in a subdirectory of agave root
	$agave->web_root = $_SERVER['DOCUMENT_ROOT']; //avoid using this for anything, not used anywhere, please don't use it
	$agave->agave_root = explode("/", dirname(__FILE__));
	array_pop($agave->agave_root);
	$agave->agave_root = implode("/", $agave->agave_root)."/";

	//check for special project_root
	$agave->site_dir = (isset($settings['proj_root'])) ? rtrim($settings['proj_root'], "/")."/" : dirname($initFile)."/";
	$agave->site_url = (isset($settings['proj_url'])) ? rtrim($settings['proj_url'], "/")."/" : $agave->agave_base_url.$agave->site_dir;

	$agave->status = BOOTSTRAP_AGAVE;
	return bootstrap(BOOTSTRAP_FAST_ROUTE);
}

function bootstrap_early_cache() {
	//TODO: implement, check for a cache file to include from settings.php, or see if memcached is turned on.
	//add memcached.php to core
}

function bootstrap_fast_route() {
	/*
	 * Fifth phase, resolve the request (unless there is no destination, ie, you're at the home page)
	 * If this is a request that needs to be executed super-fast, for example any ajax request on fast timers, it is routed immediately without fully loading the agave environment
	 */
	global $agave;
	include("./core/dispatcher.object");
	$GLOBALS['objects']['dispatcher'] = new dispatcher;

	//the home page cannot be fast routed because it's location is stored in db settings
	//which haven't been loaded yet
	if(!empty($_GET['dest'])) {
		$agave->destination = rtrim($_GET['dest'], "/");
		$agave->current_location = $agave->destination;
		$agave->uri = $GLOBALS['objects']['dispatcher']->resolveRequest($agave->destination);
	}

	$agave->status = BOOTSTRAP_FAST_ROUTE;
	return bootstrap(BOOTSTRAP_ENV);
}

function bootstrap_env() {
	//TODO: take file-related stuff out of this, we'll do it in a new file_phase
	/*
	 * Sixth phase: the rest of the agave environment is loaded
	 * First - your settings in the database are loaded and merged with the settings from your settings.php file - settings specified in code (settings.php) OVERWRITE any database settings, thus cannot be changed from the Admin interface
	 * Second - More core paths are determined based on your settings, for example paths related to files
	 * Third - If your request has not yet been resolved, it means you are at the root of your site, thus there is no specific destination to request - if this is the case, we look for your sites home_page setting, and resolve the request to the returned location
	 */
	global $agave, $settings;
	$agave->loadSettings();
	//$agave->death($agave->settings);

//START HERE!!!!! Note that if $agave->rebuildCaches() is called, these environment variables are NOT refreshed...

	//figure out other important paths based on settings
	$agave->modules = $agave->setting('enabled_modules');
	$agave->module_paths = $agave->setting('module_paths');
	$agave->module_versions = $agave->setting('module_versions');

	//loads .module file in all active modules, OR, if cached uses necessary data structure from settings
	$agave->loadModules();

	//TODO: change to get timezone setting from agave db
	set_error_handler('agave_error_handler');
	date_default_timezone_set('America/New_York');

	$path = $agave->setting('file_root');
	$agave->base_file_path = ($path[0]=="/") ? $path : $agave->agave_root.$agave->site_dir.$path;
	$agave->site_file_path = $agave->agave_root.$agave->site_dir.$path;
	$agave->site_file_url = ($path[0]=="/") ? $path : $agave->agave_base_url.$agave->site_dir.$path;

	//add ?dest= back into $agave->base_url if clean URLS are enabled, disabled by default
	if(!$agave->setting('clean_urls') || $agave->setting('clean_urls') == FALSE) $agave->base_url = $agave->base_url."?dest=";
	//if we haven't resolved the request yet, it's because we're at the home page
	if(!$agave->destination) {
		$agave->destination = $agave->setting('home_page');
		$agave->current_location = $agave->destination;
		$agave->uri = $GLOBALS['objects']['dispatcher']->resolveRequest($agave->destination);
	}
	$agave->current_url = $agave->base_url.$agave->destination;

	//NOTE: fast_route was moved to end of ENV phase
	if($agave->uri['validRequest'] && $agave->uri['fast_route']) {
		//TODO: if we want to add fast_routed requests to access log, do it here, but know that we won't have some info, such as $userKey..., also, if you want fast_route requests logged, you must specificy $settings['access_log'] = TRUE in your settings.php file, because the full agave environment has not been loaded at this point
		$GLOBALS['objects']['dispatcher']->route($agave->uri);
		exit;
	}
	$agave->status = BOOTSTRAP_ENV;
	return bootstrap(BOOTSTRAP_SESSION);
}
function bootstrap_files() {
	//TODO: write this function and implement it in the bootstrap phase - MAYBE
	//1. check settings for available stream-wrappers
	//2. register available stream-wrappers
	//...OR!
	//... what about not loading file support automatically? only load it on fileManager__construct() ? - could work, but note that unless all file-related settings are stored in settings.php
	//... you can only load the fileManager after BOOTSTRAP_ENV phase - so no file-support for fast-routed requests..., could add a second fast-route phase after the _ENV stage (Yes, this needs to happen...)
}
function bootstrap_session() {
	/*
	 * Seventh phase: User session
	 * First - Here we start the users session, the session object checks for a previous session, and from that determines whether or not a user is anonymous or authenticated,
	 * The session object is in charge of building the global user object
	 * Second - if there is a one-time access key specified, session object reauthenticates based on the one-time access key
	 * Third - environmental $_SESSION vars are set, such as the user-agent, referrer location, and saves any $_POST data
	 * Third.5 - Write to access log if it's enabled: TODO: not active yet, may need to be moved elsewhere
	 * Fourth - if the user has timed out, they are logged out and redirected: TODO: this doesn't work yet, it's a placeholder, and it may need to be moved elsewhere or not done at all
	 * Fifth - if this is an invalid request, we stop execution here - we wait this long to kill the request so that we can log 404 errors, but still have record of exactly which user made the request, thus you can keep track of frequently made bad requests to your site, such as requests made by broken links...etc...
	 */
	global $agave;
	include("./core/user.object");
	include("./core/session.object");
	//instantiate core objects, no need to instantiate schemaManager in bootstrap process
	$GLOBALS['objects']['session'] = new session;		
	$GLOBALS['objects']['user'] = new user;
	
	//start the users session - global user is built here
	$GLOBALS['objects']['session']->start();
	
	//TODO: implement this for real - add db tables and stuff; check for 1-time access key, reauthenticate if present
	if(isset($_GET['agave_one_time_access'])) {
		$code = $_GET['agave_one_time_access'];
		$query = "SELECT * FROM `one_time_access` WHERE `code`='$code'";
		$data = $agave->doSQLQuery($query, 2); //query for access-code in DB
		if(!$data) {
			$agave->message('error', NULL,"You have attempted to use an invalid one-time access code.");
			$agave->redirect();
		}
		$query = "DELETE FROM `one_time_access` WHERE `code`='$code'"; 
		$agave->doSQLQuery($query); //wipe used access code
		$userKey = $data['userKey'];
		
		//TODO check against begin & end dates
		//if error - notify them that the code was wiped - they must request new access
		
		$GLOBALS['objects']['session']->addSession(session_id(), $userKey, $_SESSION);
		$agave->log('one_time_access', "User $userKey used a one-time access code.", $userKey);
		$agave->invoke('one_time_access', $userKey);
		$redirect = (isset($data['redirect'])) ? $data['redirect'] : NULL;
		$agave->redirect($redirect);
	}
	
	//start the users session and set important session data
	$_SESSION['referrer'] = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $agave->base_url;
	$_SESSION['agent'] = $_SERVER['HTTP_USER_AGENT'];
	$_SESSION['destination'] = $agave->uri['absoluteDest'];
	$_SESSION['previousLocation'] = ($_SESSION['referrer'] != $_SESSION['destination']) ? $_SESSION['referrer'] : $_SESSION['previousLocation']; //TODO: this isn't taking into account stuff in $_GET string
	if(!empty($_POST)) $_SESSION['previousPost'] = $_POST;
	
	//TODO: write to access log IF ENABLED, note, only do this on fileSystem, not worth extra db overhead, seriously
	//if($agave->setting('access_log')) $agave->accessLog();
	
	//TODO: check for requests that need to be semi-fast-routed, meaning they need user support
	
	//redirect if user timed out
	if($GLOBALS['objects']['user']->timedOut) {
		$agave->message('error', "TIMED_OUT");

		//TODO add check on login page to notify user of unsaved data
		$agave->redirect("user/login");
	}

	//needed to wait until after session was created to throw our 404 error for logging purposes
	if(!$agave->uri['validRequest']) return DESTINATION_UNKNOWN;

	$agave->status = BOOTSTRAP_SESSION;
	return bootstrap(BOOTSTRAP_ACCESS);
}

function bootstrap_access() {
	/*
	 * Eighth phase: access checks
	 * If URL-level access is specified, we check the user against that access argument, if the user doesn't have access, we stop execution
	 */
	global $agave;
	
	if(!empty($agave->uri['access']) && !$GLOBALS['objects']['user']->access($agave->uri['access'])) return ACCESS_DENIED;
	
	$agave->status = BOOTSTRAP_ACCESS;
	return bootstrap(BOOTSTRAP_LANG);
}

function bootstrap_lang() {
	/* TODO: this may be taken out of bootstrap process and moved to the THEMER - why?  Because odds are you are only loading language information for the purposes of DISPLAYING a page, which the themer is responsible for; IF it is moved out, then LANG info will be loaded either on Themer construction OR on first call to $themer->theme()
	 * Ninth phase: language
	 * TODO: this is irrelevant for now - but once we get to a point where we provide multilingual support, extra language support will need to be loaded in this stage
	 * This will involve resolving which language to load, based on both given URL (looking for things www.en.russnet.org vs www.ru.russnet.org, or something like that), and user langauge settings (doesn't have a field in `users` yet, but will)
	 * Once you know which language to use, load the language file from the i18n folder (also doesn't exist yet)
	 * Now any string can be run through the $agave->t() function, if it has a match in the loaded langauge, the translated string is returned, otherwise the given string is returned
	 * Yes, once this is implemented you'll have to go back through core and your own module code to find any places like menu item names, site names, whatever and change it from $string to $agave->t($string) - sucks, but ... that's life
	 * Note that $agave->t() is mainly for interface items... items which don't have extra DB tables to provide translations, it is NOT to be used for core content.
	 * For example, if you have a module to handle news articles, you should provide your own database datables to store translations of those articles, using $agave->t() tries to match the string to a translated string in a text file based on $agave->lang
	 * ...Anyway, for now it doesn't do anything, just a placeholder, if the request gets this far, it's obviously successful and should be routed.
	 * VALID_REQUEST is returned, and index.php routes the file, returning and printing any output
	 */
	global $agave;
	//TODO: figure out best way to deal with languages, where to store interface translation file, etc...





	$agave->status = BOOTSTRAP_LANG;
	return VALID_REQUEST;
}


function banned_location() {
	global $settings;
	header('HTTP/1.1 403 Forbidden');
	die("<h1>HTTP/1.1 403 Forbidden</h1><h2>Your location has been banned from accessing <em>".$_SERVER['SERVER_NAME']."</em>.</h2>");
}

function site_not_found() {
	//TODO: load pretty fail page
	header('HTTP/1.1 404 Not Found');
	die("<h1>HTTP/1.1 404 Not Found</h1><h2>Agave could not find the site you requested: <em>".$_SERVER['SERVER_NAME']."</em>.</h2>");
}

function site_offline() {
	global $agave;
	//TODO: load pretty fail page
	header('HTTP/1.1 404 Not Found');
	die("<h1>HTTP/1.1 404 Not Found</h1><h2>Agave could not establish a database connection to <em>".$_SERVER['SERVER_NAME']."</em>.</h2><p>$agave->dbError</p>");
}

function agave_error_page($type=NULL, $message=NULL) {
	//The purpose of this function is to kill the processing of a request midstream, yet still render a full page with the necessary message
	//The most common need for this would be for "404" errors or "ACCESS_DENIED" errors
	//common errors (note that these aren't real HTTP responses, we use these codes for convenience because they correspond to actual errors that would occur if Apache were to handle this scenario on the file system):
	//404 - content not found on server (or in database)
	//403 - access denied
	global $agave;
	$t = $agave->load('themer');
	$_SESSION['agave_error_page'] = TRUE;

	//get error message
	$message = ($message) ? $message : $agave->setting("message-".$type);
	if(!isset($message)) $message = "A serious error occured - please contact the site administrator if this is a recurring issue";
	$t->output = $message."<hr /><h5>URL info: </h5><pre>".print_r($agave->uri, TRUE)."</pre>";

	$type = ($type) ? $type : "unknown";
	$agave->log($type, $message);

	//set headers if necessary
	if($type=='404') {
		$t->page['title'] = "Content Not Found (404)";
		header('HTTP/1.1 404 Not Found');
	}
	if($type=='403') {
		$t->page['title'] = "Access Denied (403)";
		header('HTTP/1.1 403 Forbidden');
	}
	if($type=='415') {
		$t->page['title'] = "Unsupported Media Type (415)";
		header('HTTP/1.1 415 Unsupported Media Type');
	}
	
	//use page template to markup error page
	$t->output = $t->theme(NULL, $t->pageTemplate);

	unset($_SESSION['agave_error_page']);

	//render error page
	$agave->stop($t->output."<p style='padding: 5px;color: #fff'>".agave_timer_return()."</p>");
}

function agave_error_handler($errno, $errstr, $errfile, $errline) {
	global $agave;
	$types = array( //thanks drupal, seriously
		1 => 'error',
		2 => 'warning',
		4 => 'parse error',
		8 => 'notice',
		16 => 'core error',
		32 => 'core warning',
		64 => 'compile error',
		128 => 'compile warning',
		256 => 'user error',
		512 => 'user warning',
		1024 => 'user notice',
		2048 => 'strict warning',
		4096 => 'recoverable fatal error'
	);

	$message = "<code>PHP ".$types[$errno]."</code>: \"$errstr\" in <em>$errfile</em> on line <b>$errline</b>";
	
	$agave->message('error', NULL, $message);

    return true;
}

function agave_timer_start() {
	global $agave_timer; 
	$agave_timer = microtime(TRUE);
}

function agave_timer_return() {
	global $agave_timer;
	return substr((microtime(TRUE) - $agave_timer), 0, 7);
}

function __autoload($object) {
	/*
	 * Provides support for autoloading in classes that are being extended or implemented
	 */
	global $agave;
	$file = (isset($agave->module_env['objects'][$object])) ? $agave->module_env['objects'][$object] : FALSE;
	if(!$file) die("Autoload error - could not load <em>$object</em> object.<hr><h3>URI info:</h3><pre>".print_r($agave->uri, TRUE)."</pre><h3>Module info:</h3><pre>".print_r($agave->setting('module_data'), TRUE)."</pre>");
	if(file_exists($file)) include($file);
}

function t($string) {
	global $agave;
	if($agave->languagesLoaded) {
		//check against dictionary, return translated string
	}
	else return $string;
}