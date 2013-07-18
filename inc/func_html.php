<?php function home_html_start() { echo '<!DOCTYPE html>
<html lang="de">
<head>
  <title>'; 
  echo  SITE_NAME; 

  echo '</title>';
  include ("inc/meta.php"); 

  echo '  <!-- icon -->
  <link rel="shortcut icon" href="/favicon.ico" />
  <!-- styles -->
  <link type="text/css" rel="stylesheet" href="' . CSSFILE . '" />
  <!--javascript-->
  <script type="text/javascript" src="inc/javascript/jquery.js"></script> 
  <script type="text/javascript" src="inc/javascript/ladezeit.js"></script>
  <script type="text/javascript" src="inc/javascript/modernizr.js"></script>
  <script type="text/javascript" src="inc/javascript/jquery.min.js"></script>
  <script type="text/javascript" src="inc/javascript/jquery.cycle.js"></script>
';

// Intro view

function home_html_intro(){
  if(SITE_INTRO == "1") {

    $page = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $pageval = BASE . "/";

    if ("$page" === "$pageval") {
      echo '
	<link href="' . BASE . '/inc/css/splashscreen.css" type="text/css" rel="stylesheet" />
	<script src="' . BASE . '/inc/javascript/jquery-1.4.4.min.js"></script>
	<script src="' . BASE . '/inc/javascript/jquery.splashscreen.js"></script>
	<script src="' . BASE . '/inc/javascript/script.js"></script>
      ';
    } else {
      echo '';
    }
  }
}

echo home_html_intro();

echo '
  <script type="text/javascript" src="inc/javascript/sliding_effect.js"></script>
  <script type="text/javascript" src="inc/javascript/zufalls_spruch.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $("#HomeTicker").cycle({
	    fx: "fade",
	    speed: "1000",
	    timeout: "8000"	
	    });
    });
  </script>
</head>
<body onload="ladezeit()">
<div id="wrap">'."\n\n";
}

function home_html_sidebar_start() {
  echo '
<div class="sidebar left">';
}
function home_html_sidebar_stop() {
  echo '</div>
';
}

function home_html_head() {
if (ISIE == "ie") {
  echo "  <header>\n    <h1>" . SITE_NAME . "</h1>\n    <h2>" . SITE_TITLE . "</h2>\n  </header>\n";
  } else {
  echo '';
  }
  include  ("inc/header.php");
}


function home_html_menu($curr) {
  $pages = home_pages();
  echo '
  <div id="mainnav">
  <nav>
    <ul id="slidenav">
      <li class="sliding-element"><h3>Navigation</h3></li>',"\n";
  foreach ($pages as $p) {
    home_html_menu_link(rawurldecode($p), $curr );
  }
  echo '    </ul>',"\n",'  </nav>',"\n  </div>";
}

function home_html_link($target, $text="none") {
  if ($text == "none") $text = $target;
  echo ' <a href="index.php?s=' . $target . '">' . $text . '</a> ';
}

function home_html_ext_link($target, $text="none") {
  //if ($text == "none") 
  $text = $target;
  $output = "<a href=\"http://";
  $output .= $target;
  $output .= "\" target=\"_blank\" rel=\"external\">";
  $output .= $text;
  $output .= "</a>";
//  echo $output;
  return $output;
}

function home_html_ext_link_go($target, $text="none") {
  if ($text == "none") $text = $target;
  $link = substr("$target", 0, 7);
  $linkend = substr("$target", -1);
  if ($link != "http://") {
    $outlink = "http://$target";
  } else {
    $outlink = $target;
  }
  if ($linkend != "/") $outlink .= "/"; 
  $output = "<a href=\"";
  $output .= $outlink;
  $output .= "\">";
  $output .= $text;
  $output .= "</a>";
  return $output;
}

function home_html_menu_link($target, $currend){
  if (!empty($target)) {
    if ($target == $currend) {
      echo '      <li class="sliding-element"><a class="menu-active" href="index.php?s=' . $target . '">' . $target . '</a></li>',"\n";
    } else {
      echo '      <li class="sliding-element"><a href="index.php?s=' . $target . '">' . $target . '</a></li>',"\n";
    }
  }
}

// ?

function home_html_li($array) {
  $output = "keine Daten";
  if (!empty($array)) {
      $output = "<ul>";
    foreach($array as $string) {
      $output .= "<li>$string</li>";
    }
      $output .= "</ul>";
  }
  return $output;
}

function home_html_options($varray, $name="select", $selected="none", $option="none") {
  $output = "keine Daten";
  if (!empty($varray)) {
      $output = "<select name=\"$name\" size=\"1\"";
      if ($option == "inactive") $output .= " disabled";
      $output .= ">\n";
      $output .= "<option value=\"none\">Bitte w&auml;hlen Sie</option>\n";
      foreach($varray as $string) {
        $strings = split("[,]",$string); // split string from values
        $output .= "<option";
        if (!empty($strings[1])) { // check if no extra values are given
          $string = $strings[1];
          $value = $strings[0];
          if (count($varray) == 1) $selected = $value;
          if ($value == $selected) $output .= " selected=\"selected\""; // setting up the selected one
          $output .= " value=\"$value\"";
        } else {
          $string = $strings[0];
        }
        $output .= ">$string</option>\n";
      }
      $output .= "</select>\n";
      if ($option =="inactive") {
        $output .= "<input type=\"hidden\" name=\"$name\" value=\"$selected\" />";
      }
  }
  return $output;
}


function home_html_foot() {
if (ISIE == "ie") {
  echo "\n",'<footer>',"\n";
  echo "·:::· ";

  if(SITE_LOADTIME == "1") echo "Seiten-Ladezeit: <span id=\"Ladezeit\"><b class=\"warn\">no js</b></span> Sek. ·:::· ";
  echo "&copy; <!--#config timefmt=\"%Y\" --><!--#echo var=\"LAST_MODIFIED\" --> <a href=\"index.php?s=", SITE_DEFAULT ,"\">", SITE_NAME ,"</a> ·:::·";

  if(SITE_VALIDATOR_HTML == "1") echo '
    <!-- html-validator -->
    <a href="http://validator.w3.org/check?uri=referer" target="_blank">
      <img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" title="Valid XHTML 1.0 Transitional" height="16" />
    </a> ·:::· ';

  if(SITE_VALIDATOR_CSS == "1") echo '
    <!-- css-validator -->
    <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">
      <img style="border:0;height:16px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="CSS ist valide!" title="Valid CSS 3.0" />
    </a> ·:::· ';

  echo '    <div id="hoster">
      <a href="http://www.exigem.com/" title="hosted by exigem"></a>
    </div>';
  echo "\n",'</footer>',"\n";
  } else {
  echo '';
  }
  include  ("inc/footer.php");
}

function home_html_stop() {
  echo '
</div>
</body>
</html>';
}

?>
