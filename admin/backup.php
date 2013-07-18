<?php

include('auth.php');
require ("../config.php");
include ("inc/func_html.php");
include ("inc/func_pages.php");
include ("../inc/func_init.php");

$filename_raw = $_REQUEST['s'];

if (empty($filename_raw)) {
  $filename_raw = "backup";
}

$date_raw = date("dmYHi");					// Datum roh
$date = date("d.m.Y_H:i"); 					// Datum 
$curr_date = $date . "_";					// Datum mit unterstrich zur besseren HTML ausgabe
$filename = $date . "_" . $filename_raw . ".zip"; 		// Dateiname inkl. Datum und Endung
$folder = "backup/";						// Ordner aus dem Aufgelistet und gespeichert wird
$page_folder = "../pages";					// Seitenordner der gebackupt werden soll 
$filefolder = read_folder_directory($folder);	// Auslesen
$fileurl = ($folder.$filename);					// Dateiurl komplett
$ready_url = 'bkp_create.php';					// URL an die uebgeben wird
$return='backup.php';						// URL fuer Abbruch


// head
home_html_start();
home_html_head();

// Sidebar
home_html_sidebar_start();
home_html_menu($s);
require ("inc/admin_menu.php");
home_html_sidebar_stop();

// body & wrap
echo "\n",'  <div id="content">
<article>

      <header>
        <time datetime=\"2011-04-16\" pubdate>16.April 2011</time>
        <h1>Backup Verwaltung</h1>
      </header>

<p>Angelegte Sicherungen:</p>

  <ul id="backup_list">

';

//
// Auflisten der Dateien im Ordner 
//

if ($filefolder)
{
    foreach ($filefolder as $file)
    {
      echo "
	<li>
	  <a href='bkp_restore.php?s=$file&amp;f=$folder&amp;pf=$page_folder' title='$file Wiederherstellen'>
	    <img src='../img/icons/tar.png' witdh='16' height='16' alt='&#10007;' style='margin:0 5px -2px 0;'/>".$file."
	  </a>
	  <a style='float:right;' href='file_remove.php?s=$file&amp;f=$folder&amp;back=$return'' title='$file L&ouml;schen'>
L&ouml;schen
	    <img src='../img/icons/delete.png' witdh='12' height='12' alt='&#10007;' />
	  </a>  </li>";
     }
} 


echo "\n",'  </ul>',"\n\n";
echo "\n","
<hr>
<form action='$ready_url' method='get'>
<input type='hidden' name='d' value='$date'>
<input type='hidden' name='pf' value='$page_folder'>
<input type='hidden' name='folder' value='$folder'>
&nbsp;&nbsp;$curr_date
<input type='text' name='nr' id='nr' value='$filename_raw' title='neuen Datei Namen eingeben'>.zip 
<div style='float:right;margin:0 20px 0 10px;'><input type='submit' name='submit' value='Neues Backup erstellen'> </div>
</form>

<div id='debug_out'>
<p>Variable datum : $date </p>
<p>Variable datum_raw : $date_raw </p>
<p>Variable fileurl : $fileurl </p>
<p>Variable filename : $filename </p>
<p>Variable filename_raw : $filename_raw </p>
</div>

</article>

";

echo "\n",'  <div id="clear">&nbsp;</div>',"\n";
echo "\n",'  </div>',"\n\n";

// foot
home_html_foot();

// close body & wrap

home_html_stop();

?>
