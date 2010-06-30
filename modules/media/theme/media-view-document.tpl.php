<h3>Lookie, got a document yay!</h3>

<?php if($downloadOriginal || $downloadCompressed): ?>
<div id='mo-files'>
	<p>Use the links below to download the original, or web-compressed versions of this media.</p>
	<ul>
	<?php if($downloadOriginal): ?>
		<li><a href='<?php print $media->originalFile->url ?>'>original</a></li>	
	<?php endif; ?>
	<?php if($downloadCompressed): ?>
		<?php foreach($media->transcodedFiles as $preset=>$file): ?>
			<li><a href='<?php print $file->url ?>'><?php print $preset ?></a></li>
		<?php endforeach; ?>
	<?php endif; ?>
	</ul>
</div>
<?php endif; ?>

<?php if(!empty($media->transcript)): ?>
<div id='mo-transcript'>
	<?php print $media->transcript; ?>
</div>
<?php endif; ?>