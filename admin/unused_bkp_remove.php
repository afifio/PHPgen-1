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
//$cs = md5($pageurl); // Kontrollsrting
$return="backup.php";

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
  <h3>L&ouml;schen Best&auml;tigen</h3><br />
  <p>Sind Sie sicher, das <b style="color:#DD0000;"><?php echo $filename ?></b> gel&ouml;scht werden soll?</p> 
  <br /><br />
  <a href="<?php echo $return; ?>"><button>Zur&uuml;ck</button></a>
  <a href="bkp_delete.php?s=<?php echo $filename; ?>&amp;f=<?php echo $folder; ?>"><button>L&ouml;schen</button></a>
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


