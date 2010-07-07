<?php
/*
 * Created on Mar 16, 2010
 * Author: Shabnam Tafreshi
 * view assessment Object template
 * 
 */
?>

<div id='assessmentView'>
<div id='assessmentControls'

<?php 

$this->addCSS($agave->site_dir."modules/AO/theme/css/ao.css");
//$agave->death($AO->mapData);
?>

	<table> 
	<?php if ($AO): ?>
	    <tr>
		   <td><b>Object Version:</b></td>
		   <td><b>
		   <?php if (!$AO -> version) print "Not Provided!"; else print $AO -> version . ": " . $AO ->ownerName;?>
	       </b></td>
		</tr>
		<tr>
		   <td>Object Name:</td>
		   <td>
		   <?php if (!$AO -> objectName) print "Not Provided!"; else print $AO -> objectName;?>
	       </td>
		</tr>
		<tr>
		   <td>Object Type:</td>
		   <td>
		   <?php if (!$AO -> objectType) print "Not Provided!"; else print $AO -> objectType;?>
	       </td>
		</tr>
		
		<?php
		if (isset($AO->mapData['codeSet'])):
			for($i=0;$i<count($AO->mapData['codeSet']);$i++):?>
			    <tr>
				   <td>Code Set #<?php print (int)($i+1);?>:</td>
				   <td>
				   <?php print $AO->mapData['codeSet'][$i]['codeSet']?>
				   </td>
				</tr>
		<?php
	        endfor;//for($i=0;$i<count($AO->mapData['codeSet']);$i++)
	    endif;//if (isset($AO->mapData['codeSet']))
	    
		if (isset($AO->mapData['instruction'])):
			for($i=0;$i<count($AO->mapData['instruction']);$i++):?>
			    <tr>
				   <td>Instruction #<?php print (int)($i+1);?>:</td>
				   <td>
				   <?php print $AO->mapData['instruction'][$i]['instruction']?>
				   </td>
				</tr>
		<?php
	        endfor;//for($i=0;$i<count($AO->mapData['instruction']);$i++):
	    endif;//if $AO->mapData['instruction'])
	    if (isset($AO->mapData['stem'])):
			 for($i=0;$i<count($AO->mapData['stem']);$i++):
			 $optionCounter = 1;?>
			    <tr>
				   <td>Stem #<?php print (int)($i+1);?>:</td>
				   <td>
				   <?php print $AO->mapData['stem'][$i]['stem']?>
				   </td>
				</tr>
			    <?php for($j=0;$j<count($AO->mapData['option']);$j++):
				          if ($AO->mapData['option'][$j]['parentIndex'] == $AO->mapData['stem'][$i]['index']):
					          $optionLabel = ($AO->mapData['option'][$j]['isCorrect'] == 1) ? "Key" : "Distractor #" . $optionCounter++?>
							    <tr>
								   <td align=right><?php print $optionLabel?>:</td>
								   <td>
								   <?php print $AO->mapData['option'][$j]['option']?>
								   </td>
								</tr>
				<?php 	  endif;//if ($AO->mapData['option'][$j]['parentIndex'] == $AO->mapData['stem'][$i]['index']):
				      endfor;//for($j=0;$j<count($AO->mapData['option']);$j++): 
			 endfor; //for($i=0;$i<count($AO->mapData['stem']);$i++):
		 endif;//if ($AO->mapData['stem']):
	  else: ?>
	  	<tr>
		   <td><?php print "There is no item for this objects.";?></td>
		</tr>
	<?php 	
	  endif;
	?>
	</table><br>
	<?php if($editButton): ?>
		  	<a class='fm-button' href=' <?php echo $agave->base_url."itemBank/$AO->objectKey/version/$AO->version/edit" ?>'>Edit</a>
	<?php endif; ?>
	<?php if($prevLink): ?>
	<a class='fm-button' href='<?php print $agave->base_url."itemBank/$AO->objectKey/version/".($AO->version-1)?>'>Previous</a>
	<?php endif; ?>
	<?php if($nextLink): ?>
		<a class='fm-button' href='<?php print $agave->base_url."itemBank/$AO->objectKey/version/".($AO->version+1)?>'>Next</a>
	<?php endif;
	    $whichVersion = ($AO->version-1) ? $AO->version-1 : $AO->version+1;
	    if (count($AO->allVersion) > 1):
	?>
		<a class='fm-button' href='<?php print $agave->base_url."itemBank/$AO->objectKey/compare/".$AO->version."/".$whichVersion?>'>Compare Versions</a>
	<?php endif; 
	if (isset($AO->mapData['comment'])): ?>
	    	<a class='fm-button' href=' <?php echo $agave->base_url."itemBank/$AO->objectKey/comment/$AO->version" ?>'>Comment</a>
	<?php endif;?>
	</div>
</div>