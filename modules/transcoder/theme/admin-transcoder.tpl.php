<h2>Transcoding</h2>
<p>Here are the plugins available:</p>
<?php if($plugins): ?>
<ul>
	<?php foreach($plugins as $plugin): ?>
	<li><?php print $plugin; ?></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
<p>These are the presets available for use:</p>
<p><a href=<?php print $agave->base_url."admin/transcoder/preset/create"?>>Create Preset</a></p>
<?php if($presets): ?>
	<table>
		<thead>
			<th>Name</th>
			<th>Plugin</th>
			<th>Accepted Extensions</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach($presets as $preset): ?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>