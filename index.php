<?php
//for single installation projects - fill these in
//$settings['proj_root'] = "sites/localhost.agave/";
//$settings['proj_url'] = "http://localhost/agave/";


//I used BBEdit here and resolved a conflict visible in the code

require('./core/bootstrap.inc');
agave_timer_start();

$status = bootstrap();
switch($status) {
	case SITE_NOT_FOUND: site_not_found(); break;
	
	case SITE_OFFLINE: site_offline(); break;
	
	case ACCESS_DENIED: agave_error_page("403"); break;
	
	case DESTINATION_UNKNOWN : agave_error_page("404"); break;
	
	case VALID_REQUEST: {
		$output = $GLOBALS['objects']['dispatcher']->route($agave->uri); //TODO: change request functions to RETURN output, rather than set globally

		//assemble final page output with an invoke to 'page_render'
		if(!empty($GLOBALS['objects']['themer']->output)) {
			$agave->invoke('pre_page_render');
			$GLOBALS['objects']['themer']->output = $GLOBALS['objects']['themer']->theme(NULL, $GLOBALS['objects']['themer']->pageTemplate); //change to send $output as variable
			$agave->invoke('post_page_render');
		}

		$agave->invoke('cleanup');	//last minute cleanup before output is thrown to screen
		$agave->cleanup();	//logs are written, sessions are closed
		$agave->disconnect(); //disconnect before print so that db connection is not hanging around during i/o, waste of connection time
		
		//print output
		if(isset($GLOBALS['objects']['themer']->output)) print $GLOBALS['objects']['themer']->output;
		break;
	}

	default : echo("Agave is IMPOSSIBLY confused...");
}
exit("<div style='float: left;'>Time to render: ".agave_timer_return()."</div>");

//change at bottom!!