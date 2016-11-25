<?php

if(!isset($_GET['file']))
{
	echo 'error no file';
	die();
}

$fileHash = $_GET['file'];

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


$files = array();
foreach($CONF["folders"] as $filePath)
{
    $files = array_merge($files, dirToArray($filePath, $filePath."/"));
}

/*$files = array_merge(
	dirToArray('files', 'files/'),
	dirToArray('/home/deluge', '/home/deluge/')
	);*/

$i = 0;
while(isset($files[$i])){
	//echo $files[$i] . ' => ' . hash('sha256', $files[$i]) . '<br>';
	if(hash('sha256', $files[$i]) == $fileHash)
	{
                echo 'delete ';
		//Response::file($files[$i]);
		echo unlink($files[$i]) ? "success" : "failure";
		die();
	}
	$i++;
}
	

?>
