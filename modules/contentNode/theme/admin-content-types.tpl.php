<h2>Content Types</h2>
<p>Below are the content types available to your site, you can edit/delete or manage their fields from here.</p>

<div id='admin-page-controls'>
	<h4>Options</h4>
	<a href='<?php print $agave->base_url."admin/content/types/add" ?>' class='fm-button'>Add Type</a>
</div>
<?php if($types): ?>
<table>
	<thead>
		<th>Type</th>
		<th>Description</th>
		<th>Actions</th>
	</thead>
<tbody>
<?php foreach($types as $type): ?>
	<tr>
		<td><?php print $type['label'] ?></td>
		<td><?php print $type['desc'] ?></td>
		<td>
			<a href='<?php print $agave->base_url."admin/schemata&table=contentNode&type=".$type['name'] ?>'>fields</a> - 
			<a href='<?php print $agave->base_url."admin/content/types/edit/".$type['typeKey'] ?>'>edit</a> - 
			<a href='<?php print $agave->base_url."admin/content/types/delete/".$type['typeKey'] ?>'>delete</a>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php else: ?>
	<h4>Your site has no content types to manage, try adding a new one.</h4>
<?php endif; ?>