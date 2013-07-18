<?php

include('auth.php'); 
require ("../config.php");
include ("inc/func_html.php");
include ("inc/func_pages.php");
include ("../inc/func_init.php");

// testen ob default url schon gefüllt ist und existiert, wenn nicht umschreiben in passenden dateinamen
if (file_exists($file)) {
// do nothing
} else {
$setup_cfgfile = "../tmp/config.xml";
}

// All Folders in an Array
$pages_folder = "../pages/";						// Seiten Ordner
$backup_folder = "../admin/backup/";					// Backup Ordner
$plugins_folder = "../inc/plugins/";					// Plugin Ordner
$css_folder = "../inc/css/";						// CSS Ordner
$upload_folder = "../inc/upload/";					// Upload Ordner

$filefolder = array("$pages_folder", "$backup_folder", "$plugins_folder", "$css_folder", "$upload_folder");

// All Files in an Array, erst wenn wir mehr haben
$file_customers = "../tmp/kunden.xml";					// Kundendatei 

$error = "false";
$date = date("d.m.Y_H:i"); 						// Datum 
$user = "www-data";							// Benutzername des Webservers
$return = "setup.php";

//Verzeichnisse beschreibar?


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
        <h1>Basis Installation</h1>
      </header>

<p>Geben Sie hier alle Daten zu ihrer Webseite ein. Bitte verwenden Sie eine gültige E-Mail Adresse, da an diese die Systemnachrichten und Kontaktformularanfragen gesendet werden. </p>

</article>
';

//
// Sektion Ordner und Dateirechte
//

echo "<article>

      <header>
        <time datetime=\"2011-11-13\" pubdate>13.November 2011</time>
        <h1>1. Ordnerrechte</h1>
      </header>";

echo "\n  " . '<ul id="backup_list">' ."\n";


foreach ($filefolder as $file_folder) {

  $val = base64_encode(serialize(md5($file_folder. $user)));
  if (is_writable($file_folder) != "true") {
    echo "    <li><b class='setup_warn'>" . $file_folder . "</b> ist nicht beschreibbar <a style='display:inline;float:right;padding:2px 0;margin:-6px 0 0 0;' href='file_chown?f=$file_folder&amp;u=$user&amp;back=$return&amp;val=$val' title='Rechte versuchen anzupassen'>anpassen <img src='../img/icons/attention.png' witdh='24' height='24' style='padding:0;margin:0 0 -6px 0;' alt='&#10007;' /></a></li>\n";
    static $error = "true";

//    echo $val;

  } else {
    echo "    <li><b class='setup_ok'>" . $file_folder . "</b> ist beschreibbar </li>\n";
  }
}

echo '  </ul>';

if ($error != "false") {
echo '<p>&Uuml;berpr&uuml;fen Sie die Schreibrechte, der Webserver-Benutzer (bei apache www-data) sollte der Besitzer des Ordners sein um darin schreiben zu d&uuml;rfen.</p>';
} else {
echo '<p>Alle Ordner sind O.K.</p>';
}

echo $error;

echo "\n </article> \n";

//
// Sektion Konfiguration
//

echo "<article>

      <header>
        <time datetime=\"2011-11-13\" pubdate>13.November 2011</time>
        <h1>2. Daten ihrer Seite eingeben</h1>
      </header>";

echo "<br /><br />

<form action='$return' method='post'>
<table width='780' border='0' align='center'>

<tr> 
<td width='256'><label class='screen-reader-text'>Basis URL Adresse</label></td>
<td width='514'>
  <input type='text' name='base' id='base' value='"; if(isset($_POST['base'])) echo $_POST['base'] ; echo "' class='txt requiredField base"; if($baseError != '') { echo ' inputError'; }; echo "' placeholder='http://domain.de/' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>E-Mail Adresse</label></td>
<td width='514'>
  <input type='text' name='email' id='email' value='"; if(isset($_POST['email'])) echo $_POST['email'] ; echo "' class='txt requiredField email "; if($emailError != '') { echo 'inputError'; }; echo "' placeholder='your@domain.de' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>Name der Seite</label></td>
<td width='514'>
  <input type='text' name='site_name' id='site_name' value='"; if(isset($_POST['site_name'])) echo $_POST['site_name'] ; echo "' class='txt requiredField site_name "; if($site_nameError != '') { echo 'inputError'; }; echo "' placeholder='Meine Webseite' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>Untertitel</label></td>
<td width='514'>
  <input type='text' name='site_title' id='site_title' value='"; if(isset($_POST['site_title'])) echo $_POST['site_title'] ; echo "' class='txt requiredField site_title "; if($site_titleError != '') { echo 'inputError'; }; echo "' placeholder='Ein knackiger Untertitel' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>Benutzername</label></td>
<td width='514'>
  <input type='text' name='site_owner' id='site_owner' value='"; if(isset($_POST['site_owner'])) echo $_POST['site_owner'] ; echo "' class='txt requiredField site_owner "; if($site_ownerError != '') { echo 'inputError'; }; echo "' placeholder='Administrator' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>Passwort</label></td>
<td width='514'>
  <input type='password' name='passwd' id='passwd' value='"; if(isset($_POST['passwd'])) echo $_POST['passwd'] ; echo "' class='txt requiredField passwd "; if($passwdError != '') { echo 'inputError'; }; echo "' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>Twitter</label></td>
<td width='514'>
  <input type='text' name='twitter' id='twitter' value='"; if(isset($_POST['twitter'])) echo $_POST['twitter'] ; echo "' class='txt requiredField twitter "; if($twitterError != '') { echo 'inputError'; }; echo "' placeholder='twitter.com/exigem' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>Facebook</label></td>
