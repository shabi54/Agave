<h2>Edit Schemata</h2>
<p>Select which schema you would like to modify from the list of available schemata below.</p>

<ul>
<?php foreach($tables as $table): ?>
	<li><a class='admin-schema-table' href='<?php echo $agave->base_url."admin/schemata&table=".$table; ?>'><?php echo $table ?></a></li>
<?php endforeach; ?>
</ul>
