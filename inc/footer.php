<?php
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
?>
