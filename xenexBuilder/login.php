<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php
  function secured($s)
  {
    $nonAuthorised = array("<",">","(",")","~","|","--","/","\\","$","*","&","[","]","{","}",";");
    $s = str_replace($nonAuthorised, "", $s);
    //echo " traduit en : " . $s . " <br>";
    return $s;
  } 
?>

<html>
  <head>
    <title>Test PHP</title>
    </head>
    <body>
        <div class ="container">
            <h1 class="text-center mt-3">Connexion</h1>

            <form class="mt-5 p-5" style="background-color: hsl(216, 25%, 95.1%);" action="login.php" method="post">
            <div class="form-group row">
                <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Login</label>
                <div class="col-sm-10">
                
                <input type="text" name="login" class="form-control" maxlength="50" id="exampleLogin" aria-describedby="loginlHelp" placeholder="Login">
                    
                <!-- <input type="email" name="login" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Mot de passe</label>
                <div class="col-sm-10">
                <input type="password" name="mdp" class="form-control" maxlength="30" id="inputPassword" placeholder="Mot de passe">
                </div>
            </div>
            <dic class="row justify-content-center">
                <button type="submit" class="btn btn-primary col-sm-2">Connexion</button>
            </div>
            </form>

            <?php 
                //connection securisee
                $mdp = isset($_POST["mdp"]) ? secured($_POST["mdp"]) : '' ;
                $login = isset($_POST["login"]) ? secured($_POST["login"]) : '' ;

                include 'bd_connect.php';
                $nbrRes = compteSQLresult("SELECT * FROM users WHERE login = '{$login}' AND mdp = '{$mdp}'");

                if($nbrRes == 1)
                {
                    printf('<br>Connection réussie');
                    session_start();
                    $_SESSION["id"]=$login;

                    $right = getSQLrequest("SELECT * FROM users WHERE login = '{$login}' AND mdp = '{$mdp}'")[0]["rank"];
                    if($right == 1)
                    {
                        $_SESSION["power"] = "admin";
                        header("Location: accountAdmin.php");
                    }
                    else
                    {
                        $_SESSION["power"] = "utilisateur";
                        header("Location: account.php");
                    }
                    echo '<br>session = ' . $_SESSION["id"];
                }
                else
                {
                    if(isset($_POST["login"]) && isset($_POST["mdp"]))echo '<small id="response" class="form-text text-muted ml-5">Connection refusée</small>';
                }
            ?>
        </div>
    </body>
</html>