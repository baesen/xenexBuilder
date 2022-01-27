<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<html>
  <head>
    <title>Test PHP</title>
    </head>
    <body>
        <div class ="container">
            <h1 class="text-center">Creer un monstre</h1>

            <form action="create2.php" method="get">

            <div class="form-group">
                <label for="exampleInputPassword1">Nom</label>
                <input type="text" class="form-control" name="nom" placeholder="Dragon, Licorne, Goblin, etc...">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Origine</label>
                <input type="text" class="form-control" name="origine" placeholder="Grec, Nordique, Japonais, etc...">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Danger</label>
                <input type="number" class="form-control" name="danger" placeholder="[1...5]">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </body>
</html>