<?php

include('auth.php');
include ("../config.php");
include ("inc/func_html.php");
include ("inc/func_pages.php");
include ("../inc/func_init.php");

$filename = $_REQUEST['s'];	// Dateiname
$folder = $_REQUEST['f'];	// Ordnername
$page_folder = $_REQUEST['pf'];	// Seiten Ordner (das soll geupdatet werden)
$fileurl = $_REQUEST['url'];	// URL komplett

if (empty($fileurl)) {
  echo '<meta http-equiv="refresh" content="2; url=backup.php" />';
  echo '<b style="color:#DD0000;">Datei-URL</b> ist leer...';
  exit;
}

// increase script timeout value
ini_set("max_execution_time", 300);

$zip = new ZipArchive();

if ($zip->open($fileurl, ZIPARCHIVE::CREATE)!==TRUE) {
    exit("cannot open <$fileurl>\n");
}

// initialize an iterator
// pass it the directory to be processed
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($page_folder));
// iterate over the directory
// add each file found to the archive
foreach ($iterator as $key=>$value) {
$zip->addFile(realpath($key), $key) or die ("ERROR: Could not add file: $key");
}

//echo " numfiles: " . $zip->numFiles . "<br />";
//echo " status:" . $zip->status . "<br /><br />";

// close and save archive
$zip->close();

echo '<meta http-equiv="refresh" content="0; url=backup.php" />';
//echo "<b style='color:#007700;'>$filename</b> wurde erfolgreich erstellt<br /> $fileurl";

?>
