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
<h1>Nous transférons</h1>
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
				</tr>
			</thead>
			<tbody>
		<?php
			foreach($files as $file)
			{
				if($file != '.' && $file != '..')
				{
					try{
						$exp = explode('/', $file);
						$name = preg_replace('/^(.*)\....?.?$/', '$1', $exp[sizeof($exp) - 1]);
						$name = preg_replace('/(_|\.)/', ' ', $name);
						$size = filesize($file);
						$size = ceil($size/10000000)/100 . ' Go';
						echo '<tr>';
						echo '<td>' . $name . '</td>';
						echo '<td>' . $size . '</td>';
						echo '<td><a href="/file?path=' . urlencode($file) . '"><i class="i_download"></i></a></td>';
						$finfo = finfo_open(FILEINFO_MIME_TYPE);
						$mime_type = finfo_file($finfo, $file);
						if(preg_match('/(audio|video)/', $mime_type))
							echo '<td><a href="/stream?path=' . urlencode($file) . '" target="_blank"><i class="i_stream"></i></a></td>';
						else
							echo '<td></td>';
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
		<?php
	}
}
?> 