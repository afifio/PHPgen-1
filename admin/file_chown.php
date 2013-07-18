<?php

include('auth.php');
include ("../config.php");
include ("inc/func_html.php");
include ("inc/func_pages.php");
include ("../inc/func_init.php");

$folder = $_REQUEST['f'];	// Ordnername
$user = $_REQUEST['u'];		// Benutzername
$return = $_REQUEST['back'];	// Returnpfad
$val = $_REQUEST['val'];	// URL komplett

if (empty($val)) {
  $return = 'setup.php';
  echo '<meta http-equiv="refresh" content="2; url=' . $return . '" />';
  echo 'Request <b style="color:#DD0000;">' . $val . '</b> ist leer!';
  exit;
}

$valvar = base64_encode(serialize(md5($folder. $user)));

if ("$valvar" != "$val") {
  echo '<meta http-equiv="refresh" content="2; url=' . $return . '" />';
  echo 'Request <b style="color:#DD0000;">' . $val . '</b> ist ung&uuml;ltig!';
  exit;
}

// 

//$folder = realpath($folder);
$folder = substr($folder,0,-1); 
//$user = "$user:$user";

chgrp($folder, "$user");
//chown($folder, "$user");
//chmod($folder, 0777);
#$time = $time();
#if (!touch($folder, $time)) {
#    echo 'Ein Fehler ist aufgetreten ...';
#}

#echo "Ordner: <b style='color:#007700;'>$folder</b><br />";
#echo "Benutzer: <b style='color:#007700;'>$user</b><br />";
#echo "Return: <b style='color:#007700;'>$return</b><br />";
#echo "Val 0 : <b style='color:#007700;'>$val</b><br />";
#echo "Val 1 : <b style='color:#007700;'>$valvar</b><br /><br />";

echo '<meta http-equiv="refresh" content="0; url=' . $return . '" />';
#echo "Rechte an <b style='color:#007700;'>$folder</b> wurde erfolgreich ge&auml;ndert<br /><br />";

#echo $folder . "<br />";

#$stat = stat($folder);
#print_r(posix_getpwuid($stat['uid']));

?>
