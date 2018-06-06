<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Wpis</title>
	</head>
	<body>
		<?php
			include('menu_blogowe.php');
			include_once('styl.php');
				$name = $_POST['name'];
				$pass = $_POST['pass'];
				$pass = md5($pass);
			
			$cat_list = scandir("./");
			foreach ($cat_list as $cat){
				if(is_dir($cat) && $cat != '.' && $cat != '..'){
					
					$sem = sem_get(1337);
					if(sem_acquire($sem)){
						if(file_exists($cat.'/info.txt')){
							$info_file = fopen($cat.'/info.txt', 'r');
							$file_author = fgets($info_file);
							$file_pass = fgets($info_file);

							if($name."\n" == $file_author && $pass."\n" == $file_pass){
								$date = $_POST['date'];
								$time = $_POST['time'];
								$desc = $_POST['desc'];
								$date = explode('-',$date);
								$date = implode('',$date);
								$time = explode(':',$time);
								$time = implode('',$time);
								$file_name = $date.$time.date('s');
								$number = 0;
								while(file_exists($name.str_pad($number,2,'0',STR_PAD_LEFT))){
									$number = $number++;
								}
								$file_name = $file_name.str_pad($number,2,'0',STR_PAD_LEFT);
								$post_file = fopen($cat.'/'.$file_name.'.txt', 'w');
								fwrite($post_file,$desc);
								
								$attlist = $_FILES;
								$att_number = 1;
								foreach ($attlist as $att){
									if($att['error'] == 0){
										$temp = explode('.',$att['name']);
										if(count($temp) != 1){
											$ending = '.'.end($temp);
										}
										else{
											$ending = '';
										}
										if (!move_uploaded_file($att['tmp_name'],$cat.'/'.$file_name.$att_number.$ending)){
											//echo('Inny plik został wysłany w tym czasie');
											}
										$att_number++;
									}
								}
							}
						}
						sem_release($sem);
					}
					else{
						echo('Błąd semafora!');
						sem_remove($sem);
					}
				}
			}
			echo('Wpis dodany');
				
		?>
	</body>
</html>
