<h2>Edit Schemata</h2>


<?php if($types): ?>
	<p>Select which type you would like to edit from the list below.</p>
	<ul>
	<?php foreach($types as $type): ?>
		<li>
			<a href='<?php echo $agave->base_url."admin/schemata&table=$table&type=".$type['name']?>'><?php echo $type['label'] ?></a>
			 - <?php print $type['desc'] ?>
		</li>
	<?php endforeach; ?>
	</ul>
<?php else: ?>
	<p>You have no types to manage in this set of schema tables.</p>
<?php endif; ?>