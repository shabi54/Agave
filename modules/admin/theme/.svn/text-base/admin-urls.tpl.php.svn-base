<h2>Manage URLs</h2>
<p>Use the table below to manage the settings for URLs on your site.  
DO NOT edit URLs for modules you did not create unless you really know what you're doing.  
Click "add new" to add a new URL to your site.
</p>
<div id='admin-page-controls'>
	<h4>Options</h4>
	<a class='fm-button' href='<?php print $agave->base_url."admin/urls/add" ?>'>add url</a>
</div>

<?php if($sql): ?>
	<table>
		<thead>
			<tr>
				<th>Destination</th>
				<th>Alias</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
	<?php for($i=0; $i<count($sql); $i++): ?>
		<?php if(!isset($sql[$i-1]['module']) || $sql[$i-1]['module'] != $sql[$i]['module']): ?>
		<th colspan=3><?php print $sql[$i]['module'] ?> Module</th>
		<?php endif; ?>
		<tr <?php if($i%2 != 0) print "class='table-zebra'"?> >
			<td><?php print $sql[$i]['dest'] ?></td>
			<td><?php print $sql[$i]['alias'] ?></td>
			<td>
				<a href='<?php print $agave->base_url."admin/urls/edit/".$sql[$i]['uriKey'] ?>'>edit</a> - 
				<a href='<?php print $agave->base_url."admin/urls/delete/".$sql[$i]['uriKey'] ?>'>delete</a>
			</td>
		</tr>
	<?php endfor; ?>
		</tbody>
	</table>
<?php else: ?>
	<p>No URLs to manage... click to add new</p>
<?php endif; ?>