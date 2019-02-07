<!--Myron Woods-->
<!DOCTYPE html>
<html><head>
<title>User Account Manager</title> 
</head>
<body style='background-color:white'>
<h1 style='color:green'>User Account Manager</h1>

<?php
    try {
        include("loaddb.php");

        if ( isset($_POST['return']) ) {
            header( 'Location: index.php' ) ;
            exit;
        }
        
        if ( !isset($_GET['userid']) ) {
            echo "<h2 style='color:red'>No User Account Specified</h2>";
            exit;
        } else {
            $userid = $_GET['userid'];
            $query = "Select * From ACCOUNTS Where Id = $userid";
            $username = "";
            $email = "";
            $password = "";
            if ($result = mysqli_query($con,$query)) {
                if ($row = mysqli_fetch_row($result)) {
                    $username = $row[1];
                    $email = $row[2];
                    $password = $row[3];
                }
            
                /* free result set */
                mysqli_free_result($result);
            }
        }

    } catch (Exception $e) {
        echo "Caught exception ", $e->getMessage(), "<br />";
    } finally {
        mysqli_close($con);
    }
?>

<b>User Account:</b>

<table border=0 cellpadding="5" cellspacing="2">
<tr>
<td>Username: </td><td><span style='color:blue'><?= $username ?></span></td>
<tr/>
<tr>
<td>Email: </td><td><span style='color:blue'><?= $email ?></span></td>
<tr/>
<tr>
<td>Password: </td><td><span style='color:blue'><?= $password ?></span></td>
<tr/>
</table>

<form method="post" action="index.php">
<p><input type="submit" value="Return" name = "return"/></p>
</form>
</body></html>