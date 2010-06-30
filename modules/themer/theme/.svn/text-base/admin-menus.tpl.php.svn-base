<h2>Menus</h2>
<p>Below are the menus available on your site. You can modify or delete these, or add new menus.</p>
<div id='admin-page-controls'>
	<h4>Options</h4>
	<a class='fm-button' href='<?php print $agave->base_url."admin/menus/add" ?>'>Add Menu</a>
</div>

<table>
	<thead>
		<th>Menu</th>
		<th>Description</th>
		<th>Actions</th>
	</thead>
	<tbody>
	<?php foreach($sql as $menu): ?>
		<tr>
			<td><?php print $menu['name'] ?></td>
			<td><?php print $menu['desc'] ?></td>
			<td>
				<a href='<?php print $agave->base_url."admin/menus/".$menu['menuKey']."/items/list" ?>'>view</a> - 
				<a href='<?php print $agave->base_url."admin/menus/edit/".$menu['menuKey'] ?>'>edit</a> - 
				<a href='<?php print $agave->base_url."admin/menus/delete/".$menu['menuKey'] ?>'>delete</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>