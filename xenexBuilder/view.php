<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php

  session_start();
  include 'bd_connect.php';
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

  $card = '';
  if(isset($_GET["id"]))
  {
      $card = $_GET["id"];
  }
  else
  {
      header("location: login.php");
  }
  $request = "SELECT * FROM cards WHERE id='{$card}'";
  $cardInfo = getSQLrequest($request)[0];

?>

<html>
<head>
   <title>Description</title>
</head>
<body class="d-flex flex-column mb-5">
    <div class ="container-float">
        <?php $nom = $cardInfo['nom']; ?>

        <div class = "row m-3 pt-4 justify-content-center">
            <div class="col-sm-8 justify-content-center">
                <?= "<h1 class=\"ml-3 mt-3\"><u>{$nom}</u></h1>";?>
            </div>
            <div class="col-sm-4 justify-content-center">
                <div class="text-center">
                <?php
                    echo '<div class=\"container\">';
                        $img = "./pictures/{$cardInfo['id']}.jpg";
                        echo "<img src=\"{$img}\" class=\"rounded\" alt=\"Carte {$cardInfo['nom']}\">"; 
                    echo '</div><div class=\"container\">';
                        echo "<a style=\"border-radius: 50px;\" class=\"btn btn-danger float-left pl-3 pr-3 m-5 text-light\"><h1>{$cardInfo['atk']}</h1></a>";
                        echo "<a style=\"border-radius: 50px;\" class=\"btn btn-info float-right pl-3 pr-3 m-5 text-light\"><h1>{$cardInfo['def']}</h1></a>";
                ?>
                    </div>;
                </div>
            </div>
        </div>
    </div>
</body>
</html>