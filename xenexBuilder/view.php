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
      header("location: account.php");
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

        <div class = "row m-3 mt-0 justify-content-center">
            <div class="col-sm-8 pt-5 justify-content-center">
                <div class="container pl-5 pr-5">
                    <?= "<h1 class=\"m-4 mb-5\"><b>{$nom}</b></h1>";?>
                    <div class="card h-50 text-justify mb-5 mt-5">
                        <div class="card-header p-3">
                            <?php 
                                $cardType = $cardInfo['type'];
                                $trad = array("dieu" => "Divinité", "mob" => "Monstre", "sort" => "Sort", "def" => "Défense", "ter" => "Terrain", "chi" => "Chimère", "equi" => "Equipement");
                                $cardType = $trad[$cardType];
                                echo "<h3><b>{$cardType}</b></h3>";
                            ?>
                        </div>
                        <div class="card-body p-3">
                            <?= "<h5>{$cardInfo['effect']}</h5>" ?>
                        </div>
                    </div>
                    <div class="container pt-5">
                        <table class="table text-center">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col"><h4>Type</<h4></th>
                                <th scope="col"><h4>Origine</h4></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php ?>
                                <td><?php $tradType  = array("g" => "Soldat", "m" => "Mort", "f" => "Feu", "e"=>"Eau", "n"=>"Nature", "b"=>"Bestial", "t"=>"Terre", "l"=>"Lumière", "d"=>"Dragon", "a"=>"Air");
                                    echo "<h4>{$tradType[$cardInfo['energies']]}</h4>";
                                ?></td>
                                <td><?= "<h4>{$cardInfo['origine']}</h4>"?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                </div>
            </div>
            <div class="col-sm-4 pt-5 justify-content-center">
                <div class="text-center">
                <?php
                    echo '<div class=\"container-fluid\">';
                        $img = "./pictures/{$cardInfo['id']}.jpg";
                        echo "<img src=\"{$img}\" class=\"img-fluid\" alt=\"Carte {$cardInfo['nom']}\">"; 
                    if($cardInfo['atk'] != -1 && $cardInfo['def'] != -1)
                    {
                        echo '<div class="row mt-3">';
                        echo "<div class=\"col justify-content-center\"><a style=\"border-radius: 50px\" class=\"btn btn-danger float-center pl-3 pr-3 mt-3 mb-3 text-light\"><h1>{$cardInfo['atk']}</h1></a></div>";
                        echo "<div class=\"col justify-content-center\"><a style=\"border-radius: 50px\" class=\"btn btn-info float-center pl-3 pr-3 mt-3 mb-3 text-light\"><h1>{$cardInfo['def']}</h1></a></div>";
                        echo '</div>';
                    }
                        ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>