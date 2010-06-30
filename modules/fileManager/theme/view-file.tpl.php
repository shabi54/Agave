<h2>View File</h2>
<p>Use the table below to manage the files that you have uploaded.</p>

<hr />
<h3>File Key <?php print $file->fileKey ?></h3>
<table>
	<tbody>
	<?php foreach($file as $field=>$value):
			if(empty($value)) $value = "<em>NULL</em>";
		?>
		<tr>
			<td>
			<strong><?php print $field ?></strong>:
			</td>
			<td>
				<?php print ($field=='url') ? "<a href='$value'>".$value."</a>" : $value ?>
			</td>
		</tr>
	<?php endforeach; ?>
		<tr>
			<td colspan = '2'>
				<a href='<?php print $file->url ?>'>download</a> -
				<a href='<?php print $agave->base_url."files/$file->fileKey/edit" ?>'>edit</a>
			</td>
		</tr>
	</tbody>
</table>