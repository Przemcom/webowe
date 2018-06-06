<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Wpis</title>

		<script type="text/javascript">
			function getId(elem){
				return document.getElementById(elem);
			}

			function getTag(elem){
				return document.getElementsByTagName(elem);
			}

			function getName(elem){
				return document.getElementsByName(elem);
			}

			function full_file(){
				var files = getName("file[]");
				for(var i = 0; i < files.length; i++){
					if(files[i].value == ""){
						return;
					}
				}
				var file = document.createElement("input");
				file.setAttribute("type","file");
				file.setAttribute("name","file[]");
				file.addEventListener("change", full_file);
				getId("file_container").appendChild(file);
			}

			function start(){
				var mydate = new Date;
				var day = mydate.getDate();
				if(day < 10){
					day = "0" + day;
				}
				var tmp = mydate.getFullYear() + "-" + mydate.getMonth()+1 + "-" + day;
				getId("date").value = tmp;

				tmp = mydate.getHours() + ":" + mydate.getMinutes();
				getId("time").value = tmp;

				getId("date").addEventListener("change", function(){
					var tmp = this.value.split("-");
					if(isNaN(tmp[0]) || tmp[0].length != 4 || tmp[0] * 1 < 1900 || isNaN(tmp[1]) || tmp[1].length != 2 || tmp[1] * 1 < 1 || tmp[1] * 1 > 12 || isNaN(tmp[2]) || tmp[2].length != 2 || tmp[2] * 1 < 1 || tmp[2] * 1 > 31 || tmp[3] != undefined){
						var month = mydate.getMonth() + 1;
						if(month < 10){
							month = "0" + month;
						}
						var day = mydate.getDate();
						if(day < 10){
							day = "0" + day;
						}
						tmp = mydate.getFullYear() + "-" + month + "-" + day;
						this.value = tmp;
					}
				});

				getId("time").addEventListener("change", function(){
					var tmp = this.value.split(":");
					if(isNaN(tmp[0]) || tmp[0].length != 2 || tmp[0] * 1 < 0 || tmp[0] * 1 > 23 || isNaN(tmp[1]) || tmp[1].length != 2 || tmp[1] * 1 < 0 || tmp[1] * 1 > 59 || tmp[2] != undefined){
						var hour = mydate.getHours();
						if(hour < 10){
							hour = "0" + hour;
						}
						var minute = mydate.getMinutes();
						if(minute < 10){
							minute = "0" + minute;
						}
						tmp = hour + ":" + minute;
						this.value = tmp;
					}
				});

				getId("file").addEventListener("change", full_file);
			}
		</script>
  </head>
	<body onload="start();">

		<?php include('menu_blogowe.php'); 
			include_once('styl.php');?>
		<form action="wpis.php" method="post" enctype="multipart/form-data">
			<label>Nazwa użytkownika</label>
			<input type="text" name="name"/>
			<label>Hasło</label>
			<input type="password" name="pass"/><br/>
			<label>Wpis</label>
			<textarea name="desc"></textarea><br/>
			<label>data</label>
			<input id="date" type="text" name="date" value=""/>
			<label>Czas dodania</label>
			<input id="time" type="text" name="time" value=""/>

			<div id="file_container">
				<label>Pliki</label>
				<input id="file" type="file" name="file[]"/>
			</div>


<!--			<input type="file" name="firstfile" id="firstfile"/><br/>
			<input type="file" name="secondfile" id="secondfile"/><br/>
			<input type="file" name="thirdfile" id="thirdfile"/><br/>
-->
			<input type="submit" value="Publikuj wpis"/>
			<input type="reset" value="Wyczyść" name="reset" />

		</form>
	</body>
</html>
