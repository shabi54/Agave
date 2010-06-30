<h2>Actions</h2>
<p>Use the form below to manage the site's actions.</p>
<div id='admin-page-controls'>
	<h4>Options</h4>
	<a class='fm-button' href='<?php print $agave->base_url."admin/actions/add" ?>'>Add Action</a>
</div>

<table>
	<tbody>
		<tr>
			<th>Action</th>
			<th>Description</th>
			<th>Active</th>
			<th>Actions</th>
		</tr>
		<?php for($i=0; $i<count($actions); $i++): ?>
		<?php if(!isset($actions[$i-1]['module']) || $actions[$i]['module'] != $actions[$i-1]['module']): ?>
			<tr>
				<th class='access-module-header' colspan=4>
					<?php echo $actions[$i]['module'] ?> Module
				</th>
			</tr>
		<?php endif; ?>
		<?php
			$fm = $agave->load('fieldManager');
			$default = ($actions[$i]['active']==TRUE) ? array($actions[$i]['name']) : NULL;
			$element = array(
				'name'=>$actions[$i]['name'],
				'type'=>'checkbox',
				'nolabel'=>TRUE,
				'values'=>array($actions[$i]['name']),
				'default'=>$default
			);
		?>
		<tr <?php if($i%2==0) echo "class='table-zebra'"; ?>>
			<td><?php echo $actions[$i]['action'] ?></td>
			<td><?php echo $actions[$i]['desc'] ?></td>
			<td><?php echo $fm->generateElement($element) ?></td>
			<td>
				<a href='<?php print $agave->base_url."admin/actions/edit/".$actions[$i]['eKey'] ?>'>edit</a> - 
				<a href='<?php print $agave->base_url."admin/actions/delete/".$actions[$i]['eKey'] ?>'>delete</a>
			</td>
		</tr>
		<?php endfor; ?>
	</tbody>
</table>