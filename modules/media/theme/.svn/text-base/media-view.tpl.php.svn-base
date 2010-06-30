<?php
	$this->addJS('media',"theme/js/mo-general.js");
	$this->addJS('media',"theme/css/mo-general.css");
?>
<div id='media-controls'>
	<?php print $mediaControls ?>
</div>

<h2>"<?php print $media->name ?>"</h2>
<p><?php print $media->description ?></p>

<div id='media-main'>
	<?php print $mediaHTML ?>
</div>

<?php if($media->coding): ?>
	<div id='media-coding'>
		<?php print $media->coding->displaySchema(); ?>
	</div>
<?php endif; ?>

<?php //if($nodeView) print $nodeView; ?>