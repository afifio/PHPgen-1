<?php 

include('auth.php');
include ("../config.php");
include ("inc/func_html.php");
include ("inc/func_pages.php");
include ("../inc/func_init.php");

$filename = $_REQUEST['s'];	// Dateiname
$folder = $_REQUEST['f'];	// Ordnername
$page_folder_real = $_REQUEST['pf'];	// Seiten Ordner (das soll geupdatet werden)
$page_folder = "../";
$fileurl = $_REQUEST['url'];	// URL komplett

if (empty($fileurl)) {
  echo '<meta http-equiv="refresh" content="2; url=backup.php" />';
  echo '<b style="color:#DD0000;">Datei-URL</b> ist leer...';
  exit;
}

// increase script timeout value
ini_set("max_execution_time", 300);

$it = new RecursiveDirectoryIterator("$page_folder_real");

if ($it !== TRUE ) {
//    echo "<b style='color:#007700;'>$page_folder_real</b> wurde erfolgreich entleert<br /><br />";
} else {
    echo "<b style='color:#770000;'>$page_folder_real</b> konnte nicht entleert werden<br /><br />";
};

$files = new RecursiveIteratorIterator($it,RecursiveIteratorIterator::CHILD_FIRST);
foreach($files as $file){
    if ($file->isDir()){
        rmdir($file->getRealPath());
    } else {
        unlink($file->getRealPath());
    }
}

$zip = new ZipArchive();

if ($zip->open("$fileurl") === TRUE) {
    $zip->extractTo("$page_folder");
    // close and save archive
    $zip->close();
    echo '<meta http-equiv="refresh" content="0; url=backup.php" />';
 //   echo "<b style='color:#007700;'>$filename</b> wurde erfolgreich erstellt<br />";
} else {
    echo '<meta http-equiv="refresh" content="3; url=backup.php" />';
    echo "<b style='color:#770000;'>$filename</b> konnte nicht Wiederhergestellt werden.<br />";
}

?>
