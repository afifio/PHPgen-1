<?php

include('auth.php');
require ("../config.php");
include ("inc/func_html.php");
include ("inc/func_pages.php");
include ("../inc/func_init.php");

$folder = "../inc/upload/";						// Ordner aus dem Aufgelistet und gespeichert wird
//$filefolder = array_reverse(read_folder_directory($folder));		// Auslesen umgekehrte Ausgabe
$filefolder = read_folder_directory($folder);				// Auslesen
$date = date("d.m.Y_H:i"); 						// Datum 
$return = "file.php";
$ready_url = "upload.php";

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
        <time datetime=\"2011-10-31\" pubdate>31.Oktober 2011</time>
        <h1>Datei Verwaltung</h1>
      </header>

<p>Hier soll die Dateiverwaltung hin.</p>

<ul id="backup_list">
';

if ($filefolder)
{
    foreach ($filefolder as $file)
    {
      echo "
	<li>
	  <a href='file.php?s=$file&amp;f=$folder&amp;pf=$page_folder' title='$file Bearbeiten'>
	    <img src='../img/icons/file.png' witdh='16' height='16' alt='&#10007;' style='margin:0 5px -2px 0;'/>".$file."
	  </a>
	  <a style='float:right;' href='file_remove.php?s=$file&amp;f=$folder&amp;back=$return' title='$file L&ouml;schen'>
L&ouml;schen
	    <img src='../img/icons/delete.png' witdh='12' height='12' alt='&#10007;' />
	  </a>  </li>";
     }
} 

echo "\n",'  </ul>',"\n\n";
echo "\n","<hr>";

// Upload New File

echo "

<form action='$ready_url' method='post'>
<input type='hidden' name='d' value='$date'>
<input type='hidden' name='pf' value='$page_folder'>
<input type='hidden' name='folder' value='$folder'>
<input type='file' name='nr' id='nr' size='42'  value='$filename_raw' title='neuen Datei Namen eingeben'> 
<div style='float:right;margin:0 20px 0 10px;'><input type='submit' name='submit' value='Speichern'> </div>
</form>

";

echo "
<div id='debug_out'>
<p>Variable filefolder : $filefolder </p>
<p>Variable folder : $folder </p>
</div>
";

echo "\n",'</article>',"\n\n";
echo "\n",'  <div id="clear">&nbsp;</div>',"\n";
echo "\n",'  </div>',"\n\n";

// foot
home_html_foot();

// close body & wrap

home_html_stop();

?>
