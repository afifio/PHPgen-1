<?php include('auth.php');

$textarea = $_POST['textarea'];

$filename = "../tmp/kunden.txt";
// Get Content and format
$data = implode("", file($filename));

function br2nl($str) {
  return preg_replace('=<br */? >=i', "<br />", $str);
}

$ta = br2nl($data);

$id = count(file($filename))+1;

if (empty($id)) { 
  $id = "1";
} else {
  $id = $id++ ;
};

// Wenn Submitet wurde -> Schreibe Informationen in text datei

if($_POST['Submit'])
{

$name = $_POST['name'];
$street = $_POST['street'];
$plz = $_POST['plz'];
$city = $_POST['city'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$web = $_POST['web'];

//the data
$data = "$id | $name | $street | $plz $city | $email | $phone | $web \n";

//open the file and choose the mode
$fh = fopen($filename, "a");
fwrite($fh, $data);

//close the file
fclose($fh);

print "Information Submitted. Thanks";
echo '<meta http-equiv="refresh" content="0; url='.$ready_url.'" />';
}
else
{


include ("../config.php");
// load functions

include ("inc/func_html.php");
include ("inc/func_pages.php");
// start script
include ("inc/func_init.php");

$ready_url = 'create_customer.php';

// head
home_html_start();
home_html_head();

// Sidebar
home_html_sidebar_start();
home_html_menu($s);
require ("inc/admin_menu.php");
home_html_sidebar_stop();

// Write to File
$contents = fread($fh, filesize($filename));
fclose($fh);

// body & wrap
print <<<ENDOFTXT
  <div id="content">

    <article>

      <header>
        <time datetime=\"2011-04-14\" pubdate>14.April 2011</time>
        <h1>Kunden Verwaltung</h1>
      </header>

    <p>Angelegte Kunden :</p>

<form name="form" action='create_customer.php' method='post'>
<input type='hidden' name='id' value='$id'>
<input type='hidden' name='action' value='save'>
<textarea name='textarea' rows='20' cols='100'>$ta</textarea>
</form>
<br />

      <header>
        <time datetime=\"2011-04-14\" pubdate>14.April 2011</time>
        <h1>Neukunden anlegen</h1>
      </header>

    <p></p>

<form name="form1" method="post" action="create_customer.php">
<table width="780" border="0" align="center">

<tr>
<td width="256"><span class="style5">Name (Vor, Nach oder Firma) :</span></td>
<td width="514">
  <input name="name" type="text" id="name" value="Name"
onblur="if(this.value.length == 0) this.value='Name';" onclick="if(this.value == 'Name') this.value='';">
</td>
</tr>

<tr>
<td><span class="style5">Stra&szlig;e (inkl. Hausnummer):</span></td>
<td>
<input name="street" type="text" id="street" value="Stra&szlig;e"
onblur="if(this.value.length == 0) this.value='Stra&szlig;e';" onclick="if(this.value == 'Stra&szlig;e') this.value='';">
</td>
</tr>

<tr>
<td><span class="style5">Postleitzahl :</span></td>
<td>
<input name="plz" type="text" id="plz" value="38100"
onblur="if(this.value.length == 0) this.value='38100';" onclick="if(this.value == '38100') this.value='';">
</td>
</tr>
<tr>
<td><span class="style5">Stadt :</span></td>
<td>
<input name="city" type="text" id="city" value="Stadt"
onblur="if(this.value.length == 0) this.value='Stadt';" onclick="if(this.value == 'Stadt') this.value='';">
</td>
</tr>

<tr>
<td><span class="style5">E-Mail Adresse :</span></td>
<td>
<input name="email" type="text" id="email" value="mail&#64;provider.de"
onblur="if(this.value.length == 0) this.value='mail&#64;provider.de';" onclick="if(this.value == 'mail&#64;provider.de') this.value='';">
</td>
</tr>

<tr>
<td><span class="style5">Telefon: </span></td>
<td>
<input name="phone" type="text" id="phone" value="(0531) 42877630"
onblur="if(this.value.length == 0) this.value='(0531) 42877630';" onclick="if(this.value == '(0531) 42877630') this.value='';">
</td>
</tr>

<tr>
<td><span class="style5">Internet: </span></td>
<td><input name="web" type="text" id="web" value="http://www.provider.de/"
onblur="if(this.value.length == 0) this.value='http://www.provider.de/';" onclick="if(this.value == 'http://www.provider.de/') this.value='http://';"></td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;<input type='hidden' name='id' value='$id'></td>
</tr>

<tr>
<td>&nbsp;</td>
<td><input name="Submit" type="submit" class="style5" value="Absenden"></td>
</tr>

<tr>
<td colspan="2"><div align="center"></div></td>
</tr>
</table>

<p align="center">&nbsp;</p>
</form>

    <div id="debug_out">
      <p>Variable s : " . $s . "</p>
      <p>Variable page : " . $page . "</p>
      <p>Variable url : " . $url . "</p>
      <p>Variable n : " . $n . "</p>
      <p>Variable i : " . $i . "</p>
      <p>Variable str : " . $str . "</p>
      <p>Variable ourFileName : " . $ourFileName . "</p>
      <p>Variable return : " . $return . "</p>
      <p>Variable ready_url : " . $input_url . "</p>
      <p>Variable contents : " . $contents . "</p>
      <p>Variable id : $id</p>
    </div>

  </article>
  <div id="clear">&nbsp;</div>
  </div>

ENDOFTXT;

}

?> 
