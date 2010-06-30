<?php
	//if an admin theme is set, by virtue of calling up this template file, the theme will be changed to that admin theme
	if($agave->setting('admin_theme') && $this->theme != $agave->setting('admin_theme')) $this->setTheme($agave->setting('admin_theme'));
	if(isset($this->adminPageTemplate)) $this->pageTemplate = $this->adminPageTemplate;
	$this->addJS('admin',"theme/js/admin-drop-down.js");
	print $themerContent;
?>