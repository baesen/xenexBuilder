<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php

    session_start();
    include 'bd_connect.php';

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
    $chercheNom = ''; $chercheOrigine = ''; $chercheType = '';
    if(isset($_GET["cherchenom"]))$chercheNom = secured($_GET["cherchenom"]);
    if(isset($_GET["chercheOrigine"]))$chercheOrigine = secured($_GET["chercheOrigine"]);
    $addr = "edit.php?id={$deckId}&cherchenom={$chercheNom}&chercheOrigine={$chercheOrigine}&chercheType={$chercheType}";
    $sql2 = "SELECT * FROM decks WHERE nom='{$deckId}' AND owner='{$user}'";

  
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
    
    //echo $sql2;
    $listeIDnonSepares = (getSQLrequest($sql2)); 
    //print_r ($listeIDnonSepares);
    $deckList = array();
    $deckListID = array();
    //foreach($listeIDnonSepares as $key => $IdOfCard)
    //echo $listeIDnonSepares['id'];
    $countLines = 0;
    if(count($listeIDnonSepares) != 0)
    {
        $deckListID = explode(':', $listeIDnonSepares[0]['liste']);
        $deckList = genererDeckList($deckListID);
        $countLines = (count($deckListID)-1);
    }

    

    if(isset($_GET["action"]))
    {
      if(substr($_GET["action"], 0, 2) == "rm")
      {
          remove(substr(($_GET["action"]), 2), $listeIDnonSepares, $user, $deckId, $addr);
      }
      else if(substr($_GET["action"], 0, 3) == "add")
      {
          adding(substr(($_GET["action"]), 3), $listeIDnonSepares, $user, $deckId, $addr);
      }
      else if(substr($_GET["action"], 0, 3) == "del")
      {
            $cardName = substr(($_GET["action"]), 3);
            $request = "SELECT * FROM cards WHERE nom='{$cardName}'";
            $res = getSQLrequest($request)[0]['id'];
            $addr2 = $addr . '&action=rm' . $res;
            remove($res, $listeIDnonSepares, $user, $deckId, $addr);
      } 
    }
  
    function remove($cardToDelete, $listeIDnonSepares, $user, $deckId, $addr)
    {
        if(strpos($listeIDnonSepares[0]['liste'], $cardToDelete) !== false && (substr_count($listeIDnonSepares[0]['liste'],':') < 20))
        {
            echo "DELETE de {$cardToDelete}";
            $toReplace = ":{$cardToDelete}";
            $liste = str_replace($toReplace, "", $listeIDnonSepares[0]['liste']);
            updateDeck($liste, $user, $deckId, $addr);
        }
        else
        {
            echo "{$cardToDelete} n'est pas dans le deck";
        }
    }
  
    function adding($cardToAdd, $listeIDnonSepares, $user, $deckId, $addr)
    {
        if(strpos($listeIDnonSepares[0]['liste'], $cardToAdd) !== true)
        {
            echo "ADD de {$cardToAdd}";
            $liste = $listeIDnonSepares[0]['liste'] . ":{$cardToAdd}";
            updateDeck($liste, $user, $deckId, $addr);
        }
        else
        {
            echo "{$cardToAdd} est déjà dans le deck";
        }
    }

    function updateDeck($liste, $user, $deckId, $addr)
    {
        $countLines = substr_count($liste,':');
        $request = "UPDATE decks SET liste = '{$liste}', nb = {$countLines} WHERE owner = '{$user}' AND nom = '{$deckId}' ";
        //echo "UPDATE par {$liste} -> {$request}";
        updateSQL($request);
        echo "UPDATE : location: {$addr}";
        header("location: {$addr}");
    }
    
    function genererDeckList($listeID)
    {
        $res = array();
        //print_r($listeID);
        foreach($listeID as $key => $code)
        {
            $sqltmp = "SELECT * FROM cards WHERE id = '{$code}'";
            //echo $sqltmp;
            $tmp = getSQLrequest($sqltmp);
            //echo '<br><br>';
            //print_r($tmp);
            $name = '';
            $carte = getSQLrequest($sqltmp);
            if(count($carte) != 0)
            {
                $name = $carte[0]['nom'];
                array_push($res, $name);
            }
        }
        return $res;
    };
?>

<html>
<head>
   <title>Edition</title>
