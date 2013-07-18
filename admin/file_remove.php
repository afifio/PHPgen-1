<?php

include('auth.php');
include ("../config.php");
include ("inc/func_html.php");
include ("inc/func_pages.php");
include ("../inc/func_init.php");

$filename = $_REQUEST['s'];	// Dateiname
$folder = $_REQUEST['f'];	// Ordnername
$return = $_REQUEST['back'];	// Backlink

// head
home_html_start();
home_html_head();

// Sidebar
home_html_sidebar_start();
home_html_menu($s);
require ("inc/admin_menu.php");
home_html_sidebar_stop();

// body & wrap 

?>

<div id="content">

<div id="login_wrap">
  <h3>L&ouml;schen Best&auml;tigen</h3><br />
  <p>Sind Sie sicher, das <b style="color:#DD0000;"><?php echo $filename ?></b> gel&ouml;scht werden soll?</p> 
  <br /><br />
  <a href="<?php echo $return; ?>"><button>Zur&uuml;ck</button></a>
  <a href="file_delete.php?s=<?php echo $filename; ?>&amp;f=<?php echo $folder; ?>&amp;back=<?php echo $return; ?>"><button>L&ouml;schen</button></a>
</div>

<div id="debug_out">
<p>Variable filename : <?php echo $filename ?></p>
<p>Variable Ordnername : <?php echo $folder ?></p>
<p>Variable Backlink : <?php echo $return ?></p>

</div>

<?php
echo "\n",'  <div id="clear">&nbsp;</div>',"\n";
echo "\n",'  </div>',"\n\n";

// foot
home_html_foot();

// close body & wrap

home_html_stop();

?>


