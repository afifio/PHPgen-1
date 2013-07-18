<?php echo '
<div id="admin-subnav">
  <nav>
    <ul class="adminnav">
      <li class="menufirst"><h3>Seiten</h3></li>
      <li><a href="create.php">Erstellen <img src="../img/icons/new.png" alt="+" /> </a></li>
      <li><a href="edit.php?s='. $s .'">Bearbeiten <img src="../img/icons/edit.png" alt="&#9997;" /> </a></li> 
      <li><a href="remove.php?s='. $s .'">L&ouml;schen <img src="../img/icons/delete.png" alt="&#10007;" /> </a></li>
    </ul>
  </nav>
</div>
<div id="admin-subnav">
  <nav>
    <ul class="adminnav">
      <li class="menufirst"><h3>Einstellungen</h3></li>
      <li><a href="file.php">Dateien <img src="../img/icons/folder.png" alt="&#9920;" /> </a></li>
      <li><a href="plugin.php">Plugins <img src="../img/icons/plugins.png" alt="&#9732;" /> </a></li> 
      <li><a href="theme.php">Aussehen <img src="../img/icons/theme.png" alt="&#9728;" /> </a></li>
    </ul>
  </nav>
</div>
<div id="admin-subnav">
  <nav>
    <ul class="adminnav">
      <li class="menufirst"><h3>Sonstiges</h3></li>
      <li><a href="backup.php">Backup <img src="../img/icons/backup.png" alt="&#9730;" /> </a></li>
      <li><a href="create_customer.php">Kunden <img src="../img/icons/adressbook.png" alt="&#9742;" /> </a></li>
    </ul>
  </nav>
</div>'; ?>
