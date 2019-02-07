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

        if ( isset($_POST['username']) && trim($_POST['username']) != "" &&
              isset($_POST['email']) && isset($_POST['password'])) {

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $query = "Insert Into ACCOUNTS (Username, Email, Password) 
                      Values (\"$username\", \"$email\", \"$password\")";

            if (!mysqli_query($con,$query)) {
                echo "<h2 color=red>Insert Failed: " . mysqli_error($con);
            } else {
                header( 'Location: index.php' ) ;
            }
            exit;
        }

    } catch (Exception $e) {
        echo "Caught exception ", $e->getMessage(), "<br />";
    } finally {
        mysqli_close($con);
    }
?>

<b>New User Account:</b>
<form method="post" action="add.php">
<table border=0 cellpadding="5" cellspacing="2">
<tr>
<td>Username: </td><td><input type="text" name="username"></td>
<tr/>

<tr>
<td>Email: </td><td><input type="text" name="email"></td>
<tr/>
<tr>
<td>Password: </td><td><input type="password" name="password"></td>
<tr/>

</table>
<p><input type="submit" value="Add New"/>
<input type="submit" value="Cancel" name = "cancel"/></p>
</form>
</body></html>
