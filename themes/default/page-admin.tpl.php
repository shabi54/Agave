<?php
/*
 * Variables generally available for this template:
 * $themerContent, $messages, $errors, $styles, $javascript, $pageTitle, $siteName, $footer
 * Note that this doesn't includes $REGIONS defined in your theme ($right, $left, $main, $whatever)'
 * 
 *NOTE: Cannot use $this->addJS() or $this->addCSS() on on final page template because $javascript and $styles have already been extracted
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
	<?php if(isset($keywords)): ?>
		<meta name='keywords' content='<?php echo $keywords ?>' />
	<?php endif; ?>
	<?php if(isset($description)): ?>
		<meta name='description' content='<?php echo $description ?>' />
	<?php endif; ?>
	<?php if(isset($title)): ?>
		<title><?php echo $siteName ?> | <?php echo $title ?></title>
	<?php endif; ?>
	<?php echo $javascript ?>
	<?php echo $styles ?>
	<link href="<?php print $agave->agave_base_url."themes/default/css/page-admin.css" ?>" type="text/css" media="screen" rel="stylesheet">
</head>
<body>
	<div id='admin-header'>
		<div id='admin-header-left'>
			<span  id='siteName'><a href='<?php print $agave->agave_base_url ?>'><?php print $siteName ?></a></span>
			<br /><span id='siteSlogan'>agave admin</span>
		</div>
		<div id='admin-header-right'>
			<?php print $this->returnMenu('main'); ?>
			<div id='user'>user: <a href='<?php print $agave->base_url."user/profile" ?>'><?php print $user->login ?></a> - <a href='<?php print $agave->base_url."user/logout" ?>'>logout</a></div>
		</div>
	</div>
	<div id='admin-nav'>
		<?php print $this->returnMenu('admin', TRUE); ?>
	</div>
	<div id='admin-subnav'>
	</div>

	<div id='admin-main'>
		<div id='admin-float'>
			<div id='admin-content'>
				<?php if ($messages): ?>
					<div id='messages'>
						<?php echo $messages; ?>
					</div>
				<?php endif; ?>
				<?php print $themerContent; //content from admin.tpl.php?>
			</div>
		</div>
	</div>

	<div id='admin-footer'>
		<?php print $footer_message ?>
	</div>
	<?php if(isset($debug)) print $debug; ?>
</body>
</html>