<?php
header('Content-Type: image/jpeg'); //or whatever
if(isset($_GET["path"])){//
//get file name from Database
readfile($_GET["path"]);
die();
}
?>
