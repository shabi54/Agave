<h2>Manage User</h2>
<p>Use the form below to manage the user_types and access privileges for <b><?php print "$user->firstName $user->lastName" ?></b></p>

<?php print $user_types_form ?>
<hr />
<?php print $access_form ?>

<?php if($user_specific_warning): ?>
	<hr />
	<h4>User-specific privileges</h4>
	<p><strong><em>WARNING!</em></strong> This user has user-specific privileges mapped.  
	These privilges override access properties which are based on user-level.  
	This may cause unintended situations if you are not careful.  
	To remove user-specific privileges, use the button below.</p>
	<a href='<?php print $agave->base_url."admin/users/$user->userKey/drop-access/999999999999" ?>'>Clear All</a>
	
	<table>
		<thead>
			<th>Action</th>
			<th>Value</th>
		</thead>
		<tbody>
		<?php foreach($user_specific_privileges as $item): ?>
			<tr>
				<td><?php print $item['action'] ?></td>
				<td><?php print (isset($item['value']) && $item['value']=='1') ? "ALLOW" : "DENY" ?></td>
				<td>
					<a href='<?php print $agave->base_url."admin/users/$user->userKey/drop-access/".$item['mKey'] ?>' class='admin-delete-item'>remove</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
