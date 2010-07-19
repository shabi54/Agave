<?php
	$this->addCSS('contentNode',"theme/css/node.css");
?>

<div class='node-wrapper node-wrapper-<?php echo $node->type ?>'>
	<?php if($editButton): ?>
		<a class='node-edit-button' href='<?php echo $agave->base_url."content/$node->contentNodeKey/edit" ?>'></a>
	<?php endif; ?>

	<?php foreach($node->fields->schema as $row): if(($row['access'] && $user->access($row['access']) || !$row['access']) && $row['value']): ?>
		<div class='node-field node-field-<?php echo $row['keyName'] ?>'>
			<?php print($row['value']); ?>
		</div>
	<?php endif; endforeach; ?>
</div>