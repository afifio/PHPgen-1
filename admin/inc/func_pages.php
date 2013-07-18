<?php
// content functions

// returns array with all possible pages
function home_pages($input="none") {
// get all names exclude the "blacklist"
  $dir_handle = opendir("../pages/");    
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

// returns array with all possible pages for admin
function home_pages_admin($input="none") {
// get all names exclude the "blacklist"
  $dir_handle = opendir("../pages/");    
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
  include ("../pages/" . $i . "_" . $s  . "_page.php");
}

function admin_pages_load($s) {
  $i = home_pages_admin($s);
  include ("../pages/" . $i . "_" . $s  . "_page.php");
}





// list old backups
function read_folder_directory($dir = "./backup")
    {
        $listDir = array();
        if($handler = opendir($dir)) {
            while (($sub = readdir($handler)) !== FALSE) {
                if ($sub != "." && $sub != ".." && $sub != "Thumb.db" && $sub != "Thumbs.db") {
                    if(is_file($dir."/".$sub)) {
                        $listDir[] = $sub;
                    }elseif(is_dir($dir."/".$sub)){
                        $listDir[$sub] = ReadFolderDirectory($dir."/".$sub);
                    }
                }
            }
            closedir($handler);
        }
        return $listDir;
    } 


?>
