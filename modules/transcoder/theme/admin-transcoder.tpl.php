<h2>Transcoding</h2>
<p><?php print('<a href="'.$agave->base_url.'admin/transcoder/transcode"><strong>Click here to test out the transcoder.</strong></a>'); ?></p>
<p>Following are the transcoding plugins available.  Click a plugin's name to view and create presets for it.</p>
<pre><?php
global $agave;
foreach($plugins as $num=>$name) {
    print('<a href="'.$agave->base_url.'admin/transcoder/presets&name='.$name.'"> - '.$name.'</a><br/><br/>');
}
?></pre>
