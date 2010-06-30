<?php
	$fm = $agave->load('fieldManager');
	$this->addCSS('fieldManager',"theme/css/fm-defaults.css");
?>
<p>Use the crazy form below to manage your panels.</p>

<?php print $fm->startForm($agave->base_url."admin/panels/save", "post"); ?>
	<table>
		<tbody>
			<?php foreach($elements as $panel): ?>
				<tr>
					<td><?php print $fm->generateElement($panel['name']) ?></td>
					<td><?php print $fm->generateElement($panel['module']) ?></td>
					<td><?php print $fm->generateElement($panel['title']) ?></td>
					<td><?php print $fm->generateElement($panel['content']) ?></td>
					<td><?php print $fm->generateElement($panel['query']) ?></td>
					<td><?php print $fm->generateElement($panel['template']) ?></td>
					<td><?php print $fm->generateElement($panel['func']) ?></td>
					<td><?php print $fm->generateElement($panel['region']) ?></td>
					<td><?php print $fm->generateElement($panel['include']) ?></td>
					<td><?php print $fm->generateElement($panel['exclude']) ?></td>
					<td><?php print $fm->generateElement($panel['access']) ?></td>
					<td><?php print $fm->generateElement($panel['weight']) ?></td>
					<td>
						<?php print $fm->generateElement($panel['enabled']) ?>
						<?php print $fm->generateElement($panel['id']) ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php print $fm->endForm("Save Changes"); ?>