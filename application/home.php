<header>
<div style="position:absolute;top:0;right:0;padding:5px 10px;">
<?php
if($user->id == 0){
	echo '<a href="/login">Login</a>';
}else{
	echo '<a href="/profile" style="text-decoration:none !important;color:#000 !important">' . $user->profile['name'] . '</a>';
	echo '    ';
	?>
	<form name="formname" method="POST" style="display:inline-block">
		<input type="submit" name="logout" value="Logout">
	</form>
	<?php
}
?>
</div>
</header>
<!--h1>Nous transf�rons</h1-->
<!--a href="/?filter=got"><img class="got" src="/assets/img/got.png"/></a-->
<a href="/joke"><img class="" src="/assets/img/fish.jpg"/></a>
<style>
img.got{
  max-width: 100%;
  width: 700px;
  margin: 50px 0 15px;
}
</style>
<br>
<br>
<?php


function dirToArray($dir, $prefix = '') { 
   
   $result = array(); 

   $cdir = scandir($dir); 
   foreach ($cdir as $key => $value) 
   { 
      if (!in_array($value,array(".",".."))) 
      { 
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) 
         { 
            // $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value, $prefix . $value . DIRECTORY_SEPARATOR );
			$result = array_merge($result, dirToArray($dir . DIRECTORY_SEPARATOR . $value, $prefix . $value . DIRECTORY_SEPARATOR ));
         } 
         else 
         { 
            $result[] = $prefix . $value; 
         } 
      } 
   } 
   
   return $result; 
}

if($user->id == 0){
	echo 'Rien, pour le moment';
}else{
	//on prend tous les fichiers dans authorization  +  le dossier perso
	$res = DB::query("SELECT * FROM authorization WHERE id_user = '" . $user->id . "' ORDER BY priority DESC, id DESC");
	$authorizations = $res->fetchAll();
	
	$files = array();
	$i = 0;
	while(isset($authorizations[$i]))
	{
		$item = $authorizations[$i];
		$path = $item['path'];
		if($item['type'] == 'D')
		{
			$files = array_merge($files, dirToArray($path, $path . '/'));
		}else
		{
			if(file_exists($path))
				$files[] = $path;
		}
		$i++;
	}
	
	/*foreach($CONF['folders'] as $folder)
	{
		$files = array_merge($files, dirToArray($folder, $folder . '/'));
	}*/
	
	$files = array_merge($files, dirToArray('files/' . $user->profile['name'], 'files/' . $user->profile['name'] . '/'));
	
	if($user->profile['name'] == 'antoine' && isset($_GET['full']))
	{
		$files = array_merge($files, dirToArray('/home/admin/movies', '/home/admin/movies/'));
		// echo json_encode(dirToArray('/home/admin/movies', '/home/admin/movies/'));
	}
	
	if(sizeof($files) > 0)
	{
		?>
		<table>
			<thead>
				<tr>
					<th>File</th>
					<th>Size</th>
					<th>Download</th>
					<th>Streaming</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
		<?php
			foreach($files as $file)
			{
				if(isFileToShow($file))
				{
					try{
						$name = nameToDisplay($file);
						$size = filesize($file);
						$size = ceil($size/10000000)/100 . ' Go';
						echo '<tr data-date="' . filemtime($file) . '">';
						echo '<td>' . $name . '</td>';
						echo '<td>' . $size . '</td>';
						echo '<td><a href="/share?file=' . hash('sha256', $file) . '"><i class="i_download"></i></a></td>';
						//echo '<td><a href="/file?path=' . urlencode($file) . '"><i class="i_download"></i></a></td>';
						$finfo = finfo_open(FILEINFO_MIME_TYPE);
						$mime_type = finfo_file($finfo, $file);
						if(preg_match('/(audio|video)/', $mime_type))
							echo '<td><a href="/stream?path=' . urlencode($file) . '" target="_blank"><i class="i_stream"></i></a></td>';
						else
							echo '<td></td>';
						echo '<td>' . date('d-m-Y', filemtime($file)) . '</td>';
						echo '</tr>';
					}catch(Exception $e){
						echo '<tr>unable to read </tr>';
						var_dump($file);
					}
				}
			}
			?>
			</tbody>
		</table>
		
		<script>
			$(document).on('ready', function(){
				'use strict';
				
				$('tr').each(sort);
				
				insertDelimiters();
				
				function sort(i, tr){
					var el = $(tr);
					var dateEl = parseInt(el.attr('data-date'));
					if(dateEl)
					{
						$('tr').each(function(){
							var dateCompare = parseInt($(this).attr('data-date'));
							if(dateCompare)
							{
								
								if(dateEl > dateCompare)
								{
									$(this).before(el);
									return false;
								}
							}
						});
					}
				};
				
				function insertDelimiters(){
					var thisWeekDone = false;
					var lastWeekTime = ((new Date()).getTime())/1000 - 3600*24*7;
					$('tr[data-date]').each(function(i, el){
						el = $(el);
						console.log(parseInt(el.attr('data-date')), lastWeekTime);
						if(!thisWeekDone && parseInt(el.attr('data-date')) > lastWeekTime)
						{
							el.before('<tr class="delimiter"><td>Cette semaine</td></tr>');
							thisWeekDone = true;
						}
						if(thisWeekDone && parseInt(el.attr('data-date')) <= lastWeekTime)
						{
							el.before('<tr class="delimiter"><td>Plus ancien</td></tr>');
							return false;
						}
					});
				}
			});
		</script>
		<style>
			th{
				font-size: 18px
			}
			.delimiter td{
				text-align: left;
				font-size: 16px;
				font-weight: bold;
				padding: 30px 0 12px;
			}
		</style>
		<?php
	}
}

function isFileToShow($file)
{
	if($file == '.' && $file == '..')
		return false;
	if(isset($_GET['filter']) && $_GET['filter'] == "all")
	{
		return true;
	}
	if(preg_match("/\.(jpg|png|txt|nfo|html)$/", $file))
		return false;
	else if(isset($_GET['filter']) && $_GET['filter'] == "got")
	{
		if(!preg_match("/thrones/i", $file))
			return false;
	}else if(isset($_GET['filter']) && preg_match("/^(\w|_|-)+$/", $_GET['filter']) && !preg_match("/" . $_GET['filter'] . "/i", $file))
		return false;
	return true;
}

function nameToDisplay($file)
{
	$providerBrands = array("yify", "\[.*cpasbien.*\]", "killers", "asap");
	$specifications = array(" ?x264");
	
	$exp = explode('/', $file);
	$name = $exp[sizeof($exp) - 1];
	if(!preg_match("/srt$/", $file))
		$name = preg_replace('/^(.*)\....?.?$/', '$1', $name);
	else
		$name = preg_replace('/\.srt$/', ' [subtitle]', $name);
	
	$name = preg_replace("/(" . implode("|", $providerBrands) . ")/i", "", $name);
	$name = preg_replace("/(" . implode("|", $specifications) . ")/i", "", $name);
	
	$name = preg_replace('/(_|\.|-)/', ' ', $name);
	return $name;
}
?> 