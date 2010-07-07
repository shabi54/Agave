<?php
/*
 * Created on June 1, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

?>

<div id='assessmentCompare'>
 
<?php 
$this->addCSS($agave->site_dir."modules/AO/theme/css/ao.css"); ?>

<table> 
<?php 
	   if ($topVersionElement): ?>
	    <tr>
		   <td><b>Object Version:</b></td>
		   <td><b>
<?php 
		     if (!$topVersionElement -> version) print "Not Provided!"; else print $topVersionElement -> version.": ".$topVersionElement ->ownerName; ?>
	       </b></td>
		</tr>
		<tr>
		   <td>Object Name:</td>
		   <td>
<?php 
		   if (!$topVersionElement -> objectName) print "Not Provided!"; else print $topVersionElement -> objectName;?>
	       </td>
		</tr>
		<tr>
		   <td>Object Type:</td>
		   <td>
<?php 
		   if (!$topVersionElement -> objectType) print "Not Provided!"; else print $topVersionElement -> objectType;?>
	       </td>
		</tr>
<?php
		if (isset($topVersionElement->mapData['instruction'])):
			for($i=0;$i<count($topVersionElement->mapData['instruction']);$i++):
			    $class = (strcmp(rtrim(ltrim($topVersionElement ->mapData['instruction'][$i]['instruction'])),rtrim(ltrim($buttomVersionElement ->mapData['instruction'][$i]['instruction']))) == 0) 
			    ? "" : "class=tdRed"; ?>
			    <tr>
				   <td>Instruction #<?php print (int)($i+1);?>:</td>
				   <td <?php print $class ?> >
				   		<?php print $topVersionElement->mapData['instruction'][$i]['instruction'];?>
				   </td>
				</tr>
<?php
	        endfor;//for($i=0;$i<count($topVersionElement->mapData['instruction']);$i++):
	    endif;//if $topVersionElement->mapData['instruction'])
	    if (isset($topVersionElement->mapData['stem'])):
			 for($i=0;$i<count($topVersionElement->mapData['stem']);$i++):
			 $optionCounter = 1;?>
			    <tr>
				   <td>Stem # <?php print (int)($i+1);?> :</td>
				   <?php $class = (strcmp(rtrim(ltrim($topVersionElement -> mapData['stem'][$i]['stem'])),ltrim(rtrim($buttomVersionElement -> mapData['stem'][$i]['stem']))) == 0) 
				         ? "" : "class=tdRed"; ?>
				   <td <?php print $class ?> >
					   <?php print $topVersionElement->mapData['stem'][$i]['stem']?>
				   </td>
				</tr>
<?php 
			         for($j=0;$j<count($topVersionElement->mapData['option']);$j++):
				          if ($topVersionElement->mapData['option'][$j]['parentIndex'] == $topVersionElement->mapData['stem'][$i]['index']):
					          $optionLabel = ($topVersionElement->mapData['option'][$j]['isCorrect'] == 1) ? "Key" : "Distractor #" . $optionCounter++?>
							    <tr>
								   <td align=right><?php print $optionLabel?>:</td>
								   <?php $class = (strcmp(ltrim(rtrim($topVersionElement -> mapData['option'][$j]['option'])),ltrim(rtrim($buttomVersionElement -> mapData['option'][$j]['option']))) == 0) 
								   ? "" : "class=tdRed"; ?>
								   <td <?php print $class ?> >
								   	   <?php print $topVersionElement->mapData['option'][$j]['option']?>
								   </td>
								</tr>
<?php 	  
				          endif;//if ($topVersionElement->mapData['option'][$j]['parentIndex'] == $topVersionElement->mapData['stem'][$i]['index']):
				      endfor;//for($j=0;$j<count($topVersionElement->mapData['option']);$j++): 
			 endfor; //for($i=0;$i<count($topVersionElement->mapData['stem']);$i++):
		 endif;//if ($topVersionElement->mapData['stem']):
	  else: ?>
	  	<tr>
		   <td><?php print "There is no item for this objects.";?></td>
		</tr>
<?php endif;?>
</table>
<br>
<table class=tbBorder>
	<tr><td>
		<?php if($topVersionPrevLink): ?>
			  	<a class='fm-button' href='<?php print $agave->base_url."itemBank/$topVersionElement->objectKey/compare/".$topVersionPrev."/" .($buttomVersionElement -> version)?>'>Previous</a>
		<?php endif; ?>
		<?php if($topVersionNextLink): ?>
			  	<a class='fm-button' href='<?php print $agave->base_url."itemBank/$topVersionElement->objectKey/compare/".$topVersionNext."/" .($buttomVersionElement -> version)?>'>Next</a>
		<?php endif;?>
		<?php if($editButton): ?>
		  	  	<a class='fm-button' href=' <?php echo $agave->base_url."itemBank/$topVersionElement->objectKey/version/$topVersionElement->version/edit" ?>'>Edit</a>
		<?php endif; 
		if (isset($topVersionElement->mapData['comment'])): ?>
			<a class='fm-button' href=' <?php echo $agave->base_url."itemBank/$topVersionElement->objectKey/comment/$topVersionElement->version" ?>'>Comment</a>
		<?php endif;?>
	</td></tr>
</table>
<br>
<table> 
	<?php if ($buttomVersionElement): ?>
	    <tr>
		   <td><b>Object Version:</b></td>
		   <td><b>
		   <?php if (!$buttomVersionElement -> version) print "Not Provided!"; else print $buttomVersionElement -> version.": ".$buttomVersionElement ->ownerName;;?>
	       </b></td>
		</tr>
		<tr>
		   <td>Object Name:</td>
		   <td>
		   <?php if (!$buttomVersionElement -> objectName) print "Not Provided!"; else print $buttomVersionElement -> objectName;?>
	       </td>
		</tr>
		<tr>
		   <td>Object Type:</td>
		   <td>
		   <?php if (!$buttomVersionElement -> objectType) print "Not Provided!"; else print $buttomVersionElement -> objectType;?>
	       </td>
		</tr>
		<tr>
		   <td>Comments:</td>
		   <td>
		   <?php if (!$buttomVersionElement -> comments) print "Not Provided!"; else print $buttomVersionElement -> comments;?>
	       </td>
		</tr>
		
<?php //$agave->death($buttomVersionElement->mapData);
		if (isset($buttomVersionElement->mapData['instruction'])):
			for($i=0;$i<count($buttomVersionElement->mapData['instruction']);$i++):?>
			    <tr>
				   <td>Instruction #<?php print (int)($i+1);?>:</td>
				   <td>
				   <?php print $buttomVersionElement->mapData['instruction'][$i]['instruction']?>
				   </td>
				</tr>
<?php
	        endfor;//for($i=0;$i<count($buttomVersionElement->mapData['instruction']);$i++):
	    endif;//if $buttomVersionElement->mapData['instruction'])
	    if (isset($buttomVersionElement->mapData['stem'])):
			 for($i=0;$i<count($buttomVersionElement->mapData['stem']);$i++):
			 $optionCounter = 1;?>
			    <tr>
				   <td>Stem #<?php print (int)($i+1);?>:</td>
				   <td>
				   <?php print $buttomVersionElement->mapData['stem'][$i]['stem']?>
				   </td>
				</tr>
			    <?php for($j=0;$j<count($buttomVersionElement->mapData['option']);$j++):
				          if ($buttomVersionElement->mapData['option'][$j]['parentIndex'] == $buttomVersionElement->mapData['stem'][$i]['index']):
					          $optionLabel = ($buttomVersionElement->mapData['option'][$j]['isCorrect'] == 1) ? "Key" : "Distractor #" . $optionCounter++?>
							    <tr>
								   <td align=right><?php print $optionLabel?>:</td>
								   <td>
								   <?php print $buttomVersionElement->mapData['option'][$j]['option'];?>
								   </td>
								</tr>
				<?php 	  endif;//if ($buttomVersionElement->mapData['option'][$j]['parentIndex'] == $buttomVersionElement->mapData['stem'][$i]['index']):
				      endfor;//for($j=0;$j<count($buttomVersionElement->mapData['option']);$j++): 
			 endfor; //for($i=0;$i<count($buttomVersionElement->mapData['stem']);$i++):
		 endif;//if ($buttomVersionElement->mapData['stem']):
	  else: ?>
	  	<tr>
		   <td><?php print "There is no item for this objects.";?></td>
		</tr>
	<?php endif;?>
</table>
<br>
<table class=tbBorder>
	<tr><td>
	    <?php if($buttomVersionPrevLink): ?>
		<a class='fm-button' href='<?php print $agave->base_url."itemBank/$topVersionElement->objectKey/compare/".($topVersionElement -> version)."/" .$buttomVersionPrev?>'>Previous</a>
		<?php endif; ?>
		<?php if($buttomVersionNextLink): ?>
			<a class='fm-button' href='<?php print $agave->base_url."itemBank/$topVersionElement->objectKey/compare/". ($topVersionElement -> version)."/" .$buttomVersionNext?>'>Next</a>
		<?php endif;
		if (isset($buttomVersionElement->mapData['comment'])): ?>
			<a class='fm-button' href=' <?php echo $agave->base_url."itemBank/$buttomVersionElement->objectKey/comment/$buttomVersionElement->version" ?>'>Comment</a>
		<?php endif;?>
	</td></tr>
</table>
 </div>