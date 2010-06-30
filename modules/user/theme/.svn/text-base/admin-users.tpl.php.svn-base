<?php
	$this->addCSS('user',"theme/css/user-admin.css");
?>

<h2>Users</h2>
<p>Use the table below to browse the users of your system.  From here you can also manage individual user permissions, and the user types of your system.</p>
<div id='admin-page-controls'>
	<h4>Options</h4>
	<p><a class='fm-button' href='<?php print $agave->base_url."admin/users/types" ?>'>Manage User Types</a></p>
	<p><a class='fm-button' href='<?php print $agave->base_url."admin/users/add" ?>'>Add user</a></p>
</div>

<div id='user-list'>
	<h3>Users in your system:</h3>
	<table>
		<tbody>
			<tr class='table-header'>
				<th>Key</th>
				<th>First</th>
				<th>Last</th>
				<th>Email</th>
				<th>Signup</th>
				<th>Actions</th>
			</tr>
		<?php foreach($userData as $user): $i=0;?>
			<tr class='user-row <?php if($i%2 != 0) print "table-zebra" ?>'>
				<td>
					<?php print $user['userKey']; ?>
				</td>
				<td>
					<?php print $user['firstName']; ?>
				</td>
				<td>
					<?php print $user['lastName']; ?>
				</td>
				<td>
					<?php print $user['email']; ?>
				</td>
				<td>
					<?php print date("M d Y", $user['date_added']); ?>
				</td>
				<td>
					<a href='<?php print $agave->base_url."user/profile/".$user['userKey'] ?>'>view</a> 
					<a href='<?php print $agave->base_url."admin/users/manage/".$user['userKey'] ?>'>manage</a>
					<a href='<?php print $agave->base_url."admin/users/message/".$user['userKey'] ?>'>message</a>
					<a href='<?php print $agave->base_url."admin/users/delete/".$user['userKey'] ?>'>delete</a> 
				</td>
			</tr>
		<?php $i++; endforeach; ?>
		</tbody>
	</table>
</div>