<h2>Modules</h2>
<p>Below are the modules available to your site. The potentential actions you may perform, and their consequences are lised below.</p>
<ul>
	<li><b>Install</b> - Adds module into list of active modules, and adds all pertinent data in it's .info file into the necessary SQL tables.  May create new SQL tables specific to the module.</li>
	<li><b>Uninstall</b> - Removes all data associated with given module, including dropping tables it was responsible for creating.</li>
	<li><b>Activate</b> - Activate a module that is already uninstalled, but not currently being used.</li>
	<li><b>Deactivate</b> - Removes module from active list, preventing it from functioning, but does NOT remove it's data from the database.</li>
</ul>

<?php foreach($modules as $location=>$categories): if(!empty($categories)): ?>
<h3><?php print $location ?> Modules</h3>

	<?php foreach($categories as $category=>$modules): ?>
	<fieldset>
	<legend><?php print $category ?></legend>
		<table>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Version</th>
				<th>Dependencies</th>
				<th>Enabled</th>
				<th>Actions</th>
			</tr>
			<?php foreach($modules as $module): ?>
			<tr class='module-wrapper module-<?php if($module['enabled'] && !$module['outdated']){print "enabled";} elseif($module['outdated']){print "outdated";} else{print "disabled";}?>'>
				<td><b><?php print $module['name']?></b></td>
				<td><?php print $module['description']?></td>
				<td><?php print $module['version']?></td>
				<td><?php print implode(", ", $module['dependencies']) ?></td>
				<td><?php print $module['enabled']?></td>
				<td>
					<?php foreach($module['actions'] as $action): ?>
						<a href='<?php print $action['href'] ?>'><?php print $action['name'] ?></a>
					<?php endforeach; ?> 
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</fieldset>
	<?php endforeach; ?>

<?php endif; endforeach; ?>