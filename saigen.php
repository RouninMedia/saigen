<?php

  //=================//
 // ERROR REPORTING //
//=================//

    error_reporting(E_ALL);
    ini_set('display_errors', 1);



echo '<!DOCTYPE html>

<html lang="en-GB">
<head>
<meta charset="utf-8">
<title>Saigen by Rounin Media</title>
<meta name="viewport" content="initial-scale=1.0" />
</head>

<body>

<form class="saigen" method="post" action="https://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'?saigen=true">

<h1 class="saigenHeading">Saigen by Rounin Media</h1>

<input type="submit" class="startLinkSubmit" value="Backup all files" />
';


if ((isset($_GET['saigen'])) && ($_GET['saigen'] === 'true')) {

  $Skip_Folders = array('.', '..', 'index.php', 'page.json');

  $FilePath = $_SERVER['DOCUMENT_ROOT'].'/.assets/content/pages/nail-products/';

  $Subfolders = scandir($FilePath);

  echo '<ol>';

  for ($i = 0; $i < count($Subfolders); $i++) {

    if (in_array($Subfolders[$i], $Skip_Folders)) continue;

    $SubFilePath = $FilePath.'/'.$Subfolders[$i];
    $SubSubfolders = scandir($SubFilePath);

    for ($j = 0; $j < count($SubSubfolders); $j++) {

      if (in_array($SubSubfolders[$j], $Skip_Folders)) continue;
      
      /* OPTIONAL - DELETE EARLIER BACKUP */
      /*
      if (file_exists($_SERVER['DOCUMENT_ROOT'].'/.assets/content/pages/nail-products/'.$Subfolders[$i].'/'.$SubSubfolders[$j].'/BACKUP_page.json')) {
        unlink($_SERVER['DOCUMENT_ROOT'].'/.assets/content/pages/nail-products/'.$Subfolders[$i].'/'.$SubSubfolders[$j].'/BACKUP_page.json');
      }
      */

      $File_To_Backup = $_SERVER['DOCUMENT_ROOT'].'/.assets/content/pages/nail-products/'.$Subfolders[$i].'/'.$SubSubfolders[$j].'/page.json';
      $Backed_Up_File = $_SERVER['DOCUMENT_ROOT'].'/.assets/content/pages/nail-products/'.$Subfolders[$i].'/'.$SubSubfolders[$j].'/BACKUP2_page.json';

      copy($File_To_Backup, $Backed_Up_File);

      echo '<li><strong>Backed up:</strong> <em>https://'.$_SERVER['HTTP_HOST'].'/.assets/content/pages/nail-products/'.$Subfolders[$i].'/'.$SubSubfolders[$j].'/page.json</em></li>';
    }
  }

  echo '</ol>';

  echo '<p><strong>Saigen</strong> has run. All files are now backed up.</p>';

}


echo '</form>

</body>
</html>';

?>
