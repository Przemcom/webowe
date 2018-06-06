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

		<?php include('menu_blogowe.php');
			include_once('styl.php'); ?>
		<form action="koment.php" method="post">
			<label>Nazwa bloga</label>
			<input type="text"  name="name"/><br/>
			<label>Nazwa wpisu</label>
			<input type="text"  name="post"/><br/>

			<label>rodzaj</label>
			 <select name="type">
  				  <option value="pozytywny">pozytywny</option>
				  <option value="neutralny">neutralny</option>
				  <option value="negatywny">negatywny</option>
			</select><br/> 
			<label>Komentarz</label>
			<textarea name="comment"></textarea><br/>
			<label>Pseudonim</label>
			<input type="text" name="nick"/>
			<input type="submit" value="Publikuj komentarz"/>
			<input type="reset" value="Wyczyść" name="reset" />
		</form>
	</body>
</html>
