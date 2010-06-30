<h2>Panels</h2>
<p>View and manage your panels below, they are organized by region.</p>
<div id='admin-page-controls'>
	<h4>Options</h4>
	<a class='fm-button' href='<?php print $agave->base_url."admin/panels/add" ?>'>Add Panel</a>
</div>

<?php foreach($panels as $region=>$data): ?>
<div class='admin-panel-region'>
	<h3><?php print $region?></h3>
	<?php foreach($data as $panel): ?>
	<div class='admin-panel-block'>
		<?php print $panel['name'] ?> - 
		<a href='<?php print $agave->base_url."admin/panels/edit/".$panel['id'] ?>'>configure</a> - 
		<a href='<?php print $agave->base_url."admin/panels/delete/".$panel['id'] ?>'>delete</a>
	</div>
	<?php endforeach; ?>
</div>
<?php endforeach; ?>