<?php
  $myfile = fopen("uploads/config.txt", "a+") or die("Unable to open file!");
  $txt = "Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
  fwrite($myfile, $txt);
  $txt = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat.";
  fwrite($myfile, $txt);
  fclose($myfile);
?>