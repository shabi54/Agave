<div id='user-content-list'>
	<table>
		<tbody>
			<tr class='table-header'>
				<th>Title</th>
				<th>Type</th>
				<th>Modified</th>
				<th>Created</th>
				<th>Published</th>
				<th>Actions</th>
			</tr>
		<?php foreach($nodes as $node): ?>
			<tr class='user-row'>
				<td>
					<?php print substr($node->fields->values->title, 0, 20); ?>
				</td>
				<td>
					<?php print $node->type; ?>
				</td>
				<td>
					<?php print date("M d Y", $node->time_modified); ?>
				</td>
				<td>
					<?php print date("M d Y", $node->time_created); ?>
				</td>
				<td>
					<?php print ($node->published) ? "yes" : "no"; ?>
				</td>
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