<?php include('auth.php'); ?>
<?php

include ("../config.php");

$remove = $_POST['remove0815'];
$url = $_POST['pageurl'];
$i = $_POST['pageid'];

include ("inc/func_html.php");
include ("inc/func_pages.php");
include ("../inc/func_init.php");

$countold = (countFiles('../pages/')-1);
$countdiff = ($countold - $i);
$page_name_parts = explode("_", $page_name);

if (empty($remove)) {
  echo '<meta http-equiv="refresh" content="0; url=remove.php?s='. $s .'" />';
}

function rrmdir($path)
{
  return is_file($path)?
    @unlink($path):
    array_map('rrmdir',glob($path.'/*'))==@rmdir($path)
  ;
}

// Kopiere aeltere Beitraege zu richtigen ids
if ('$i' > '$countold') {
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
  array_multisort($sort,$pages);

  for ($counter = 1; $counter <= $countdiff; $counter++) {
    $mvurl1 = '../pages/'. $i. '_' . $pages[$i-1] . '_page.php';
    $mvurl2 = '../pages/'. ($i-1) . '_' . $pages[$i-1] . '_page.php';
    echo "umbenannt: " . $mvurl1 . " -> <b>". $mvurl2 ."</b> <br><br>";

    $fh = rename("$mvurl1", "$mvurl2");
    fclose($fh);

    $i = $i-1;  
  }
}


rrmdir($url);

 echo '<meta http-equiv="refresh" content="0; url=index.php" />';

// echo $url . " wurde gelöscht <br>";
?>
