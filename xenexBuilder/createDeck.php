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
  if(isset($_POST["nom"]))
  {
    $nom2 = secured($_POST["nom"]);
    $sql = "insert into decks(owner, nom, liste, nb) values ('{$_SESSION["id"]}','{$nom2}','',0)" ;

    $selectSQL = "SELECT * FROM decks WHERE owner = '{$_SESSION["id"]}' AND nom = '{$nom2}'";
    insertCommand($sql, $selectSQL);
    $ref = "edit.php?id={$nom2}";
    header("Location: {$ref}");
  }
?>

<html>
  <head>
    <title>Créer Deck</title>
    </head>
    <body>
        <div class ="container">
            <h1 class="text-center mt-3 pt-3">Créer Deck</h1>

            <form class="mt-5 p-5" style="background-color: hsl(216, 25%, 95.1%);" action="createDeck.php" method="post">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="nom" class="form-control" id="inputName" maxlength="10" placeholder="Nom">
                </div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </div>
        </div>
    </body>
</html>