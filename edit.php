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

        if ( isset($_POST['cancel']) ) {
            header( 'Location: index.php' ) ;
            exit;
        }
        
        if ( isset($_POST['edit']) && isset($_POST['userid'])
               && isset($_POST['username']) && isset($_POST['email'])  
                  && isset($_POST['password']) ) {

            $userid = $_POST['userid'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $query = "Update ACCOUNTS Set Username = \"$username\",
                          Email = \"$email\", Password = \"$password\"
                          Where Id = $userid";
            if (!mysqli_query($con,$query)) {
                echo "<h2 style='color:red'>Update Failed: " . mysqli_error($con) . "</h2>";
            } else {
                header( 'Location: index.php' ) ;
            }
            exit;
        } elseif ( !isset($_GET['userid']) ) {
            echo "<h2 style='color:red'>No User Account Specified</h1>";
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

<h2>Edit Account:</h2>
<form method="post" action="edit.php">
<table border=0 cellpadding="5" cellspacing="2">
<input type="hidden" name="userid" value="<?= $userid ?>">
<tr>
<td>Username:</td>
<td><input type="text" name="username" value="<?= $username ?>"></td>
<tr/>
<tr>
<td>Email:</td>
<td><input type="text" name="email" value="<?= $email ?>"></td>
<tr/>
<tr>
<td>Password:
<td><input type="text" name="password" value="<?= $password ?>"></td>
<tr/>
</table>
<p><input type="submit" value="Save" name="edit">
<input type="submit" value="Cancel" name = "cancel"/></p>


</form>
</body></html>
