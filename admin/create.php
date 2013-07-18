<?php include('auth.php'); ?>
<?php

$action=$_POST['action'];
$textarea=$_POST['textarea'];
$page = $_POST['s_neu'];


include ("../config.php");

// load functions
include ("inc/func_html.php");
include ("inc/func_pages.php");

// start script
include ("inc/func_init.php");

$ready_url = 'create.php?s='.$s ;
$return='index.php?s='.$s;

// testen ob url schon gefüllt ist und existiert, wenn nicht umschreiben in passenden dateinamen
if (file_exists($url)) {
// do nothing
} else {
$i = countFiles('../pages/');
$url_old = "../pages/" . $i . "_" . $s  . "_page.php";
$url = "../tmp/0_DEFAULT_page.php";
$url_neu = "../pages/" . $i . "_" . $page  . "_page.php";
}

// Get page
$data = implode("", file($url));

$ta=br2nl($data);
$s_neu=br2nl($s);

function br2nl($str) {
return preg_replace('=<br */? >=i', "<br />", $str);
}

if($action=="save"){


if (empty($page)) {
  echo "Seitenname wurde nicht ausgefüllt !!!";
  echo "<input type='hidden' name='textarea' value='$textarea' />";
  echo '<meta http-equiv="refresh" content="1; url='.$ready_url.'" />';
  exit();
}

if ($url_neu == $url_old) {
// do nothing
} else {
// REMOVE OLD FILE
copy($url, $url_neu);
$ready_url='index.php?s='.$page;
$url=$url_neu;
}

$newtext=stripslashes($textarea);
//$newtext = str_replace("<?", "", $newtext);
//$newtext = str_replace("? >", "", $newtext);
//$newtext = nl2br($newtext);
$fh = fopen($url, 'w') or die("can't open file <b>$url</b>");
fwrite($fh, $newtext);
fclose($fh); 
//header ("Location: $return");
//header('Location: index.php?s='.$ready_url.'');
echo '<meta http-equiv="refresh" content="0; url='.$ready_url.'" />';

// --> action save 
} else {

// head
home_html_start();
home_html_head();

// Sidebar
home_html_sidebar_start();
home_html_menu($s);
require ("inc/admin_menu.php");
home_html_sidebar_stop();

// body & wrap
echo "\n",'  <div id="content">',"\n";

echo"
<article>

      <header>
        <time datetime=\"2011-04-14\" pubdate>14.April 2011</time>
        <h1>Seite erstellen</h1>
      </header>

<p></p>
<form action='create.php' method='post'>
<input type='hidden' name='action' value='save'>
<input type='hidden' name='p' value='$url'>
<input type='hidden' name='n' value='$n'>
<input type='text' name='s_neu' id='s_neu' value=''> Seitenname<br /><br />
<textarea name='textarea' id='textarea' rows='20' cols='100'>$ta</textarea>

<script> 
  var editor = CodeMirror.fromTextArea(document.getElementById('textarea'), {
    lineNumbers: true,
    matchBrackets: true,
    mode: 'text/html'
  });
</script>

<br /><br />
&nbsp;<input type='submit' name='submit' value='Save Changes'> 
</form>
<a style='float:left;' href='$return'><button>zur&uuml;ck</button></a>

<div id=\"debug_out\">
<p>Variable s_neu : " . $s_neu . "</p>
<p>Variable page : " . $page . "</p>
<p>Variable url : " . $url . "</p>
<p>Variable n : " . $n . "</p>
<p>Variable s : " . $s . "</p>
<p>Variable url_old : " . $url_old . "</p>
<p>Variable req : " . home_pages($_REQUEST['s']) . "</p>
<p>Variable i : " . $i . "</p>
<p>Variable str : " . $str . "</p>
<p>Variable return : " . $return . "</p>
<p>Variable ready_url : " . $ready_url . "</p>
</div>

</article>

";

echo "\n",'  <div id="clear">&nbsp;</div>',"\n";
echo "\n",'  </div>',"\n\n";

// foot
home_html_foot();

// close body & wrap
home_html_stop();

// --> action save 
}



?> 
