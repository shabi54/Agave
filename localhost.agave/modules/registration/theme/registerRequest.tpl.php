<?php
/*
 * Created on June 25, 2010
 * Author: Shabnam Tafreshi
 * view Registration Template
 * 
 */
?>

<div id='assessmentView'>
	<table>
<?php
    $t = $agave->load('themer');
    $fm = $agave ->load('fieldManager');
    if(!$role && !$examKey && !$centerKey):
    
?>
	    <tr><td><h3>Registration Request</h3></td></tr>
		<tr>
			<td><?php print $user-> firstName ?> welcome to American Councils Request page. 
			    Please choose one of the following Roles to start your request.
<?php   
                $elements = createRoles();
				$formAction = $agave->base_url."register/request"; 
				$form = $fm->startForm($formAction, "post");
				$form .= $fm->generateElements($elements);
				$form .= $fm->endForm("Save");
				print $t -> output = $form;
?>
			</td>
		</tr>
<?php 
    elseif($role):
?> 
      <tr>
      	<td>Each center has been given the opposrtunity to adminster any available exams in our system. Please choose among the following center(s) and exam(s) the combinations of your desire.<br><br>
<?php
			$CenterKeys = getCenterKeys($user->userKey,$role);
			$examKeys = getUpcomingExams();
			//$agave->death($examKeys);
			$elements = buildCenterAndExams($CenterKeys,$examKeys);
			$formAction = $agave->base_url."register/request"; 
			$form = $fm->startForm($formAction, "post");
			$form .= $fm->generateElements($elements);
			$form .= $fm->endForm("Save");
			print $t -> output = $form;
?>
      	</td>
      </tr>
<?php 
    elseif($examKey && $centerKey):
?>
      <tr>
        <td><h3>Thank you!</h3>
            Your request has been successfully sumbmitted to our system.<br>
            You may schedule your exam payment to American Councils. You can
            send your checks to Dr. Camelot Marshall. Please send your email to
            Dr. Marshall <a mailto:marshall@americancouncils.org>marshall@americancouncils.org</a>
            If you have any question or concern . <br>
            Once we have received your payment, the link and instruction 
            to our registeration system will be sent to you via an email, and you can register 
            your examinees and admin personnel.
        </td>
      </tr>
<?php
    endif;
?>
	</table>
</div>