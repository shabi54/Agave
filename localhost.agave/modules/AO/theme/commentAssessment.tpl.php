<?php
/*
 * Created on June 1, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

?>
<div id='assessmentComment'>
 
<?php 
	$this->addCSS($agave->site_dir."modules/AO/theme/css/ao.css");
	$t = $agave->load('themer');
	$user = $agave->load('user');
	$fm = $agave ->load('fieldManager');
?>
<table class=tdComment>
<?php
	if (isset($AO->mapData['comment'])):
		for($i=0;$i<count($AO->mapData['comment']);$i++):
		$newCommentIndex = $AO->mapData['comment'][$i]['index'];
?>
		    <tr>
			   <td ><b>
<?php 
        	    print $AO->mapData['comment'][$i]['authorName'].":";?>
			    </b><br>
<?php
	          	if ($childKey != $AO->mapData['comment'][$i]['childKey']): 
				   print $AO->mapData['comment'][$i]['comment'];?> <br><b>
<?php 
				   print $AO->mapData['comment'][$i]['date_created'];
				   		if ($AO -> authorKey == $AO->mapData['comment'][$i]['authorKey']): ?>
				   		</b>&nbsp; <a href=' <?php echo $agave->base_url."itemBank/$AO->objectKey/delete/$AO->version/".$AO->mapData['comment'][$i]['childKey'].
	                                   "/$AO->object_versionKey&table=comment"; ?>' class=aComment><b>delete</b></a>
	                    &nbsp; <a href=' <?php echo $agave->base_url."itemBank/$AO->objectKey/comment/$AO->version&childKey=".$AO->mapData['comment'][$i]['childKey'].
	                                   "" ?>' class=aComment><b>edit</b></a>
<?php
	                    endif;//if ($AO -> authorKey == $AO->mapData['comment'][$i]['authorKey']):
				else:
					$elements = giveMeElement($i,$AO);
					$formAction = $agave->base_url."itemBank/$AO->objectKey/version/$AO->version/save&table=comment&childKey=".$AO->mapData['comment'][$i]['childKey']; 
					$form = $fm->startForm($formAction, "post");
					$form .= $fm->generateElements($elements);
					$form .= $fm->endForm("Save");
					print $t -> output = $form;
?>
				&nbsp; <a href=' <?php echo $agave->base_url."itemBank/$AO->objectKey/comment/$AO->version " ?>' class=aComment><b>cancel</b></a>
<?php          endif;//if (!$childKey) 
?>		 

			   </td>
			</tr>
<?php       
        endfor;//for($i=0;$i<count($topVersionElement->mapData['comment']);$i++)
    endif;//if (isset($topVersionElement->mapData['comment']))
    if (!$childKey):
?>
    	<tr><td><b>
<?php 
	        print $AO -> ownerName .":"; 
			$elements = returnTextarea($newCommentIndex);
			$formAction = ($AO->objectKey) ? $agave->base_url."itemBank/$AO->objectKey/version/$AO->version/save" : $agave->base_url."itemBank/save" ; 
			$form = $fm->startForm($formAction, "post");
			$form .= $fm->generateElements($elements);
			$form .= $fm->endForm("Save");
?>
    	</b><br>
<?php
			print $t -> output = $form;
?>
    	</td></tr>
<?php 
  endif; //if (!$childKey) 
?>
</table>
</div>