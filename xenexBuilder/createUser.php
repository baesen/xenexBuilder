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

  $user = '';
  if(isset($_SESSION["id"]) && isset($_SESSION["power"]) && $_SESSION["power"] == "admin")
  {
      $user = $_SESSION["id"];
  }
  else
  {
      header("location: login.php");
  }

  if(isset($_POST["login"]) && isset($_POST["mdp"]))
  {
    $login = secured($_POST["login"]); $mdp = secured($_POST["mdp"]);
    $sql = "INSERT INTO users(login, mdp, rank) values ('{$login}','{$mdp}',2)" ;

    $selectSQL = "SELECT * FROM users WHERE login = '{$login}'";
    insertCommand($sql, $selectSQL);
    $ref = "accountAdmin.php";
    header("Location: {$ref}");
  }
?>

<html>
  <head>
    <title>Créer Utilisateur</title>
    </head>
    <body>
        <div class ="container">
            <h1 class="text-center mt-3 pt-3">Créer Utilisateur</h1>

            <form class="mt-5 p-5" style="background-color: hsl(216, 25%, 95.1%);" action="createUser.php" method="post">
            <div class="form-group row text-center">
                <div class="col-sm-12 m-2">
                    <input type="text" name="login" class="form-control" id="inputName" placeholder="Login">
                </div>
                <div class="col-sm-12 m-2">
                    <input type="text" name="mdp" class="form-control" id="inputName" placeholder="Mot de passe">
                </div>
                <div class="col-sm-12 m-3">
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </div>
        </div>
    </body>
</html>