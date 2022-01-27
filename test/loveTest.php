<?php
  $questions = array(
     1 => "Cherchez vous à passer du temps avec elle ?",
     2 => "Etes vous décu de son absence ?",
     3 => "Le fait qu'elle soit là est-il un argument ou critère à votre venue quelque part ?",
     4 => "Seriez vous capable de faire quelque chose uniquement pour lui faire plaisir ?",
     5 => "Si elle souffrait d'un mal, le prendriez-vous à sa place ?",
     6 => "Avez-vous déjà rêvé d'elle ?",
     7 => "Un futur où vous viveriez avec la personne vous plairait ?",
     8 => "Aimez-vous parler d'elle ?",
     9 => "Est-ce que vous parlez beaucoup de cette personne à votre entourage ?",
    10 => "Pensez vous régulièrement à elle ?",
    11 => "Avez-vous le sentiment de ressentir les memes émotions qu'elles, de partager ses colères, tristesses, joies, etc… ?",
    12 => "Seriez vous prêt à changer qlq chose que vous faites pour cette personne ?",
    13 => "Cette personne ou son entourage peut elle se révéler intimidante pour vous ?",
    14 => "Est-ce que vous avez le sentiment qu'elle vous apporte quelque chose, voire qu'elle vous complete ?",
    15 => "Vous n'arrivez pas à chasser sa pensée de votre esprit meme en essayant ?",
    16 => "Diriez vous que cette personne est belle ?",
    17 => "Etes-vous incapable de lui en vouloir réellement ?",
    18 => "Est-ce que vous ressentez un vide apres son départ ?",
    19 => "Diriez-vous que cette personne pourrait profondemment vous blesser si elle le voulait ?",
    20 => "Vous êtes vous déjà arrêter à la regarder elle ou une image d'elle sans être capable de décrocher le regard ?",
    21 => "Avez-vous déjà écrit, dessiné ou créé quelque chose, inspiré par elle ?",
    22 => "Avez-vous tendance à comparer les autres à elle ?",
    23 => "Avez-vous déjà pleurer pour/duFait d'elle ?",
    24 => "Les œuvres de romance vous font-elle penser à elle ?",
    25 => "Est-ce que vous vous inquiéter de ce qu'elle pense de vous ?",
    26 => "Avez-vous tendance à la surrestimer ?",
    27 => "Vous avez tendance à ne pas rire de son malheur ?",
    28 => "Etes vous protecteur avec cette personne, voire parfois trop ?",
    29 => "Cette personne peut être représenter un quelconque interet sensuel ou erotique pour vous ?",
    30 => "Si oui, cette personne ne vous évoque pourtant pas un interet premier sexuel ou libidineux ?"
  );
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<html>
  <head>
    <title>Catalogue</title>
  </head>
  <body><text-center>
    <div class ="container text-center">
    <?php
        if(isset($_GET["qid"]))
        {
          $qid = $_GET["qid"];
        }
        else
        {
          $qid = 0;
        }

        if(isset($_GET["res"]))
        {
          $res = $_GET["res"];
        }
        else
        {
          $res = 0;
        }

        if($qid == 0)
        {
          echo "<h1>Test d'amour</h1><h4><i>Pensez à quelqu'un, répondez aux questions suivantes le plus honnêtement possible</i></h4>";
          echo "<a href=\"loveTest.php?qid=1&res=0\" class=\"btn btn-primary ml-2 mb-2\" role=\"button\">Commencer</a>";
        }
        else if($qid == 31)
        {
          $locate = "loveTestResult.php?res=$res";
          header("Location: {$locate}");
          echo "<a href=\"loveTest.php?qid={$qid}&res={$res}\" class=\"btn btn-primary ml-2 mb-2\" role=\"button\">Terminer</a>";
        }
        else
        {
          echo "<h1 class=\"text-center\">Question {$qid}</h1>";

          echo '<p, class="container" style="margin-bottom:300px">'.$questions[$qid].'</p>';
          ?>

          <table class="table">
            <thead class="thead-light">
              <tr>
                <?php
                  echo '<th scope="col" style="text-align : center">Pas du tout</th>';
                  echo '<th scope="col" style="text-align : center">Non</th>';
                  echo '<th scope="col" style="text-align : center">Peut être</th>';
                  echo '<th scope="col" style="text-align : center">Oui</th>';
                  echo '<th scope="col" style="text-align : center">Enormement</th>';
                ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                  echo "<th scope=\"col\" style=\"text-align : center\"><a class=\"btn btn-light p-5\" a href=\"loveTest.php?qid=".($qid+1)."&res=".($res-2)."\"></a></th>";
                  echo "<th scope=\"col\" style=\"text-align : center\"><a class=\"btn btn-light p-5\" a href=\"loveTest.php?qid=".($qid+1)."&res=".($res-1)."\"></a></th>";
                  echo "<th scope=\"col\" style=\"text-align : center\"><a class=\"btn btn-light p-5\" a href=\"loveTest.php?qid=".($qid+1)."&res=".($res)."\"></a></th>";
                  echo "<th scope=\"col\" style=\"text-align : center\"><a class=\"btn btn-light p-5\" a href=\"loveTest.php?qid=".($qid+1)."&res=".($res+1)."\"></a></th>";
                  echo "<th scope=\"col\" style=\"text-align : center\"><a class=\"btn btn-light p-5\" a href=\"loveTest.php?qid=".($qid+1)."&res=".($res+2)."\"></a></th>";
                ?>
              </tr>
            </tbody>
          </table>
          
          
          <?php
          $qid++;
          //echo "<a href=\"loveTest.php?qid={$qid}&res={$res}\" class=\"btn btn-primary ml-2 mb-2\" role=\"button\">Valider</a>";
        }
        ?>
    </div>
  </body>
</html>