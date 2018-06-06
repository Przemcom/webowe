<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Komentarz</title>
	</head>
	<body>
		<?php
			include('menu_blogowe.php');
			include_once('styl.php');
			$post = $_POST['post'];
			$name = $_POST['name'];
			$type = $_POST['type'];
			$comment = $_POST['comment'];
			$nick = $_POST['nick'];

			//$fpath = '/$name/$post';

			$sem = sem_get(420);
			if(sem_acquire($sem)){
				if(file_exists($name) && is_dir($name)){
					chdir($name);
					if(!file_exists($post.'.k') || !is_dir($post.'.k')){
						mkdir($post.'.k',0777);
					}
					chdir($post.'.k');
					$number = 0;
					while(file_exists($number.'.txt')){
						$number++;
					}
					$comment_file = fopen($number.'.txt', 'w');
					fwrite($comment_file,$type."\n");
					$date = date('Y-m-d').','.date('H:i:s');
					fwrite($comment_file,$date."\n");
					fwrite($comment_file,$nick."\n");
					fwrite($comment_file,$comment);
					echo('komentarz dodany');
				}
				else{
					echo('taki blog nie istnieje!');
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
