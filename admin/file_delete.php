<?php

include('auth.php');
include ("../config.php");
include ("inc/func_html.php");
include ("inc/func_pages.php");
include ("../inc/func_init.php");

$filename = $_REQUEST['s'];	// Dateiname
$folder = $_REQUEST['f'];	// Ordnername
$return = $_REQUEST['back'];	// Backlink
$pageurl = ($folder.$filename); // Komplette URL

if (empty($filename)) {
  echo '<meta http-equiv="refresh" content="3; url=backup.php" />';
  echo 'Datei-URL ist leer, versuchen Sie es bitte noch ein mal...';
  exit;
}

if (unlink("$pageurl") === TRUE) {
echo '<meta http-equiv="refresh" content="0; url='.$return.'" />';
//echo "$filename wurde erfolgreich entfernt";
} else {
echo '<meta http-equiv="refresh" content="3; url='.$return.'" />';
echo "$filename konnte nicht entfernt werden. ";
};



?>
