<?php

include('auth.php'); 
require ("../config.php");
include ("inc/func_html.php");
include ("inc/func_pages.php");
include ("../inc/func_init.php");

// Variablen
$file = "../tmp/test.xml";					// XML Datei 
$error = "false";
$date = date("d.m.Y_H:i"); 					// Datum 
$return = "test.php";

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
        <time datetime=\"2011-11-13\" pubdate>13.November 2011</time>
        <h1>Testseitenlayout</h1>
      </header>

<p>Testumgebung zum ausprobieren. </p>

</article>
';

//
// Sektion 001
//

echo "<article>

      <header>
        <time datetime=\"2011-11-13\" pubdate>13.November 2011</time>
        <h1>1. Unterpunkt</h1>
      </header>";

//Content
dom2array_full($file);
echo $result(0);


echo "\n",'</article>',"\n\n";
echo "\n",'  <div id="clear">&nbsp;</div>',"\n";
echo "\n",'  </div>',"\n\n";



// foot
home_html_foot();

// close body & wrap

home_html_stop();

?>
