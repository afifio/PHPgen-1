<?php
// initialisiation and setting up vars

// disable error reporting
 error_reporting(0);

// get s for currend site
if (empty($_REQUEST['s'])) {
  $s = SITE_DEFAULT;
} else {
  if (home_pages($_REQUEST['s']) > 0) {
    $s = $_REQUEST['s'];
  } else {
    $s = SITE_DEFAULT;  
  }
}

// get s for currend site
if (empty($_REQUEST['s'])) {
  $ss = SITE_DEFAULT;
} else {
  if (home_pages($_REQUEST['s']) > 0) {
    $ss = $_REQUEST['s'];
  } else {
    $ss = SITE_DEFAULT;  
  }
}

// setting up currend land
// de / at / ch

  $l = "de";
if (!empty($_REQUEST['l'])) {
  switch ($_REQUEST['l']) {
  case de:
    $l = "de";
  break;
  case at:
    $l = "at";
  break;
  case ch:
    $l = "ch";
  break;
  }
}
define ("LAND",$l);
unset($l);


// get browser and chose css file and define if is evil IE
  $result_css = "style.css";
  $result_ie = "noie";
  $uas = explode(";", $HTTP_USER_AGENT);
  $ual = explode(" ", $HTTP_USER_AGENT);

  foreach ($uas as $ass ) {
    if ($ass == "MSIE") {
      $result_css = "iestyle.css";
      $result_ie = "ie";
    }
  }
  foreach ($ual as $ass ) {
    if ($ass == "MSIE") {
      $result_css = "iestyle.css";
      $result_ie = "ie";
    }
  }
  if (DEBUG >= "1") 
  echo "using stylesheet $result_css";
  define ("CSSFILE","$result_css");
  define ("ISIE","$result_ie");

//if (!empty($_REQUEST['e'])) 		$e 		= $_REQUEST['e'];
//if (!empty($_REQUEST['selectr'])) 	$selectr 	= $_REQUEST['selectr'];
//if (!empty($_REQUEST['selectb'])) 	$selectb 	= $_REQUEST['selectb'];
//if (!empty($_REQUEST['selecto'])) 	$selectb 	= $_REQUEST['selecto'];

?>
