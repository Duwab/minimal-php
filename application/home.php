<?php

$directories = scandir("assets/mp3");
$playlists = array();
foreach ($directories as $dname) 
{
	if (!in_array($dname,array(".",".."))) 
	{
		echo $dname;
		$playlist_dir = scandir("assets/mp3/" . $dname); 
		$arr = array();
		foreach ($playlist_dir as $key => $value) 
		{
			if (!in_array($value,array(".",".."))) 
			{
				$arr[] = array(
					"mp3" => preg_replace("/'/", "%27", "/assets/mp3/" . $dname . "/" . $value),
					"title" => preg_replace("/\.mp3/", "", $value)
				);
			}
		}
		$playlists[$dname] = $arr;
	}
}

?>



<script type="text/javascript">
 $(document).ready(function(){
  /* $("#jquery_jplayer_1").jPlayer({
   ready: function () {
    $(this).jPlayer("setMedia", {
     mp3: "/assets/mp3/sound1.mp3",
    });
   },
   swfPath: "/assets/jplayer/dist/jplayer",
   supplied: "mp3"
  }); */
  var myPlaylist = new jPlayerPlaylist({
	  jPlayer: "#jquery_jplayer_N",
	  cssSelectorAncestor: "#jp_container_N"
	}, [], {
	  playlistOptions: {
		enableRemoveControls: true
	  },
	  loopOnPrevious: false, //  If loop is active, the playlist will loop back to the end when executing previous()
	  shuffleOnLoop: true, //  If loop and shuffle are active, the playlist will shuffle when executing next() on the last item
	  enableRemoveControls: false, // Adds an x that allows user to remove songs from playlist
	  displayTime: 0, // how fast the playlist transitions on page load
	  addTime: 'fast', // transition time when adding a song
	  removeTime: 'fast', // transition time when removing a song
	  shuffleTime: 'slow', // transition time when shuffling playlist
	  swfPath: "/js",
	  supplied: "ogv, m4v, oga, mp3",
	  audioFullScreen: false, // Allows the audio poster to go full screen via keyboard,
	  size: {
			 width: "0",
			 height: "0"
		}
	});
	
	var playlists = JSON.parse('<?php echo preg_replace("/'/", "",json_encode($playlists));?>');
	for(var pname in playlists)
	{
		var btn = $('<div class="playlist_folder">').append('<img src="/assets/img/logo.png">').append('<span>' + pname + '</span>').data('pname', pname).on('click', function(){
			console.log($(this).data('pname'));
			myPlaylist.setPlaylist(playlists[$(this).data('pname')]);
		});
		$('.container').append(btn);
	}
	/* myPlaylist.add({
	  title:"Your Face",
	  artist:"The Stark Palace",
	  mp3:"http://www.jplayer.org/audio/mp3/TSP-05-Your_face.mp3",
	  oga:"http://www.jplayer.org/audio/ogg/TSP-05-Your_face.ogg",
	  // poster: "http://www.jplayer.org/audio/poster/The_Stark_Palace_640x360.png"
	}); */
 });
</script>
<div id="jquery_jplayer_N" class="jp-jplayer"></div>
<div id="jp_container_N" class="jp-audio">
<div class="jp-type-single">
    <div class="jp-gui jp-interface">
      <div class="jp-controls-holder">
        <div class="jp-controls">
			<button class="jp-previous" role="button" tabindex="0">previous</button>
          <button class="jp-play" role="button" tabindex="0">play</button>
          <button class="jp-pause" role="button" tabindex="0">play</button>
          <button class="jp-stop" role="button" tabindex="0">stop</button>
			<button class="jp-next" role="button" tabindex="0">next</button>
        </div>
        <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
        <div class="jp-progress">
          <div class="jp-seek-bar">
            <div class="jp-play-bar"></div>
          </div>
        </div>
        <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
        <div class="jp-toggles">
          <button class="jp-repeat" role="button" tabindex="0">repeat</button>
		  <button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
        </div>
		  <div class="jp-volume-controls">
			<button class="jp-mute" role="button" tabindex="0">mute</button>
			<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
			<div class="jp-volume-bar">
			  <div class="jp-volume-bar-value"></div>
			</div>
		  </div>
      </div>
    </div>
    </div>
  <div class="jp-playlist">
    <ul>
      <li></li> <!-- Empty <li> so your HTML conforms with the W3C spec -->
    </ul>
  </div>
</div>

<div class="container">
</div>