<?php
    include 'bd_connect.php';
    $n = ' '; $danger = 0; $origine = ' '; $description;
    if(isset($_GET["nom"]))
    {
        $n = strtolower($_GET["nom"]);
    }

    if(isset($_GET["id"]))
    {
        $id = strtolower($_GET["id"]);
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

    $sql = "UPDATE monstre SET nom = '{$_GET["newnom"]}', danger = '{$_GET["newdanger"]}', origine = '{$_GET["neworigine"]}', description = '{$_GET["newdescription"]}' WHERE nom='$id'";
    echo $sql;

    if(!$conn->query($sql)) {
        echo "Échec de modification : (" . $conn->errno . ") " . $conn->error;
    }
    else
    {
        echo "Insertion reussi";
    }

    mysqli_close($conn);
    header('Location: catalogue.php');
?>