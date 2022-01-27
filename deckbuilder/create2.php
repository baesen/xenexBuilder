<?php
    include 'bd_connect.php';
    $n = ' '; $creator = ' ';
    if(isset($_GET["nom"]))
    {
        $n = $_GET["nom"];
    }

    if(isset($_GET["maker"]))
    {
        $creator = $_GET["maker"];
    }

    $sql = "SELECT max(did) from decks";
    if(!$conn->query($sql)) {
        echo "Échec d'insertion : (" . $conn->errno . ") " . $conn->error;
    }

    $result = mysqli_query($conn,$sql);

    $id = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);


    $sql = "INSERT INTO decks(nom, list, creator) values('{$n}', '', '{$creator}')";
    echo $sql;
    
    if(!$conn->query($sql)) {
        echo "Échec d'insertion : (" . $conn->errno . ") " . $conn->error;
    }

    mysqli_close($conn);
    header('Location: editDeck.php?deck={$id}');
?>