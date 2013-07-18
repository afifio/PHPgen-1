  <header>
    <div id="headnav"> 
      <ul>
	<?php 

	if (!isset($_SESSION['angemeldet']) || !$_SESSION['angemeldet']) {
	  echo "<li><a href=\"admin/login.php?s=" . $_REQUEST['s'] . "\">Login</a></li>
		";
	} else {
          echo "<li><a href=\"admin/logout.php\">Logout</a></li>";

	}; ?>             

        <li><a href="index.php?s=<?php echo SITE_IMPRINT ?>">§</a></li>
        <li><a href="http://feeds.feedburner.com/exigem" target="_blank" rel="external">RSS</a></li>
        <li><a href="http://feeds.feedburner.com/exigem" target="_blank" rel="external">Atom</a></li>

	<?php 
	if (!isset($_SESSION['angemeldet']) || !$_SESSION['angemeldet']) {
          echo "<li><a href=\"admin/index.php?s=" . $_REQUEST['s'] . "\">Admin</a></li>";
	} else {
	  echo "<li><a href=\"admin/index.php?s=" . $_REQUEST['s'] . "\">Admin</a></li>";

	}; ?> 

        <li><a href=''>Register</a></li>

      </ul>
    </div>
    <a href="index.php?s=<?php echo SITE_DEFAULT ?>"><img src="img/generator_logo_002.png" alt="logo" style="max-height:86px;float:left;" /></a>
    <h1><?php // echo SITE_NAME ?>&nbsp;</h1>
    <h2><?php // echo SITE_TITLE ?>&nbsp;</h2> 
  </header>
