<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Lab PHP</title>
</head>
<body>
	<?php	
		include('menu_blogowe.php');
		include_once('styl.php');
		$blog_name = $_POST['blog_name'];
		$name = $_POST['name'];
		$pass = $_POST['pass'];
		$desc = $_POST['desc'];

		$sem = sem_get(13375);
	if(sem_acquire($sem)){
		if(is_dir($blog_name)){
			echo('Blog o takiej nazwie już istnieje!');
		}
		else{
	
			mkdir($blog_name, 0777);
			$info_file = fopen($blog_name."/info.txt", "w");
			fwrite($info_file,$name."\n");
			fwrite($info_file,md5($pass)."\n");
			fwrite($info_file,$desc."\n");
			echo('Blog utworzony!');
		}

	sem_release($sem);
	}
	else{
		echo('Błąd semafora');
		sem_remove($sem);
	}
	?>
</body>
</html>
