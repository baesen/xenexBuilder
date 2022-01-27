<?php
    include 'bd_connect.php';
    $by = 'nom';
    if(isset($_GET["orderby"]))
    {
      if($_GET["orderby"] == 1)$by = 'nom';
      else if($_GET["orderby"] == 2)$by = 'origine';
      else if($_GET["orderby"] == 3)$by = 'danger';
    }

    $sql = 'SELECT * FROM monstre WHERE nom=\'' . $_GET["id"] . '\'';
    $result = mysqli_query($conn,$sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);

    foreach($rows as $res)
    {
        $id = $_GET["id"];
        $description = $res['description'];
        $danger = $res['danger'];
        $origine = $res['origine'];
        $dangertext = '';
    }
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<html>
    <head>
        <title>Monstropedia</title>
    </head>
    <header>
    <div class="d-flex bg-dark text-white pt-2 pb-2 mb-3 justify-content-center">
        <h3>Fiche du monstre</h3>
    </div>
    </header>
    <body>
        <div class ="flex-container mr-3 ml-3">
            <div class="row">
                <div class="col w-50">
                    <?= '<h2 class="text-center mb-3"><u>'. $id .'</u></h2>' ?>
                    <blockquote class="blockquote text-center ml-2">
                        <?php echo '<p class="text-justify mb-0 mb-5">' . $description . '</p>';?>
                    </blockquote>
                </div>
                <div class="col w-50 mr-3 text-center">
                    <div class="container bg-dark w-100 h-100 pr-1 pl-1 pt-1 pb-1">
                        <?php
                        //echo 'src="./pictures/'.$_GET["id"].'.jpg"';
                        echo '<img src="./pictures/'. $id .'.jpg" class="img-fluid w-100 h-100" alt="Pas d\'image">' ?>
                    </div>
                </div>
            </div>
            <?php 
                if     ($danger == 1){$dangertext = "inoffensif";}
                else if($danger == 2){$dangertext = "danger humain";}
                else if($danger == 3){$dangertext = "danger mortel";}
                else if($danger == 4){$dangertext = "danger regionnal";}
                else if($danger == 5){$dangertext = "danger continental";}
                echo '<p class="lead mt-3 text-center"><b>Danger : </b>' . $dangertext . '</p>';
                echo '<div class="text-right mr-2 mb-2">';
                echo "<a href=\"edit.php?id={$id}\" class=\"btn btn-primary\" role=\"button\">🖉</a></td>";
                echo '</div>';
            ?>
    </body>
</html>
