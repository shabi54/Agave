<table>
	<tbody>
		<tr>
			<?php if($editButton): ?>
				<td>
					<a class='mo-edit' title='Edit this media object.' href='<?php print $agave->base_url."media/$mediaKey/edit"?>'>edit</a>
				</td>
			<?php endif; ?>
			<?php if($transcodeButton): ?>
				<td>
					<a class='mo-transcode' title='Make this object viewable on the web.' href='<?php print $agave->base_url."media/$mediaKey/transcode"?>'>transcode</a>
				</td>
			<?php endif; ?>
			<?php if($deleteOriginal): ?>
				<td>
					<a class='mo-deleteOriginal' title='Delete the original file for this object.' href='<?php print $agave->base_url."media/$mediaKey/deleteOriginal"?>'>deleteOriginal</a>
				</td>
			<?php endif; ?>
			<?php if($deleteCompressed): ?>
				<td>
					<a class='mo-deleteCompressed' title='Delete all web-compressed files for this object.' href='<?php print $agave->base_url."media/$mediaKey/deleteCompressed"?>'>deleteCompressed</a>
				</td>
			<?php endif; ?>
			<?php if($deleteObject): ?>
				<td>
					<a class='mo-deleteObject' title='Mark this entire object for deletion.' href='<?php print $agave->base_url."media/$mediaKey/deleteObject"?>'>deleteObject</a>
				</td>
			<?php endif; ?>
		</tr>
	</tbody>
</table>