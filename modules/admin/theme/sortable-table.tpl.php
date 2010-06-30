<table class='agave-sortable-table' id='<?php print $cssID ?>'>
	<thead>
	<?php foreach($headers as $header=>$data): ?>
		<th>
			<?php print $header ?>
		</th>
	<?php endforeach; ?>
	</thead>
	<tbody>
	<?php for($i=0; $i<count($tabledata); $i++): ?>
		<tr>
			<?php foreach($tabledata[$i] as $field=>$value): ?>
				<td><?php print $value ?></td>
			<?php endforeach; ?>
		</tr>
	<?php endfor; ?>
	</tbody>
</table>
