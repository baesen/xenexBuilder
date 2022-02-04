<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php

  session_start();
  include 'bd_connect.php';

  if(isset($_POST["id"]))
  {
    $deckId = $_POST["id"];
  }
  else
  {
    header("location: login.php");     
  }

  $user = '';
  if(isset($_SESSION["id"]))
  {
      $user = $_SESSION["id"];
  }
  else
  {
      header("location: login.php");
  }
  $request = "SELECT * FROM decks WHERE nom='{$deckId}' AND owner = '$user'";
  //echo $request;
  $deckInfo = getSQLrequest($request)[0];

?>

<html>
<head>
   <title>Export</title>
</head>
<body class="d-flex flex-column mb-5">
    <div class="container justify-content-center pl-5 pr-5">
        <?= "<h1 class=\"m-4 mb-5\"><b>{$deckInfo["nom"]}</b></h1>";?>
        <div class="card h-50 text-justify mb-5 mt-5">
            <div class="card-body p-3">
                <?= "<h5 id=\"myInput\">{$deckInfo['liste']}</h5>" ?>
            </div>
        </div>
    </div>
</body>
</html>