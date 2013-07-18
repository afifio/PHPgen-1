<?php include('auth.php'); ?>
<?php

include ("../config.php");
// load functions

include ("inc/func_html.php");
include ("inc/func_pages.php");
// start script
include ("../inc/func_init.php");

$date = $_REQUEST['d'];					// Datum in Variable einsetzen
$folder = $_REQUEST['folder'];				// URL in Variable einsetzen
$filename_raw = $_REQUEST['nr'];			// Dateiname in Variable einsetzen
$filename = $date . "_" . $filename_raw . ".zip"; 	// Dateiname inkl. Datum und Endung erstellen (nicht uebergeben!)
$fileurl = ($folder.$filename);				// Dateiurl zusammen gefuehrt
$page_folder = $_REQUEST['pf'];				// Seitenordner der gebackupt werden soll 
$return="backup.php?s=".$filename_raw;			// So behalten Wir den evtl. geanderten Namen weiter

// head
home_html_start();
home_html_head();

// Sidebar
home_html_sidebar_start();
home_html_menu($s);
require ("inc/admin_menu.php");
home_html_sidebar_stop();

// body & wrap
echo "\n",'  <div id="content">',"\n";

?>
<div id="login_wrap">
  <h3>Erstellen Best&auml;tigen</h3><br />
  <p>Best&auml;tigen sie das erstellen der Backupdatei <br /><br /><b style="color:#007700;"><?php echo $filename ?></b></p> 
  <br /><br />
  <a href="<?php echo $return; ?>"><button>Zur&uuml;ck</button></a>
  <a href="bkp_create_zip.php?s=<?php echo $filename; ?>&amp;f=<?php echo $folder; ?>&amp;url=<?php echo $fileurl; ?>&amp;pf=<?php echo $page_folder; ?>"><button>Erstellen</button></a>
</div>

<div id="debug_out">
<p>Variable datum : <?php echo $date ?></p>
<p>Variable folder : <?php echo $folder ?></p>
<p>Variable fileurl : <?php echo $fileurl ?></p>
<p>Variable filename : <?php echo $filename ?></p>
<p>Variable filename_raw : <?php echo $filename_raw ?></p>
</div>

<?php
echo "\n",'  <div id="clear">&nbsp;</div>',"\n";
echo "\n",'  </div>',"\n\n";

// foot
home_html_foot();

// close body & wrap

home_html_stop();

?>


