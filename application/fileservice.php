<?php
//echo $uri_exp[2];

if(FILES::fileExists($uri_exp[2]))
{
	FILES::stream($uri_exp[2]);
}else
{
	echo "impossible existe pas";
}
?>