<?php

  $string = $_GET["string"];

  $decodedString = utf8_decode(rawurldecode($string));


$myfile = fopen("configFiles/config.txt", "w") or die("Unable to open file. Maybe file permissions on server too strict for root directory.");
fwrite($myfile, $decodedString);
fclose($myfile);


echo $decodedString;
exit;
?>