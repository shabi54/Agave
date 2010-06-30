<h2>Files uploaded by you</h2>
<p>Use the table below to manage any files which have been uploaded by you.  Be careful not to delete files that appear in other content - this interface should be used for clean-up purposes only, and will most likely be removed in the future. Use the button below to add a new file.</p>
<a href='<?php print $agave->base_url."files/upload" ?>'>Upload File</a>

<?php if($files): ?>
<table>
	<tr>
		<th>File</th>
		<th>Action</th>
		<th>Date</th>
		<th>Size</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0; $i<count($files); $i++): ?>
	<tr <?php if($i%2 != 0) print "class='table-zebra'" ?>>
		<td><?php print $files[$i]->uri ?></td>
		<td><?php print $files[$i]->extension ?></td>
		<td><?php print date("M d Y", $files[$i]->time_created) ?></td>
		<td><?php print $files[$i]->size ?></td>
		<td>
			<a href='<?php print $agave->base_url."files/".$files[$i]->fileKey ?>'>view</a> - 
			<a href='<?php print $agave->base_url."files/".$files[$i]->fileKey."/edit" ?>'>edit</a>
		</td>
	</tr>
	<?php endfor; ?>
</table>
<?php else: ?>
<p><b>There are no records of files uploaded by you.</b></p>
<?php endif; ?>