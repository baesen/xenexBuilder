<?php
    include 'bd_connect.php';
    $n = ' '; $danger = 0; $origine = ' '; $description;
    if(isset($_GET["nom"]))
    {
        $n = strtolower($_GET["nom"]);
    }

    if(isset($_GET["origine"]))
    {
        $origine = strtolower($_GET["origine"]);
    }

    if(isset($_GET["danger"]))
    {
        $danger = $_GET["danger"];
    }
    if($danger > 5)$danger = 5;
    if($danger < 1)$danger = 1;

    if(isset($_GET["description"]))
    {
        $description = $_GET["description"];
    }

    $sql1 = "SELECT * FROM monstre WHERE nom ='{$_GET["nom"]}'";

    $rowcount = 0;
    if ($result=mysqli_query($conn,$sql1))
    {
        // Return the number of rows in result set
        $rowcount=mysqli_num_rows($result);
        //printf("Result set has %d rows.\n",$rowcount);
        // Free result set
        mysqli_free_result($result);
    }
    else
    {
        echo "Échec de comptage : (" . $conn->errno . ") " . $conn->error;
    }
    

    $sql = "INSERT INTO monstre(nom, origine, danger, description) values('{$n}', '{$origine}', {$danger}, '{$description}')";
    //echo $sql;
    //$result = mysqli_query($conn,$sql);
    echo $rowcount;
    if($rowcount == 0)
    {
        if(!$conn->query($sql)) {
            echo "Échec d'insertion : (" . $conn->errno . ") " . $conn->error;
        }
        else
        {
            echo "Insertion reussi";
        }
    }
    else
    {
        echo "Déjà dans la base";
    }

    mysqli_close($conn);
    header('Location: catalogue.php');
?>