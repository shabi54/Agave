<h2>Your Media Objects</h2>
<p>Below are any media objects that you have uploaded, whether public/private, published or unpublished.  Use the table below to navigate to your objects and manage them accordingly.</p>

<?php if($items): ?>
	<table>
		<tbody>
			<tr class='table-header'>
				<th>Name</th>
				<th>Type</th>
				<th>Modified</th>
				<th>Created</th>
				<th>Actions</th>
			</tr>
		<?php $i=0; foreach($items as $media): ?>
			<tr <?php if($i%2 != 0) print "class='table-zebra'"?>>
				<td>
					<?php print $media['name']; ?>
				</td>
				<td>
					<?php print $media['type']; ?>
				</td>
				<td>
					<?php print date("M d Y", $media['time_modified']); ?>
				</td>
				<td>
					<?php print date("M d Y", $media['time_created']); ?>
				</td>
				<td>
					<a href='<?php print $agave->base_url."media/".$media['mediaKey'] ?>'>view</a> -
					<a href='<?php print $agave->base_url."media/".$media['mediaKey']."/edit" ?>'>edit</a> - 
					<a href='<?php print $agave->base_url."media/".$media['mediaKey']."/delete" ?>'>delete</a>
				</td>
			</tr>
		<?php $i++; endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
<h4>You have not uploaded any media objects.</h4>
<?php endif; ?>