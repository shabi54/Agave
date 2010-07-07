<?php
/*
 * Created on Mar 17, 2010
 * Evin Willimez, Shabnam Tafreshi
 * Overview of the Assessment Objects data
 *
 */
?>

<h2>Object List</h2>
<?php if ($objects): ?>
	<table>
		<tbody>
			<tr class='table-header'>
				<th>Object Name</th>
				<th>Object Type</th>
				<th>Date Created</th>
				<th>Date Modified</th>
				<th>Activities</th>
			</tr>
		<?php foreach($objects as $thisObject): ?>
			<tr class='user-row'>
				<td>
					<?php print $thisObject['objectName'] ?>
				</td>
				<td>
					<?php print $thisObject['objectType'] ?>
				</td>
				<td>
					<?php print $thisObject['dateInitiated'] ?>
				</td>
				<td>
					<?php print $thisObject['last_modified'] ?>
				</td>
				<td>
					<a href='<?php print $agave->base_url."itemBank/".$thisObject['objectKey'] ?>'>view</a> -
					<a href='<?php print $agave->base_url."itemBank/".$thisObject['objectKey']."/delete" ?>'>delete</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php else : ?>
<p>You have not uploaded anything - try <a href='<?php print $agave->base_url."itemBank/create" ?>'>creating a new one</a>.</p>
<?php endif ?>