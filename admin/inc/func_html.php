<?php function home_html_start() { echo '<!DOCTYPE html>
<html lang="de">
<head>
  <title>'; 
  echo  SITE_NAME; 

  echo '</title>';
  include ("../inc/meta.php");
//  echo '<BASE href="'.BASE.'/admin/">';

  echo '  <!-- icon -->
  <link rel="shortcut icon" href="../favicon.ico" />
  <!-- styles -->
  <link type="text/css" rel="stylesheet" href="../' . CSSFILE . '" />
  <link type="text/css" rel="stylesheet" href="admin_' . CSSFILE . '" />

  <!-- CodeMirror Syntax Highlight -->
  <script src="inc/codemirror/codemirror.js"></script>
  <script src="inc/codemirror/xml.js"></script>
  <script src="inc/codemirror/javascript.js"></script>
  <script src="inc/codemirror/css.js"></script>
  <script src="inc/codemirror/htmlmixed.js" type="text/javascript"></script>
  <link href="inc/codemirror/codemirror.css" rel="stylesheet" type="text/css" />
  <link href="inc/codemirror/default.css" rel="stylesheet" type="text/css" />

  <!--javascript-->
  <script type="text/javascript" src="../inc/javascript/jquery.js"></script>
  <script type="text/javascript" src="../inc/javascript/ladezeit.js"></script>
  <script type="text/javascript" src="../inc/javascript/modernizr.js"></script>
  <script type="text/javascript" src="../inc/javascript/jquery.min.js"></script>
  <script type="text/javascript" src="../inc/javascript/jquery.cycle.js"></script>
  <script type="text/javascript" src="../inc/javascript/sliding_effect.js"></script>
  <script type="text/javascript" src="../inc/javascript/zufalls_spruch.js"></script>
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

// Header

function home_html_head() {
if (ISIE == "ie") {
  echo "  <header>\n    <h1>" . SITE_NAME . "</h1>\n    <h2>" . SITE_TITLE . "</h2>\n  </header>\n";
  } else {
  echo '';
  }
  include  ("inc/header.php");
}

// Sidebar

function home_html_sidebar_start() {
  echo '
<div class="sidebar left">';
}

// Menu

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



function home_html_menu_link($target, $currend){
  if (!empty($target)) {
    if ($target == $currend) {
      echo '      <li class="sliding-element"><a class="menu-active" href="index.php?s=' . $target . '">' . $target . '</a></li>',"\n";
    } else {
      echo '      <li class="sliding-element"><a href="index.php?s=' . $target . '">' . $target . '</a></li>',"\n";
    }
  }
}

// Admin Submenu

function home_html_admin_subnav($curr) {
  $pages = home_pages_admin();
  echo '
  <div id="mainnav">
  <nav>

    <ul id="adminnav">
      <li class="sliding-element"><h3>Admin-SubNav</h3></li>',"\n";
  foreach ($pages as $p) {
    home_html_menu_admin_links($p, $curr );
  }
  echo '    </ul>',"\n",'  </nav>',"\n  </div>";
}

function home_html_menu_admin_links($target, $currend){
  if (!empty($target)) {
    if ($target == $currend) {
      echo '      <li class="sliding-element"><a class="menu-active" href="index.php?s=' . $target . '">' . $target . '</a></li>',"\n";
    } else {
      echo '      <li class="sliding-element"><a href="index.php?s=' . $target . '">' . $target . '</a></li>',"\n";
    }
  }
}
function home_html_menu_admin_subnav() {
echo "\n",'  <div id="admin-subnav">',"\n";
echo '  <nav>
    <ul id="adminnav">
      <li><h3>Admin-Submenu</h3></li>
      <li><a href="">Create Site</a></li>
      <li><a href="edit.php?s='. $s .'">Edit Site</a></li> 
      <li><a href="">Copy Site</a></li>
      <li><a href="">Move Site</a></li> 
      <li><a href="">Delete Site</a></li>
    </ul>
</nav>';
echo "\n",'  </div>',"\n\n";
}

// Admin header login menu

function home_html_admin_subnav_login($curr) {
  $pages = home_pages_admin();
  echo '
  <nav>

    <ul id="slidenav">
      <li class="sliding-element"><h3>Navigation</h3></li>',"\n";
  foreach ($pages as $p) {
    home_html_menu_admin_links_login($p, $curr );
  }
  echo '    </ul>',"\n",'  </nav>',"\n";
}

function home_html_menu_admin_links_login($target, $currend){
  if (!empty($target)) {
    if ($target == $currend) {
      echo '      <li class="sliding-element"><a class="menu-active" href="../index.php?s=' . $target . '">' . $target . '</a></li>',"\n";
    } else {
      echo '      <li class="sliding-element"><a href="../index.php?s=' . $target . '">' . $target . '</a></li>',"\n";
    }
  }
}

// Stop Sidebar

function home_html_sidebar_stop() {
  echo '</div>
';
}

// Links

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

// CRUD Functions
//File will be rewritten if already exists
function write_file($filename,$newdata) {
      $f=fopen($filename,"w");
       fwrite($f,$newdata);
       fclose($f);  
}

function append_file($filename,$newdata) {
      $f=fopen($filename,"a");
       fwrite($f,$newdata);
       fclose($f);  
}

function read_file($filename) {
      $f=fopen($filename,"r");
      $data=fread($f,filesize($filename));
      fclose($f);  
      return $data;
}

// XML in ein Array schreiben
function dom_to_array($root)
{
    $result = array();
    if ($root->hasAttributes()) {
        $attrs = $root->attributes;
        foreach ($attrs as $i => $attr)
            $result[$attr->name] = $attr->value;
    }

    $children = $root->childNodes;
    if ($children->length == 1) {

        $child = $children->item(0);
        if ($child->nodeType == XML_TEXT_NODE) {

            $result['_value'] = $child->nodeValue;
            if (count($result) == 1)
                return $result['_value'];
            else
                return $result;
        }
    }

    $group = array();

    for($i = 0; $i < $children->length; $i++) {

        $child = $children->item($i);
        if (!isset($result[$child->nodeName]))
            $result[$child->nodeName] = dom_to_array($child);
        else {
            if (!isset($group[$child->nodeName])) {
                $tmp = $result[$child->nodeName];
                $result[$child->nodeName] = array($tmp);
                $group[$child->nodeName] = 1;
            }
            $result[$child->nodeName][] = dom_to_array($child);
        }
    }
    return $result;
} 

function dom2array_full($node){
    $result = array();
    if($node->nodeType == XML_TEXT_NODE) {
        $result = $node->nodeValue;
    }
    else {
        if($node->hasAttributes()) {
            $attributes = $node->attributes;
            if(!is_null($attributes)) 
                foreach ($attributes as $index=>$attr) 
                    $result[$attr->name] = $attr->value;
        }
        if($node->hasChildNodes()){
            $children = $node->childNodes;
            for($i=0;$i<$children->length;$i++) {
                $child = $children->item($i);
                if($child->nodeName != '#text')
                if(!isset($result[$child->nodeName]))
                    $result[$child->nodeName] = dom2array($child);
                else {
                    $aux = $result[$child->nodeName];
                    $result[$child->nodeName] = array( $aux );
                    $result[$child->nodeName][] = dom2array($child);
                }
            }
        }
    }
    return $result;
} 

// FileCounter

function countFiles($strDirName) {
  if ($hndDir = opendir($strDirName)) {
    $intCount = 0;
    while (false !== ($strFilename = readdir($hndDir))) {
      if ($strFilename != "." && $strFilename != "..") {
        $intCount++;
      }
    }
    closedir($hndDir);
  } else {
  $intCount = -1;
  }
  return $intCount;
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

// Footer

function home_html_foot() {
if (ISIE == "ie") {
  echo "\n",'<footer>',"\n";
  echo "·:::· ";
  if(SITE_LOADTIME == "1") echo "Seiten-Ladezeit: <span id=\"Ladezeit\"><b class=\"warn\">no js</b></span> Sek. ·:::· ";
  echo "&copy; <!--#config timefmt=\"%Y\" --><!--#echo var=\"LAST_MODIFIED\" --> <a href=\"index.php?s=", SITE_DEFAULT ,"\">", SITE_NAME ,"</a> ·:::·";
  echo '    <div id="hoster">
      <a href="http://www.exigem.com/" title="hosted by exigem"></a>
    </div>';
  echo "\n",'</footer>',"\n";
  } else {
  echo '';
  }
  include  ("../inc/footer.php");
}

function home_html_stop() {
  echo '
</div>
</body>
</html>';
}

?>
