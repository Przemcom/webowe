<?php
	
$xml = simplexml_load_file("agh.kml");
$json = json_encode($xml);
echo($json);



?>
