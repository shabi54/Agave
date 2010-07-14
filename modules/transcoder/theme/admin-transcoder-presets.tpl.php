<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<h2>Transcoding</h2>
<p>Following are the presets available for the <strong><?php print($_GET['name']); ?></strong> plugin:</p>
<pre><?php
global $agave;
foreach($presets as $num=>$pre){
    print("Preset Name: ".$pre['name']."<br/>Accepted Extensions: ".$pre['acceptedExtensions']."<br/>Target Extension: ".$pre['targetExtension']."<br/>Settings: ");
    print_r(unserialize($pre['settings']));
    print('<a href="'.$agave->base_url.'admin/transcoder/preset/delete/'.$pre['presetKey'].'">Delete this preset.</a>');
    print("<br/><br/>");
}
print('<strong><a href="'.$agave->base_url.'admin/transcoder/preset/create">Create a new preset.</a></strong>');
?></pre>