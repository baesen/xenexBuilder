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
        <div class="p-3 mb-2 bg-dark text-white"></div>
    </header>
    <body>
        <div class ="container">
            <h1 class="text-center mt-4">Editer un monstre</h1>

            <?= '<form action="edit2.php?id='. $id .'&" method="get">';?>

            <div class="form-group">
                <?= '<input type="hidden" class="form-control" name="id" value="'.$id.'">'; ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Nom</label>
                <?php $startentry = '';
                if(isset($id))$startentry = $id;
                echo '<input type="text" class="form-control" name="newnom" placeholder="nom" value="'.$startentry.'">'; ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Origine</label>
                <?php $startentry = '';
                if(isset($origine))$startentry = $origine;
                echo '<input type="text" class="form-control" name="neworigine" placeholder="origine" value="'.$startentry.'">'; ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Danger</label>
                <?php $startentry = '';
                if(isset($danger))$startentry = $danger;
                echo '<input type="text" class="form-control" name="newdanger" placeholder="danger" value="'.$startentry.'">'; ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <?php $startentry = '';
                if(isset($description))$startentry = $description;
                echo '<textarea class="form-control" name="newdescription" rows="3">' . $startentry . '</textarea>'; ?>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </body>
</html>