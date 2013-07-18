<?php include('auth.php'); ?>
<?php

include ("../config.php");
// load functions

include ("inc/func_html.php");
include ("inc/func_pages.php");
// start script
include ("../inc/func_init.php");

$filename = $_REQUEST['s'];	// Dateiname
$folder = $_REQUEST['f'];	// Ordnername
$pageurl = ($folder.$filename); // Komplette URL
$page_folder = $_REQUEST['pf'];	// Seitenordner der gebackupt werden soll
$return="backup.php";		// Backlink

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
//echo home_pages_load($s);
//echo admin_pages_load($s);

?>
<div id="login_wrap">
  <h3>Wiederherstellen Best&auml;tigen</h3><br />
  <p>Best&auml;tigen sie das Wiederherstellen der Backupdatei <br /><br /><b style="color:#E79900;"><?php echo $filename ?></b></p> 
  <br /><br />
  <a href="<?php echo $return; ?>"><button>Zur&uuml;ck</button></a>
  <a href="bkp_restore_zip.php?s=<?php echo $filename; ?>&amp;f=<?php echo $folder; ?>&amp;url=<?php echo $pageurl; ?>&amp;pf=<?php echo $page_folder; ?>"><button>Wiederherstellen</button></a>
</div>

<div id="debug_out">
<p>Variable filename : <?php echo $filename ?></p>
<p>Variable Ordnername : <?php echo $folder ?></p>
</div>

<?php
echo "\n",'  <div id="clear">&nbsp;</div>',"\n";
echo "\n",'  </div>',"\n\n";

// foot
home_html_foot();

// close body & wrap

home_html_stop();

?>


