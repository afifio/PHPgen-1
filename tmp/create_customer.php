<?php include('auth.php');

// Get Content and format
$filename = "../tmp/kunden.xml";
$filename_bkup = "../tmp/bkup_kunden.xml";

$doc = new DOMDocument();
$doc->validateOnParse = true;
$doc->load( "$filename" );
$doc->formatOutput = true;

// auslesen der obersten (letzen) id
$ids = $doc->getElementsByTagName( "customers" );

//$idu = $ida->item(0)->getAttribute('id');

if ($ids->item(0)->getElementsByTagName("customer")->length == "0") {
  $doc = new DOMDocument();
  $doc->validateOnParse = true;
  $doc->load( "$filename_bkup" );
  $doc->formatOutput = true;
  // Daten in XML Datei speichern und übergeben
  $doc->saveXML();
  $doc->save("$filename");
  echo '<meta http-equiv="refresh" content="0; url='.$ready_url.'" />';
} else {
  $ida = $ids->item(0)->getElementsByTagName( "customer" );
  $idu = $ida->item(0)->getAttribute('id');
  $id = $idu+1;
}

// Wenn id leer
if (empty($id)) { 
  $id = "1";
} else {
  $id = $id++ ;
};

if($_POST['Submit'])
{
$id = $_POST['id'];
$name = $_POST['name'];
$street = $_POST['street'];
$plz = $_POST['plz'];
$city = $_POST['city'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$web = $_POST['web'];

// Neues Dokument erzeugen
  $customers = array();
  $customers [] = array(
  'id' => "$id",
  'name' => "$name",
  'street' => "$street",
  'plz' => "$plz",
  'city' => "$city",
  'email' => "$email",
  'phone' => "$phone",
  'web' => "$web"
  ); // Kundendaten
  
  // Create Data
  $doc = new DOMDocument();

  // Existiert schon ein Eintrag dann KEINE neue root node erstellen, nur customer Node anfuegen!
  if ($id >= "0") {

  $doc->formatOutput = true;
  $doc->preserveWhiteSpace = false;
  $doc->load( "$filename" ) or die("Error"); // DOM load
//  $doc->loadXML("$filename") or die("Error"); // DOM loadXML

// get document nodes
$root   = $doc->documentElement;
$fnode  = $root->firstChild;

//add a node
$ori    = $fnode->childNodes->item(0);

// Add Node Content
  foreach( $customers as $customer )
  {
  $b = $doc->createElement( "customer" );
  $b->setAttribute("id", "$id");

  // Name
  $name = $doc->createElement( "name" );
  $name->appendChild(
  $doc->createTextNode( $customer['name'] )
  );
  $b->appendChild( $name );
  
  // Street
  $street = $doc->createElement( "street" );
  $street->appendChild(
  $doc->createTextNode( $customer['street'] )
  );
  $b->appendChild( $street );
    
  // Zip
  $plz = $doc->createElement( "plz" );
  $plz->appendChild(
  $doc->createTextNode( $customer['plz'] )
  );
  $b->appendChild( $plz );
      
  // city
  $city = $doc->createElement( "city" );
  $city->appendChild(
  $doc->createTextNode( $customer['city'] )
  );
  $b->appendChild( $city );
    
  // email
  $email = $doc->createElement( "email" );
  $email->appendChild(
  $doc->createTextNode( $customer['email'] )
  );
  $b->appendChild( $email );
    
  // phone
  $phone = $doc->createElement( "phone" );
  $phone->appendChild(
  $doc->createTextNode( $customer['phone'] )
  );
  $b->appendChild( $phone );
    
  // web
  $web = $doc->createElement( "web" );
  $web->appendChild(
  $doc->createTextNode( $customer['web'] )
  );
  $b->appendChild( $web );


  $fnode->insertBefore($b,$ori);

  } // close foreach
  } else {

  $doc->formatOutput = true;

  // Wurzelknoten
  $datavar = $doc->createElement( "data" );
  $doc->appendChild( $datavar );

  // Erstes Element
  $r = $doc->createElement( "customers" );
  $doc->appendChild( $r );

    foreach( $customers as $customer )
  {
  $b = $doc->createElement( "customer" );
  $b->setAttribute("id", "$id");
  
  // Name
  $name = $doc->createElement( "name" );
  $name->appendChild(
  $doc->createTextNode( $customer['name'] )
  );
  $b->appendChild( $name );
  
  // Street
  $street = $doc->createElement( "street" );
  $street->appendChild(
  $doc->createTextNode( $customer['street'] )
  );
  $b->appendChild( $street );
    
  // Zip
  $plz = $doc->createElement( "plz" );
  $plz->appendChild(
  $doc->createTextNode( $customer['plz'] )
  );
  $b->appendChild( $plz );
      
  // city
  $city = $doc->createElement( "city" );
  $city->appendChild(
  $doc->createTextNode( $customer['city'] )
  );
  $b->appendChild( $city );
    
  // email
  $email = $doc->createElement( "email" );
  $email->appendChild(
  $doc->createTextNode( $customer['email'] )
  );
  $b->appendChild( $email );
    
  // phone
  $phone = $doc->createElement( "phone" );
  $phone->appendChild(
  $doc->createTextNode( $customer['phone'] )
  );
  $b->appendChild( $phone );
    
  // web
  $web = $doc->createElement( "web" );
  $web->appendChild(
  $doc->createTextNode( $customer['web'] )
  );
  $b->appendChild( $web );

  $r->appendChild( $b );
  } // close foreach

  } // close create Data

  // Daten in XML Datei speichern und übergeben
  $doc->saveXML();
  $doc->save("$filename");

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

$idval = $_REQUEST['node']; // 
$userval = $_REQUEST['u'];
$valval = $_REQUEST['val'];

if (empty($idval)) {
  //echo $idval . " ist leer";
} else {
  $val = base64_encode(serialize(md5($idval. $userval)));
  if ($valval != $val) {
  //echo $idval . " ist nicht mehr valide";
  } else {

    // Node löschen

$customers = $doc->getElementsByTagName( "customer" );
foreach( $customers as $customer )
{
  // auslesen der IDDelate
  $idel = $customer->getAttribute( "id" );
  if ("$idel" == $idval) {
    $customer->parentNode->removeChild($customer);
  }
}

  // Daten in XML Datei speichern und übergeben
  $doc->saveXML();
  $doc->save("$filename");

    echo '<meta http-equiv="refresh" content="0; url='.$ready_url.'" />';
  }
}

// head
home_html_start();
home_html_head();

// Sidebar
home_html_sidebar_start();
home_html_menu($s);
require ("inc/admin_menu.php");
home_html_sidebar_stop();

// body & wrap
echo '
  <div id="content">

    <article>

      <header>
        <time datetime=\"2011-04-14\" pubdate>14.April 2011</time>
        <h1>Kunden Verwaltung</h1>
      </header>


';
echo "  <br />";

$customers = $doc->getElementsByTagName( "customer" );

echo "  <ul id='backup_list'>";
foreach( $customers as $customer )
{

  //exaktes auslesen der id (ID-Read)
  $idr = $customer->getAttribute( "id" );
//  $idr = $idr ++;

  $names = $customer->getElementsByTagName( "name" );
  $name = $names->item(0)->nodeValue;
  
  $streets = $customer->getElementsByTagName( "street" );
  $street = $streets->item(0)->nodeValue;
  
  $zips = $customer->getElementsByTagName( "plz" );
  $zip = $zips->item(0)->nodeValue;

  $citys = $customer->getElementsByTagName( "city" );
  $city = $citys->item(0)->nodeValue;

  $emails = $customer->getElementsByTagName( "email" );
  $email = $emails->item(0)->nodeValue;

  $phones = $customer->getElementsByTagName( "phone" );
  $phone = $phones->item(0)->nodeValue;

  $webs = $customer->getElementsByTagName( "web" );
  $web = $webs->item(0)->nodeValue;

  $val = base64_encode(serialize(md5($idr. $name)));  

  echo "
  <li>

<a style='display:inline;float:right;padding:2px 0;margin:0 -4px 0 0;' href='$ready_url?node=$idr&amp;u=$name&amp;val=$val' title='Eintrag l&ouml;schen'><!--l&ouml;schen--> <img src='../img/icons/hex_delete.png' witdh='24' height='24' style='padding:0;margin:0 0 -6px 0;' alt='&#10007;' /></a>

  <b>$idr</b> - $name<br>
  $street - $zip - $city<br>
  <a href='mailto:$email'>$email</a> - $phone\n - <a href='$web'>$web</a>
  </li>\n
  ";
  }
echo "  </ul>";

// body & wrap
print <<<ENDOFTXT
<br />

      <header>
        <time datetime=\"2011-04-14\" pubdate>14.April 2011</time>
        <h1>Neukunden anlegen</h1>
      </header>

    <p></p>

<form name="form1" method="post" action="$return">
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
<td>&nbsp;<input type="hidden" name="id" value="$id"></td>
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
      <p>Variable id : ' . $id . '</p>
    </div>

  </article>
  <div id="clear">&nbsp;</div>
  </div>

ENDOFTXT;

home_html_foot();

// close body & wrap

home_html_stop();

}


?> 
