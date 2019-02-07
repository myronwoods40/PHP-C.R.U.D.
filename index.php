<!--Myron Woods-->
<!DOCTYPE html>
<html><head>
<title>User Account Manager</title> 
</head>
<body style='background-color:white'>
<h1 style='color:green'>User Account Manager</h1>
<b>User Accounts:</b>

<table border=1 cellpadding="5" cellspacing="2">
<tr>
   <th>Username</th>
   <th>Email</th>
   <th>Password</th>
</tr>
<?php
    try {
        include("loaddb.php");

        $query = "Select * From ACCOUNTS";
        if ($result = mysqli_query($con,$query)) {
            while ($row = mysqli_fetch_row($result)) {
                echo "<tr>\n" .
                    "<td><a href='view.php?userid=". $row[0] . "'>" . $row[1] ."</td>\n".
                    "<td>".$row[2] ."</td>\n".
                    "<td>".$row[3] ."</td>\n".
                    "<td> <a href='edit.php?userid=". $row[0] . "'>Edit</a> " .
                    " / <a href='delete.php?userid=". $row[0] . "'>Delete</a> </td>" .
                    "</tr>\n";
            } 
            
            /* free result set */
            mysqli_free_result($result);
        }

    } catch (Exception $e) {
        echo "Caught exception ", $e->getMessage(), "<br />";
    } finally {
        mysqli_close($con);
    }
?>
</table>

<form method="post" action="add.php">
<p><input type="submit" value="Add Account" /></p>
</form>
</body></html>
