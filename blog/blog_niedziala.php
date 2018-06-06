<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Blog</title>
  </head>
	<body>
		<?php include('menu_blogowe.php'); ?>
		<form action="nowy.php" method="post">
			<label>Nazwa blogu</label>
			<input type="text" name="blog_name"/><br/>
			<label>Nazwa użytkownika</label>
			<input type="text" name="name"/><br/>
			<label>Hasło</label>
			<input type="password" name="pass"/><br/>
			<label>Opis bloga</label>
			<textarea name="desc"></textarea>
			<input type="submit" value="Załóż blog"/><br/>
			<input type="reset" value="Wyczyść" name="reset" />
		</form>
					
<?php

if(isset($_GET['nazwa']) && $_GET['nazwa'] != ''){
				$blog_name = $_GET['nazwa'];
				$sem = sem_get(126534);
				if(sem_acquire($sem)){
					if(!is_dir($blog_name)){
						echo('Taki blog nie istnieje!');
						return;
					}
					else{
						chdir($blog_name);
						if(file_exists('info.txt')){
							$info_file = fopen('info.txt', 'r');
							$blog_author = fgets($info_file);
							fgets($info_file);
							$blog_desc = '';
							while($tmp = fgets($info_file)){
								$blog_desc .= $tmp.'<br/>';
							}
							echo('<strong>'.$blog_name.'</strong>');
							echo('<Dane o blogu:');
							echo('Autor blogu: '.$blog_author.);
							echo('Opis blogu:');
							echo('<p>'.$blog_desc.'</p>');
						}
						else{
							echo('źle zapisany blog!');
							return;
						}
						echo('Lista wpisów:');
						$file_list = scandir('./');
						echo('<table>');
						foreach ($file_list as $file){

							if(strlen($file) == 20 && is_file($file) && pathinfo($file)['extension'] == 'txt'){
								echo('<tr>');
								$tmp_name = substr($file,0,-4);
								$date = substr($file,0,-4);
								$date = str_split($date,2);
								$date[0] = $date[0].$date[1].'.'.$date[2].'.'.$date[3].' ';
								$date[1] = $date[4].':'.$date[5].' '.$date[6].'s';
								
								$date = $date[0].$date[1];
								echo('<th colspan="2">Data wpisu: '.$date.'</th></tr>');
								$wpis = fopen($file, 'r');
								$text = '';
								while($tmp = fgets($wpis)){
									$text .= $tmp.'<br/>';
								}
								echo('<tr><td>'.$text.'</td>');
								echo('<td><form action="koment_form.php" method="post"><input type="hidden" name="wpis" value="'.$tmp_name.'"/><input type="hidden" name="name" value="'.$blog_name.'"/><input type="submit" value="Dodaj komentarz"/></form></td>');
								echo('</tr><tr><td colspan="2">');
								$attachments = glob ('./'.$tmp_name.'?.*');
								foreach($attachments as $att){
									echo('<a href="'.$blog_name.$att.'">'.$blog_name.$att.'</a> ');
								}
								
								echo('</td></tr><tr><td colspan="2"><strong>Komentarze:</strong></td></tr>');
								if(file_exists($tmp_name.'.k') && is_dir($tmp_name.'.k')){
									$coment_list = scandir('./'.$tmp_name.'.k');
									$found = false;
									foreach($coment_list as $coment){
										$tmp_nr = substr($coment,0,-4);
										$is_nr = is_numeric($tmp_nr);										
										$coment = $tmp_name.'.k/'.$coment;
										if($is_nr == true && is_file($coment) && pathinfo($coment)['extension'] == 'txt'){
											$found = true;
											$coment_file = fopen($coment, 'r');
											$content = '';
											$nr = 1;
											while($tmp = fgets($coment_file)){
												$content .= $tmp;
												if($nr >= 3){
													$content .= '<br/>';
												}
												$nr++;
											}
											echo('<tr><td colspan="2">'.$content.'</td></tr>');
										}
									}
									if(!$found){
										echo('<tr><td colspan="2">nie ma</td></tr>');
									}
								}
								else{
									echo('<tr><td colspan="2">Nie ma</td></tr>');
								}
								
							}
						}
						echo('</table>');
					}
					sem_release($sem);
				}
				else{   
					echo('Błąd semafora');
					sem_remove($sem); 
				}
			}
			else{lista wszystkich blogów
				$dir_list = scandir('./');
				echo('<h1>Lista dostępnych blogów:</h1>');
				foreach($dir_list as $dir){
					if(is_dir($dir) && $dir != '.' && $dir != '..'){
						$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?nazwa=$dir";
						echo('<h2><a href="'.$link.'">'.$dir.'</a></h2>');
					}
				}
			} ?>
<br/>
<br/>
		
	</body>

</html>

