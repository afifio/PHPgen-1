<?php include('auth.php'); ?>
<?php
// Generator Main Page

// load config
require ("../config.php");
// load functions

include ("inc/func_html.php");
include ("inc/func_pages.php");
// start script
include ("../inc/func_init.php");

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
echo admin_pages_load($s);
echo "\n",'  <div id="clear">&nbsp;</div>',"\n";
echo "\n",'  </div>',"\n\n";

// foot
home_html_foot();

// close body & wrap

home_html_stop();

?>
