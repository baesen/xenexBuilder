<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php
  function secured($s)
  {
    $nonAuthorised = array("<",">","(",")","~","|","--","/","\\","$","*","&","[","]","{","}",";");
    $s = str_replace($nonAuthorised, "", $s);
    //echo " traduit en : " . $s . " <br>";
    return $s;
  } 

  session_start();
  include 'bd_connect.php';
  if(isset($_GET["id"]))
  {
    $nom2 = secured($_GET["id"]);
    $sql = "DELETE FROM decks WHERE owner ='{$_SESSION["id"]}' AND nom='{$nom2}'" ;

    updateSQL($sql);
    header("Location: account.php");
  }
?>