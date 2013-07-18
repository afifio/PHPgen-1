<?php

include('auth.php'); 

include ("../config.php");
include ("inc/func_html.php");
include ("inc/func_pages.php");
include ("inc/func_init.php");

$action=$_POST['action'];
$textarea=$_POST['textarea'];
$url=$_POST['p'];
$page = $_POST['s_neu'];
$page_folder = $_REQUEST['pf'];
$date = $_REQUEST['d'];
$folder = $_REQUEST['f'];
$filename = $_REQUEST['s'];
$fileurl = ($folder.$filename);	
$i = 0;

// testen ob url schon gefüllt ist und existiert, wenn nicht umschreiben in passenden dateinamen
if (file_exists($url)) {
// do nothing
} else {
$url = $fileurl;
}

$ready_url = 'theme_edit.php';
$return='theme.php';

$data = implode("", file($url));

$ta=br2nl($data);
$s_neu = $filename;

function br2nl($str) {
return preg_replace('=< br */? >=i', "<br />", $str);
}

if($action=="save"){

$url = $folder.$page;

//$newtext=stripslashes($textarea);
$newtext=$textarea;
$newtext = str_replace("<?", "&lt;?", $newtext);
$newtext = str_replace("?>", "?&gt;", $newtext);

//
// In Datei Schreiben
//

$fh = fopen($url, 'w') or die("can't open file <b>$url</b>");
fwrite($fh, $newtext);
fclose($fh); 
echo '<meta http-equiv="refresh" content="0; url='.$return.'" />';

#echo "
#<div id=\"debug_out\">
#<p>Variable s_neu : \" . $s_neu . \"</p>
#<p>Variable page : \" . $page . \"</p>
#<p>Variable url : \" . $url . \"</p>
#<p>Variable n : \" . $n . \"</p>
#<p>Variable s : \" . $s . \"</p>
#<p>Variable i : \" . $i . \"</p>
#<p>Variable str : \" . $str . \"</p>
#<p>Variable return : \" . $return . \"</p>
#<p>Variable ready_url : \" . $ready_url . \"</p>
#<p>Variable folder : \" . $folder . \"</p>
#<p>Variable filename : \" . $filename . \"</p>
#<p>Variable fileurl : \" . $fileurl . \"</p>
#</div>
#";

}
else{

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
        <h1>Datei ". $filename . " editieren</h1>
      </header>

<p></p>
<form action='$ready_url' method='post'>
<input type='hidden' name='action' value='save'>
<input type='hidden' name='p' value='$url'>
<input type='hidden' name='n' value='$n'>
<input type='hidden' name='f' value='$folder'>
<input type='text' name='s_neu' id='s_neu' value='$s_neu'> Seitenname<br /><br />
<textarea name='textarea' id='code' rows='20' cols='100'>$ta</textarea>

<script> 
  var editor = CodeMirror.fromTextArea(document.getElementById('code'), {
    lineNumbers: true,
    matchBrackets: true,
    mode: 'text/css'
  });
</script> 

<br /><br />
<input type='submit' name='submit' value='&Auml;nderungen Speichern'> 
</form>
<a href='$return'><button>Zur&uuml;ck</button></a> 

<div id=\"debug_out\">
<p>Variable s_neu : " . $s_neu . "</p>
<p>Variable page : " . $page . "</p>
<p>Variable url : " . $url . "</p>
<p>Variable n : " . $n . "</p>
<p>Variable s : " . $s . "</p>
<p>Variable i : " . $i . "</p>
<p>Variable str : " . $str . "</p>
<p>Variable return : " . $return . "</p>
<p>Variable ready_url : " . $ready_url . "</p>
<p>Variable folder : " . $folder . "</p>
<p>Variable filename : " . $filename . "</p>
<p>Variable fileurl : " . $fileurl . "</p>
</div>

</article>

";

echo "\n",'  <div id="clear">&nbsp;</div>',"\n";
echo "\n",'  </div>',"\n\n";

// foot
home_html_foot();

// close body & wrap
home_html_stop();
}

?> 
