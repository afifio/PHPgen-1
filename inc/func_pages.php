<?php
// content functions

// returns array with all possible pages
function home_pages($input="none") {
// get all names exclude the "blacklist"
  $dir_handle = opendir("./pages/");    
  $i = 0;
  while ($wpage = readdir($dir_handle)) {
    $page_parts = explode("_", $wpage);
    $page = $page_parts['0'];
    $backup = substr($wpage, "-1");
    if ($page != "." && $page != ".." && $backup != "~") {
      if (!empty($page) && $page != "page") {
        $pages[$i] = $page_parts['1'];
        $sort[$i] = $page_parts['0'];
        $i++;
      }
    }
  }
  closedir($dir_handle);
  array_multisort( $sort,$pages);

// wishing output mode
  if ($input == "none") {
    return $pages;
  } else {
    if (is_int($input)) {
      return $pages[$input];
    } else {
      $i = 1;
      foreach ($pages as $page) {
        if ($page == $input) {
          return $i;
        }
        $i++;
      }
    }
  }
}


// display page
function home_pages_load($s) {
  $i = home_pages($s);
//  if ($s == "Impressum") $i ="0";
  include ("./pages/" . $i . "_" . $s  . "_page.php");
}

?>
