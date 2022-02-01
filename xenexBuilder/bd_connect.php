<?php 

    //connection to the base
    $conn = mysqli_connect('localhost','root','','xenex');

    if($conn === false)
    {
        die("connection error");
    }

    function getSQLrequest($sql)
    {
        $conn = mysqli_connect('localhost','root','','xenex');
        $result = mysqli_query($conn,$sql);

        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);

        return $res;
    }

    function compteSQLresult($sql)
    {
        //printf("sql = " . $sql . \n);
        $conn = mysqli_connect('localhost','root','','xenex');
        if ($result=mysqli_query($conn,$sql))
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
        return $rowcount;
    }

    function insertCommand($sql, $selectSQL)
    {
        $conn = mysqli_connect('localhost','root','','xenex');
        $rowcount = compteSQLresult($selectSQL);
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
    }

    function updateSQL($sql)
    {
        $conn = mysqli_connect('localhost','root','','xenex');
        if(!$conn->query($sql)) {
            echo "Échec d'update : (" . $conn->errno . ") " . $conn->error;
        }
        else
        {
            echo "Update reussi";
        }
        mysqli_close($conn);
    }

?>