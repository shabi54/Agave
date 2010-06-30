<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
	<title><?php print $title." | ".$siteName ?></title>
	<?php print $styles ?>
	<?php print $javascript ?>
</head>



<body>

    <div id="header">
    	<div id='header-center'>
			<h1><a href='<?php print $agave->agave_base_url ?>'><?php print $siteName ?></a></h1>
        </div>
    </div><!-- header -->
    
    <!-- Main Menu-->
    <div id="navigation">
    	<div id='navigation-center'>
			<?php print $this->returnMenu('main', TRUE); ?>
		</div>
    </div><!-- /navigation -->

    

    <div id="container">            
		<!-- Main content -->
        <div id="primaryContent">
			<!-- Messages -->
			<?php if ($messages): ?>
				<div id='messages'>
					<?php echo $messages; ?>
				</div>
			<?php endif; ?>
			
			<!-- Themer's content -->
   			<?php print $themerContent ?>
    	</div><!-- /primaryContent -->

		<!-- Right column -->
		<div id="secondaryContent">
       		<?php print $right; ?>
		</div><!-- /secondaryContent -->

        <br class="clear" />    

    </div><!-- container -->

    
	<!-- Footer -->
    <div id="footer">
    	<?php print $footer_message ?>
		<?php print $footer ?>
    </div><!-- /footer -->
	<?php if(isset($debug) && !$user->isAnon) print $debug; ?>
</body>

</html>