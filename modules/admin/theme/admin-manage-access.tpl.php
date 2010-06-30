<h2>Manage Access Properties</h2>
<p>Use the table below to manage the access properties available in your project.  Be careful not to delete access properties which are in use in menus and URLs, as they will become inaccessible</p>
<div id='admin-page-controls'>
	<h4>Options</h4>
	<p><a class='fm-button' href='<?php print $agave->base_url."admin/access/add" ?>'>Add Property</a></p>
	<p><a class='fm-button' href='<?php print $agave->base_url."admin/access" ?>'>Map Privileges</a></p>
</div>

<table>
	<tbody>
	<tr>
		<th>Label</th>
		<th>Action</th>
		<th>Description</th>
		<th>Default</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0; $i<count($properties); $i++): ?>
		<?php if(!isset($properties[$i-1]['module']) || $properties[$i-1]['module'] != $properties[$i]['module']) print "<th colspan=5>".$properties[$i]['module']."</th>" ?>
		<tr <?php if($i%2 != '0') print "class='table-zebra'" ?>>
			<td><?php print $properties[$i]['label'] ?></td>
			<td><?php print $properties[$i]['action'] ?></td>
			<td><?php print $properties[$i]['desc'] ?></td>
			<td><?php print (isset($properties[$i]['default']) && $properties[$i]['default']=='1') ? "Allow" : "Deny" ?></td>
			<td>
				<a href='<?php print $agave->base_url."admin/access/edit/".$properties[$i]['aKey'] ?>'>edit</a> - 
				<a href='<?php print $agave->base_url."admin/access/delete/".$properties[$i]['aKey'] ?>'>delete</a> 
			</td>
		</tr>
	<?php endfor; ?>
	</tbody>
</table>