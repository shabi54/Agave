<div id='mo-image'>
	<p>
		<img src='<?php //print $media->transcodedFile[$format]->url ?>'>
		<h4>image display here</h4>
	</p>
</div>
<div id='mo-other-images'>
	print links to other image formats accordingly
</div>

<?php if($downloadOriginal || $downloadCompressed): ?>
<div id='mo-files'>
	<p>Use the links below to download the original, or web-compressed versions of this media.</p>
	<ul>
	<?php if($downloadOriginal): ?>
		<li><a href='<?php print $agave->base_url."media/download&mediaKey=$media->mediaKey&version=original" ?>'>original</a></li>	
	<?php endif; ?>
	<?php if($downloadCompressed): ?>
		<?php foreach($media->transcodedFiles as $preset=>$file): ?>
			<li><a href='<?php print $file->url ?>'><?php print $preset ?></a></li>
		<?php endforeach; ?>
	<?php endif; ?>
	</ul>
</div>
<?php endif; ?>
