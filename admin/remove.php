<?php include('auth.php'); ?>
<?php

include ("../config.php");
// load functions

include ("inc/func_html.php");
include ("inc/func_pages.php");
// start script
include ("../inc/func_init.php");

$return="index.php?s=$s";

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

$i = home_pages($s);
$pageid = $i;
$pageurl = "../pages/" . $i . "_" . $s  . "_page.php";

?>
<div id="login_wrap">
  <h3>L&ouml;schen Best&auml;tigen</h3><br />
  <p>Sind Sie sicher, das <b><?php echo $s ?></b> gel&ouml;scht werden soll?</p> 
  <br /><br />
  <a style="float:left" href="index.php?s=<?php echo $s; ?>"><button>zur&uuml;ck</button></a>
  <form action="delete.php<?php echo '?s='.$s; ?>" method="post">&nbsp;
   <input type="hidden" name="pageurl" value="<?php echo $pageurl ?>">
  <input type="hidden" name="pageid" value="<?php echo $pageid ?>">
   <input type="submit" name="remove0815" value="L&ouml;schen" />
  </form>
</div>

<div id="debug_out">
<p>Variable s : <?php echo $s ?></p>
<p>Variable i : <?php echo $i ?></p>
<p>Variable countold : <?php echo $countold ?></p>
<p>Variable countdiff : <?php echo $countdiff ?></p>
<p>Variable rename : <?php echo $rename ?></p>
<p>Variable pageid : <?php echo $pageurl ?></p>
</div>

<?php
echo "\n",'  <div id="clear">&nbsp;</div>',"\n";
echo "\n",'  </div>',"\n\n";

// foot
home_html_foot();

// close body & wrap

home_html_stop();

?>


