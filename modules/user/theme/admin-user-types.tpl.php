<h2>User types</h2>
<p>Use the interface below to delete or add user types to your system.  Note that you cannot delete/modify the "Anonymous" and "Authenticated" user types - these are necessary for Agave to function properly and distinguish between those are logged in and truly anonymous users.</p>
<div id='admin-page-controls'>
	<h4>Options</h4>
	<p><a class='fm-button' href='<?php print $agave->base_url."admin/users/types/add" ?>'>Add user type</a></p>
	<p><a class='fm-button' href='<?php print $agave->base_url."admin/users" ?>'>Browse Users</a></p>
</div>
<div id='user-type-table'>
	<table>
		<thead>
			<th>Type</th>
			<th>Description</th>
			<th>Actions</th>
		</thead>
		<tbody>
		<?php foreach($sql as $type): ?>
			<tr>
				<td><?php print $type['label'] ?></td>
				<td><?php print $type['desc'] ?></td>
				<td>
					<a href='<?php print $agave->base_url."admin/users/types/edit/".$type['typeKey']?>'>edit</a>
					<?php if($type['name'] != 'anon'): ?>
						<a href='<?php print $agave->base_url."admin/schemata&table=user&type=".$type['name'] ?>'>prefs</a>
					<?php endif; ?>
					<?php if($type['name'] != 'anon' && $type['name'] != 'authenticated'): ?>
						<a href='<?php print $agave->base_url."admin/users/types/delete/".$type['typeKey'] ?>'>delete</a>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>