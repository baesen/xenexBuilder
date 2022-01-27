<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<html>
  <head>
    <title>Resultats</title>
  </head>
  <body><text-center>
    <div class ="container text-center">
    <?php
        if(isset($_GET["res"]))
        {
          $res = $_GET["res"];
        }
        else
        {
          $res = 0;
        }
        echo "<h1>Resultat du test</h1><h4><i>Vous avez obtenu le score de {$res} points </i></h4>";
        echo "<h4>Avec cette personne vous ressentez : </h4>";
        if($res < -25){echo "<div class=\"text-center\"><h2><b>Rejet</b></h2></div>";}
        else if($res < -10){echo "<div class=\"text-center\"><h2><b>Rien</b></h2></div>";}
        else if($res < 10){echo "<div class=\"text-center\"><h2><b>Neutre</b></h2></div>";}
        else if($res < 25){echo "<div class=\"text-center\"><h2><b>Ancienne ou faible tension</b></h2></div>";}
        else if($res < 35){echo "<div class=\"text-center\"><h2><b>Tension et questions</b></h2></div>";}
        else if($res < 45){echo "<div class=\"text-center\"><h2><b>Amour</b></h2></div>";}
        else{echo "<div class=\"text-center\"><h2><b>Amour fou</b></h2></div>";}

        echo "<a href=\"loveTest.php?\" class=\"btn btn-primary ml-2 mb-2\" role=\"button\">Faire un nouveau test</a>";
        ?>
    </div>
  </body>
</html>