</head>
<body class="d-flex flex-column mb-5 mt-5">
    <div class ="container-fluid pl-5 pr-5">
        <div class="row">
            
            <div class = "col-sm-8 pl-3 pr-3 mr-2"> 
                <?php //search ?>   
                <div class = "container-fluid mt-3 mb-5 pt-3 bg-light" style="border-radius:10px">
                    <div class = "row m-1 justify-content-center">
                        <div class="col-sm-10">
                            <form action="edit.php" method="get">

                            <?= "<input type=\"hidden\" name=\"id\" value=\"{$deckId}\">" ?>
                                <div class="row ml-2">
                                    <div class="col">
                                        <?= '<input type="text" class="form-control" name="cherchenom" placeholder="nom" value="'. $chercheNom .'">'; ?>
                                    </div>
                                    <div class="col">
                                    <select id="inputState" name="chercheOrigine" class="form-control">
                                        <option selected></option>
                                        <option>Grec</option>
                                        <option>Nordique</option>
                                        <option>Egyptien</option>
                                        <option>Maya</option>
                                        <option>Sumerien</option>
                                        <option>Chinois</option>
                                        <option>Japonais</option>
                                        <option>Romain</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select id="inputState" name="chercheType" class="form-control">
                                        <option selected></option>
                                        <option>Feu</option>
                                        <option>Eau</option>
                                        <option>Air</option>
                                        <option>Nature</option>
                                        <option>Terre</option>
                                        <option>Mort</option>
                                        <option>Bestial</option>
                                        <option>Guerrier</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-dark">Chercher</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <?php
                $sql = "SELECT * FROM cards WHERE 1=1";
                if(isset($_GET["cherchenom"])){$sql = $sql . " AND nom LIKE '%{$chercheNom}%'";}
                if(isset($_GET["chercheOrigine"])){$sql = $sql . " AND origine LIKE '%{$chercheOrigine}%'";}
                if(isset($_GET["chercheType"]))
                {
                    $type = '';
                    $typeLong = $_GET["chercheType"];
                    if($typeLong == 'Feu'){$type = 'f';}
                    else if($typeLong == 'Eau'){$type = 'e';}
                    else if($typeLong == 'Air'){$type = 'a';}
                    else if($typeLong == 'Nature'){$type = 'n';}
                    else if($typeLong == 'Mort'){$type = 'm';}
                    else if($typeLong == 'Bestial'){$type = 'b';}
                    else if($typeLong == 'Guerrier'){$type = 'g';}
                    else if($typeLong == 'Terre'){$type = 'p';}
                    $sql = $sql . " AND energies LIKE '%{$type}%'";
                }
                //echo $sql;
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
                                <h5 class="card-title">' . $cards['nom'] .'</h5>';
                                echo "<a href=\"view.php?id={$cards['id']}\" style=\"border-radius: 50px;\" class=\"btn btn-info float-right pl-3 pr-3 ml-3\" target=\"_blank\">i</a>";
                                if(in_array($cards["id"], $deckListID))
                                {
                                    $addr2 = $addr . '&action=rm' . $cards["id"];
                                    echo "<a href=\"{$addr2}\" style=\"border-radius: 50px;\" class=\"btn btn-success float-left justify-content-center pl-5 pr-5\">-</a>";
                                }
                                else
                                {
                                    $addr2 = $addr . '&action=add' . $cards["id"];
                                    echo "<a href=\"{$addr2}\" style=\"border-radius: 50px;\" class=\"btn btn-primary float-left justify-content-center pr-5 pl-5\">+</a>";
                                }
                            echo '</div>
                        </div>
                    </div>';
                }
                ?>
                </div>
            </div>

            <div class="col-sm-3 mb-3 bg-dark mt-3 ml-5 pl-3 pt-3 pb-3 float-right">
                <?php echo '
                    <div class="card bg-dark">
                    <div class="card-header text-light text-center mb-3">
                    <h2>' . $deckId . '</h2>
                    <h3 class = "float-right">' . $countLines . ' / 20</h3>
                    </div>
                    <ul class="list-group list-group-flush">';
                    $lines = 0;
                    //print_r($deckList);
                    foreach($deckList as $key => $card)
                    {
                        echo "<li class=\"list-group-item mb-1 mt-1 pr-3 text-center lead\"><b>{$card}</b>";
                        $addr2 = $addr . '&action=del' . $card;
                        echo "<a href=\"{$addr2}\" class=\"btn btn-danger float-right justify-content-center\">✘</a>
                        </li>";
                        $lines++;
                    }
                    for(;$lines < 20 ; ++$lines)
                    {
                        echo "<li class=\"list-group-item mb-1 mt-1 bg-secondary text-center text-white\">?</li>";
                    }                       
                    echo '</ul></div>'; 
                ?>
            </div>
        </div>
    </div>
</body>
</html>