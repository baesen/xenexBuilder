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

  function secured($s)
  {
    $nonAuthorised = array("<",">","(",")","~","|","--","/","\\","$","*","&","[","]","{","}",";");
    $s = str_replace($nonAuthorised, "", $s);
    //echo " traduit en : " . $s . " <br>";
    return $s;
  };

  $user = '';
  $deckId = -1;
  if(isset($_SESSION["id"]) && isset($_GET["id"]))
  {
        $user = $_SESSION["id"];
        $deckId = $_GET["id"];
  }
  else
  {
      header("location: login.php");
  }
  $chercheNom = ''; $chercheOrigine = '';
  if(isset($_GET["cherchenom"]))$chercheNom = secured($_GET["cherchenom"]);
  if(isset($_GET["chercheorigine"]))$chercheOrigine = secured($_GET["chercheorigine"]);
  
?>

<html>
<head>
   <title>Compte</title>
</head>
<body class="d-flex flex-column mb-5">
    <div class ="container">

        <div class = "container mt-3 mb-3">
            <form action="edit.php" method="get">

            <?= "<input type=\"hidden\" name=\"id\" value=\"{$deckId}\">" ?>
            <div class="row ml-2">
            <div class="col">
                <?= '<input type="text" class="form-control" name="cherchenom" placeholder="nom" value="'. $chercheNom .'">'; ?>
            </div>
            <div class="col">  
                <?= '<input type="text" class="form-control" name="chercheorigine" placeholder="origine" value="' . $chercheOrigine.'">'; ?>
            </div>
            <div class="col">
                <select id="inputState" name="cherchedanger" class="form-control">
                <option selected></option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-dark">Chercher</button>
            </div>
            </div>
            </form>
        </div>

        <?php echo "<h1 class=\"ml-3 mt-3\">{$deckId}</h1>";
        $sql = "SELECT * FROM cards WHERE 1=1";
        if(isset($_GET["cherchenom"])){$sql = $sql . " AND nom LIKE '%{$chercheNom}%'";}
        $res = getSQLrequest($sql);
        echo '<div class="row">';
        foreach($res as $key => $cards)
        {
            $img = "./pictures/{$cards['id']}.jpg";
            echo '
            <div class="col-sm-3 mb-3">
                <div class="card">
                <img class="card-img-top" src="'. $img .'" alt="Carte ' . $cards['nom'] .'">
                    <div class="card-body">
                        <h5 class="card-title">' . $cards['nom'] .'</h5>
                        <a href="#!" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>';
        }
        ?>
        </div>
    </div>
</body>
</html>