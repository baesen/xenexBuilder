<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php
  $nom = '';
  if(isset($_GET["cherchenom"]))$nom = $_GET["cherchenom"];
  secured($nom);
  $origine = '';
  if(isset($_GET["chercheorigine"]))$origine = $_GET["chercheorigine"];
  secured($origine);
  
  function secured($s)
  {
    $nonAuthorised = array("<",">","(",")","~","|","--","/","\\","$","*","&","[","]","{","}",";");
    echo $s;
    $s = str_replace($nonAuthorised, "", $s);
    echo " traduit en : " . $s . " <br>";
  }
?>
<html>
  <head>
    <title>Catalogue</title>
  </head>
  <body>
    <div class ="container">
    <h1 class="text-center">Catalogue</h1>

    <form action="catalogue.php" method="get">

    <div class="row ml-2">
      <div class="col">
        <?= '<input type="text" class="form-control" name="cherchenom" placeholder="nom" value="'. $nom.'">'; ?>
      </div>
      <div class="col">  
        <?= '<input type="text" class="form-control" name="chercheorigine" placeholder="origine" value="' . $origine.'">'; ?>
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

    <?= '<table style=\"border:5px solid black;\">' ?>

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col" ></th>

          <?php
          $redir = '';
          if(isset($_GET["cherchenom"]) && isset($_GET["chercheorigine"]) && isset($_GET["cherchedanger"]))
          {$redir = 'cherchenom='.($_GET["cherchenom"]).'&chercheorigine='.($_GET["chercheorigine"]).'&cherchedanger='.($_GET["cherchedanger"]);}
          echo '<th scope="col" ><a href="catalogue.php?orderby=1&'.$redir.'" class="btn btn-dark" role="button">Nom</a></th>';
          echo '<th scope="col"><a href="catalogue.php?orderby=2&'.$redir.'" class="btn btn-dark" role="button">Origine</a></th>';
          echo '<th scope="col" style="text-align : center"><a href="catalogue.php?orderby=3&'.$redir.'" class="btn btn-dark" role="button">Danger</a></th>'; ?>
          <th scope="col" style="text-align : center"><a class="btn btn-dark">info</a></th>
        </tr>
      </thead>
      <tbody>

      <?php 

        include 'bd_connect.php';
        $by = 'nom';
        if(isset($_GET["orderby"]))
        {
          if($_GET["orderby"] == 1)$by = 'nom';
          else if($_GET["orderby"] == 2)$by = 'origine';
          else if($_GET["orderby"] == 3)$by = 'danger';
        }

        $sql = 'SELECT * FROM monstre WHERE 1=1';
        
        if(isset($_GET["cherchenom"]))
        {
          if($_GET["cherchenom"] != "")
          {
            $sql = $sql.' and nom like \'%'.secured($_GET["cherchenom"]).'%\'';
          }
        }
        if(isset($_GET["chercheorigine"]))
        {
          if($_GET["chercheorigine"] != "")
          {
            $sql = $sql.' and origine=\''.$_GET["chercheorigine"].'\'';
          }
        }
        if(isset($_GET["cherchedanger"]))
        {
          if($_GET["cherchedanger"] != "")
          {
            $sql = $sql.' and danger=\''.$_GET["cherchedanger"].'\'';
          }
        }

        $sql = $sql.' ORDER BY '.$by;

        //echo $sql;

        $result = mysqli_query($conn,$sql);

        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);

        foreach($res as $key => $mob)
        {
          echo '<tr>';
          echo "<th scope = \"row\">{$key}</th>";
    
          echo '<td>'; echo $mob['nom']; echo '</td>';
          echo '<td>'; echo $mob['origine']; echo '</td>';
          echo '<td style="text-align : center">'; echo $mob['danger']; echo '</td>';
          echo '<td style="text-align : center">'; $ref = "info.php?id={$mob['nom']}"; echo "<a href=\"$ref\" class=\"btn btn-light\" role=\"button\">info</a>";
          $ref = "edit.php?id={$mob['nom']}"; echo "<a href=\"$ref\" class=\"btn btn-light\" role=\"button\">🖉</a></td>";
          

          echo '</tr>';
        }

      ?>
    </table>
    <a href="create.php" class="btn btn-primary ml-2 mb-2" role="button">Creer un monstre</a>

  </div>
</html>