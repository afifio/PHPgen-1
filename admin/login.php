<?php

require ("../config.php");
// load functions

include ("inc/func_html.php");
include ("inc/func_pages.php");
// start script
include ("../inc/func_init.php");



     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      session_start();

      $request = $_REQUEST['s'];
      $username = $_POST['username'];
      $passwort = $_POST['passwort'];

      $validuser = SITE_OWNER;
      $validpasswd = SITE_PASSWD;

      $hostname = $_SERVER['HTTP_HOST'];
      $path = dirname($_SERVER['PHP_SELF']);

      // Benutzername und Passwort werden überprüft
      if ($username == $validuser && $passwort == $validpasswd) {
       $_SESSION['angemeldet'] = true;

       // Weiterleitung zur geschützten Startseite
       if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
        if (php_sapi_name() == 'cgi') {
         header('Status: 303 See Other');
         }
        else {
         header('HTTP/1.1 303 See Other');
         }
        }

       header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/index.php?s='.$request.'');
       exit;
       }
      }


// head
home_html_start();
home_html_head();

// Sidebar
home_html_sidebar_start();
echo "\n",'  <div class="clear" style="height:20px;">&nbsp;</div>',"\n";
home_html_admin_subnav_login($s);
home_html_sidebar_stop();

// body & wrap
echo "\n",'  <div id="content">',"\n";
//echo home_pages_load($s);
//echo admin_pages_load($s);
?>
<div id="login_wrap">
  <h3>Benutzer Login</h3>
  <form action="login.php" method="post">
   <input name="username" placeholder="Benutzername" /> Benutzername<br />
   <input type="password" name="passwort" placeholder="Passwort" /> Passwort<br /><br />
   <input type="submit" value="Anmelden" />
  </form>
</div>
<?php
echo "\n",'  <div class="clear">&nbsp;</div>',"\n";
echo "\n",'  </div>',"\n\n";

// foot
home_html_foot();

// close body & wrap

home_html_stop();

?>


