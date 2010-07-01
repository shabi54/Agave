<?php 
$siteContext = $_GET['siteContext'];
$playlist = $_GET['playlist'];
$siteName = $_GET['siteName'];

switch ($siteContext) {
	case 'livefromrussia' : $basePath = 'http://www.livefromrussia.org';		break;
	case 'textbooks' : $basePath = 'http://textbooks.americancouncils.org';		break;
	case 'flagship' : $basePath = 'http://flagship.americancouncils.org';		break;
}

$filepath = $basePath."/mediaInfo/".$playlist;
$imagePath = $basePath."/mediaInfo/".$siteName."image.jpg";
?>


      var flashvars =
      {
        file:                 '<?php echo $filepath ?>', //'http://www.livefromrussia.org/mediaInfo/xspfPlaylist.xml' <?php echo $filepath ?>
        displayclick:         'link',
        link:                 'http://www.google.com/',
        logo:                 '<?php echo $imagePath ?>',
        shuffle:              'false',
        repeat:               'true',
        playlist:             'right',
        playlistsize:         '300',
        skin:                 'player.swf',
        stretching:           'exactfit',
        autostart:            'false',
        fullscreen:           'true',
        volume:               '60',
        quality:              'true',
        controlbar:			  'over'
      };

      var params =
      {
        allowfullscreen:      'true',
        allowscriptaccess:    'always',
        bgcolor:              '#FFFFFF'
      };

      var attributes =
      {
        id:                   'player',
        name:                 'player'
      };
      
      swfobject.embedSWF('<?php echo $basePath ?>/mediaplayer/player.swf', 'player', '660', '400', '9.0.124', false, flashvars, params, attributes);