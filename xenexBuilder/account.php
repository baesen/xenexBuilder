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
        <?= "<h1 class=\"ml-3 mt-3\">{$user}</h1>";?>

        <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col" ></th>
            <?php
                $redir = '';
                if(isset($_GET["cherchenom"]) && isset($_GET["cherchenbr"]))
                {$redir = 'cherchenom='.($_GET["cherchenom"]) . '&chercheorigine=' . ($_GET["chercheorigine"]); }
                echo '<th scope="col" ><a href="account.php?orderby=1&' . $redir . '" class="btn btn-dark" role="button">Nom</a></th>';
                echo '<th scope="col" style="text-align : center"><a href="account.php?orderby=2&' . $redir . '" class="btn btn-dark" role="button">Nombre</a></th>';
                echo '<th scope="col" style="text-align : center"><a class="btn btn-dark">Edit</a></th>';
                echo '</thead><tbody>';

                $sql = 'SELECT * FROM decks WHERE owner = \'' . $user . '\'';

                $by = 'nom';
                if(isset($_GET["orderby"]))
                {
                    if($_GET["orderby"] == 1)$by = 'nom';
                    else if($_GET["orderby"] == 2)$by = 'nb';
                }
        
                if(isset($_GET["cherchenom"]))
                {
                    if($_GET["cherchenom"] != "")
                    {
                        $sql = $sql.' and nom like \'%'.secured($_GET["cherchenom"]).'%\'';
                    }
                }

                $sql = $sql . ' ORDER BY ' . $by;
                $res = getSQLrequest($sql);

                foreach($res as $key => $deck)
                {
                    echo '<tr>';
                    echo "<th scope = \"row\">{$key}</th>";
    
                    echo '<td>' . $deck['nom'] . '</td>';
                   echo '<td style="text-align : center">' . $deck['nb'] . ' / 40</td>';
                   $ref = "edit.php?id={$deck['nom']}";
                   echo "<td style=\"text-align : center\"><a href=\"$ref\" class=\"btn btn-light\" role=\"button\">🖉</a></td>";
                   echo '</tr>';
                }
                echo '</tbody></table>'
            ?>
        </tr>
    </div>
    <div class="container mt-5 p-5 align-center">
        <div class="form-group row">
            <div class="col-sm-9">
                <form action="account.php" method="post">
                    <input type="submit" class="btn-primary pt-1 pb-1 pl-2 pr-2" value="déconnexion" name="action"/>
                </form>
            </div>
            <div class="col-sm-3">
                <form action="createDeck.php" method="post">
                    <input type="submit" class="btn-primary pt-1 pb-1 pl-2 pr-2" value="Nouveau" name="action"/>
                </form>
            </div>
        </div>
    </div>
</body>
</html>