<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Lab PHP</title>
</head>
<body>
	<?php

	$word = $_GET['word'];
	$plik = fopen('plik.txt', 'r');
	while (!feof($plik)) {
  	$s = fgets($plik);
	if(strlen($s) - 1 == strlen($word)){
	$result = true;
	
	  	for($i = 0; $i < strlen($word); $i++){
				if($word[$i] != '_' && $word[$i] != $s[$i])
					$result = false;
			}
			if($result)
				echo $s."<br/>";
	}
	}
	fclose($plik);
	?>
</body>
</html>
