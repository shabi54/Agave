<div id='contentList'>
	<h2>Browse Content</h2>
	<p>Below is a list of all content on the site, published or unpublished.</p>
	<div id='admin-page-controls'>
		<h4>Options</h4>
		<a class='fm-button' href='<?php print $agave->base_url."admin/content/types" ?>'>Manage Content Types</a>
	</div>

<?php if($nodes): ?>	
	<div id='nodeList'>
		<table>
			<tbody>
				<tr>
					<th>Name</th>
					<th>Type</th>
					<th>Time Modified</th>
					<th>Owner Key</th>
					<th>Published</th>
					<th>Actions</th>
				</tr>
				<?php foreach($nodes as $node): ?>
				<tr>
					<td><a href='<?php print $agave->base_url."content/".$node->contentNodeKey ?>'><?php print $node->fields->values->title ?></a></td>
					<td><?php print $node->type ?></td>
					<td><?php print date("M d Y", $node->time_created) ?></td>
					<td><?php print date("M d Y", $node->time_modified) ?></td>
					<td><?php print ($node->published) ? "yes" : "no" ?></td>
					<td>
						<a href='<?php print $agave->base_url."content/".$node->contentNodeKey ?>'>view</a> - 
						<a href='<?php print $agave->base_url."content/".$node->contentNodeKey."/edit" ?>'>edit</a> - 
						<a href='<?php print $agave->base_url."content/".$node->contentNodeKey."/delete" ?>'>delete</a> 
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<h4>Your site has no content to manage.</h4>
<?php endif; ?>
</div>