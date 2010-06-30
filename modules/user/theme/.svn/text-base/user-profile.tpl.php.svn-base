<?php
	$this->addCSS('user',"theme/css/user-profile.css");
?>
<?php if($editButton): ?>
	<a href='<?php print $agave->base_url.$editHREF ?>' id='editProfile'></a>
<?php endif; ?>
<div class='user-block' id='user-profile-wrapper'>
	<fieldset><legend>General</legend>
		<table>
			<tbody>
				<tr><td><strong>Name:</strong></td><td><?php print "$targetUser->firstName $targetUser->lastName" ?></td></tr>
				<tr><td><strong>Email:</strong></td><td><?php print $targetUser->email ?></td></tr>
				<tr><td><strong>Member since:</strong></td><td><?php print date(DATE_RFC822  , $targetUser->date_added) ?></td></tr>
			</tbody>
		</table>
	</fieldset>
</div>

<?php if(isset($targetUser->prefs->values)): ?>
<div class='user-block' id='user-prefs-wrapper'>
	<fieldset>
		<legend>Prefs</legend>
		<?php print $targetUser->prefs->displaySchema(); ?>
	</fieldset>
</div>
<?php endif; ?>