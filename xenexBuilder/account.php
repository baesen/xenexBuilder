<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php

  session_start();
  function ($s)
  {
    $nonAuthorised = array("<",">","(",")","~","|","--","/","\\","$","*","&","[","]","{","}",";");
    $s = str_replace($nonAuthorised, "", $s);
    //echo " traduit en : " . $s . " <br>";
    return $s;
  };

  if(isset($_POST["action"]))
  {
    if($_POST["action"] == "déconnexion")disconnect();
  }

  function disconnect()
  {
    echo 'DECONNECTION';
    unset($_SESSION["id"]);
    header("location: login.php");
  };

  $user = '';
  if(isset($_SESSION["id"]))
  {
      $user = $_SESSION["id"];
  }
  else
  {
      header("location: login.php");
  }

?>

<html>
  <head>
   <title>Compte</title>
  </head>
  <body class="d-flex flex-column mb-5">
    <div class ="container">
          <?php 
              echo "<h1 class=\"ml-3 mt-3\">{$user}</h1>";
          ?>
      </div>

          <div class="container mt-5 p-5 align-center">
            <form action="account.php mt-5" method="post">
              <input type="submit" class="btn-primary" value="déconnexion" name="action"/>
            </form>
          </div>
      </div>
  </body>
</html>