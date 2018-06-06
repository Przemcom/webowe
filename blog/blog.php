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
		<?php include('menu_blogowe.php');
		include_once('styl.php'); ?>
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
		

<br/>
<br/>
		
	</body>
</html>