<td width='514'>
  <input type='text' name='facebook' id='facebook' value='"; if(isset($_POST['facebook'])) echo $_POST['facebook'] ; echo "' class='txt requiredField facebook "; if($facebookError != '') { echo 'inputError'; }; echo "' placeholder='facebook.com/exigem' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>E-Mail Adresse der Firma</label></td>
<td width='514'>
  <input type='text' name='mail_compname' id='mail_compname' value='"; if(isset($_POST['mail_compname'])) echo $_POST['mail_compname'] ; echo "' class='txt requiredField mail_compname "; if($mail_compnameError != '') { echo 'inputError'; }; echo "' placeholder='info@domain.de' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>Telefonnummer der Firma</label></td>
<td width='514'>
  <input type='text' name='mail_compphone' id='mail_compphone' value='"; if(isset($_POST['mail_compphone'])) echo $_POST['mail_compphone'] ; echo "' class='txt requiredField mail_compphone "; if($mail_compphoneError != '') { echo 'inputError'; }; echo "' placeholder='+49 (531) 428 77 630' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>Faxnummer der Firma</label></td>
<td width='514'>
  <input type='text' name='mail_compfax' id='mail_compfax' value='"; if(isset($_POST['mail_compfax'])) echo $_POST['mail_compfax'] ; echo "' class='txt requiredField mail_compfax "; if($mail_compfaxError != '') { echo 'inputError'; }; echo "' placeholder='+49 (531) 428 77 639' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>Seitenintro</label></td>
<td width='514'>
  <input type='checkbox' name='intro' id='intro' value='"; if(isset($_POST['intro'])) echo '1' ; echo "' class='radio  requiredField intro "; if($introError != '') { echo 'inputError'; }; echo "' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>Seitenladezeit</label></td>
<td width='514'>
  <input type='checkbox' name='loadtimer' id='loadtimer' value='"; if(isset($_POST['loadtimer'])) echo '1' ; echo "' class='radio  requiredField loadtimer "; if($loadtimerError != '') { echo 'inputError'; }; echo "' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>Validatorlink HTML</label></td>
<td width='514'>
  <input type='checkbox' name='valid_html' id='valid_html' value='"; if(isset($_POST['valid_html'])) echo '1' ; echo "' class='radio  requiredField valid_html "; if($valid_htmlError != '') { echo 'inputError'; }; echo "' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td width='256'><label class='screen-reader-text'>Validatorlink CSS</label></td>
<td width='514'>
  <input type='checkbox' name='valid_css' id='valid_css' value='"; if(isset($_POST['valid_css'])) echo '1' ; echo "' class='radio  requiredField valid_css "; if($valid_cssError != '') { echo 'inputError'; }; echo "' style='margin:0 0 15px 0;' />
</td>
</tr>

<tr>
<td>&nbsp;</td>
<td><button name='submit' type='submit' class='subbutton'>Speichern</button>
  <input type='hidden' name='submitted' id='submitted' value='true' /></td>

<tr>

<td colspan='2'><div align='center'></div></td>
</tr>
</table>

";

echo "\n </article> \n";

//
// Setupdaten verarbeiten und schreiben
//

// $base (Die Basisurl inkl. http://www.tld.com/gen )
// $mail (Die Emailadresse am besten encoden)
// $site_name (der Seitenname)
// $site_title (Untertitel, Slogan)
// $site_owner (Benutzername)
// $passwd (Passwort)
// $twitter
// $facebook
// $mail_compname
// $mail_compphone
// $mail_compfax
// $intro
// $loadtimer
// $valid_html
// $valid_css
// $site_default
// $site_imprint
// $debug
// $version

  $setup = array();
  $setup [] = array(
  'base' => "$base",
  'email' => "$email",
  'site_name' => "$site_name",
  'site_title' => "$site_title",
  'site_owner' => "$site_owner",
  'passwd' => "$passwd",
  'twitter' => "$twitter",
  'facebook' => "$facebook",
  'mail_compname' => "$mail_compname",
  'mail_compphone' => "$mail_compphone",
  'mail_compfax' => "$mail_compfax",
  'intro' => "$intro",
  'loadtimer' => "$loadtimer",
  'valid_html' => "$valid_html",
  'valid_css' => "$valid_css",
  'site_default' => "$site_default",
  'site_imprint' => "$site_imprint",
  'debug' => "$debug",
  'version' => "$version"
  ); // Setupdaten

// Neues Dokument erzeugen
$doc = new DOMDocument();
$doc->formatOutput = true;
$doc->preserveWhiteSpace = false;
//$doc->load( "$filename" ) or die("Error"); // DOM load

//
// Die Daten
//

// Wurzelknoten
$datavar = $doc->createElement( "data" );
$doc->appendChild( $datavar );

// Erstes Element
$r = $doc->createElement( "setup" );
$doc->appendChild( $r );

foreach( $setup as $setupvar ) {

    $b = $doc->createElement( "setupvar" );
//    $b->setAttribute("id", "$id");

    // Base
    $base = $doc->createElement( "base" );
    $base->appendChild($doc->createTextNode($setupvar['base']));
    $b->appendChild( $base );

    // Mail
    $base = $doc->createElement( "mail" );
    $base->appendChild($doc->createTextNode($setupvar['mail']));
    $b->appendChild( $base );

    $r->appendChild( $b );
  } // close foreach

// Daten in XML Datei speichern und übergeben
$doc->saveXML();
$doc->save("$filename");

echo "\n",'</article>',"\n\n";
echo "\n",'  <div id="clear">&nbsp;</div>',"\n";
echo "\n",'  </div>',"\n\n";

// foot
home_html_foot();

// close body & wrap

home_html_stop();

?>
