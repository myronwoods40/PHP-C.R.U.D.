<!--Myron Woods-->
<?php
    try {
        $con = mysqli_connect("localhost", "root", "dog");
        if (!$con) {
            exit("Error: " . mysqli_connect_error() );
        }

        $query = "Create Database USERDB";

        // Create Database query doesn't return a resultset 
        if (mysqli_query($con, $query) === TRUE) {
           // print("<br />Database successfully created.<br />");
        }

        $db_selected = mysqli_select_db($con, "USERDB");
        if (!$db_selected){
            exit("<br />Error: Can\'t access USERDB: " . mysqli_error($con));
        }

        $query = 
            "Create Table ACCOUNTS (
                Id INT NOT NULL AUTO_INCREMENT,
                Username TEXT,
                Email TEXT,
                Password TEXT,
                PRIMARY KEY (Id)
             )";

        // Create table query doesn't return a resultset 
        if (mysqli_query($con, $query) === TRUE) {
          //  print("<br>ACCOUNTS table successfully created.<br>");
        }
    } catch (Exception $e) {
        echo "Caught exception ", $e->getMessage(), "<br />";
    }
?>