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
        
        if ( isset($_POST['delete']) && isset($_POST['userid']) ) {

            $userid = $_POST['userid'];
            $query = "Delete From ACCOUNTS Where Id = $userid";
            if (!mysqli_query($con,$query)) {
                echo "<h2 style='color:red'>Delete Failed: " . mysqli_error($con) . "</h2>";
            } else {
                header( 'Location: index.php' ) ;
            }
            exit;
        } elseif ( !isset($_GET['userid']) ) {
            echo "<h2 style='color:red'>No User Account Specified</h2>";
            exit;
        } else {
            $userid = $_GET['userid'];
            $query = "Select Username From ACCOUNTS Where Id = $userid";
            if ($result = mysqli_query($con,$query)) {
                if ($row = mysqli_fetch_row($result)) {
                    $username = $row[0];
                } else {
                    $username = "";
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

<h2>Are You Sure You Want To Delete "<?= $username ?>"</h2>
<form method="post" action="delete.php">
<input type="hidden" name="userid" value="<?= $userid ?>">
<p><input type="submit" value="Delete" name="delete">
<input type="submit" value="Cancel" name = "cancel"/></p>
</form>
</body></html>
