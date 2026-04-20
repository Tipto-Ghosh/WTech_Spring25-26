<?php
   session_start();

    if(!isset($_SESSION['user_data'])) {
       // no data,go back
       header("Location: registration.php");
       exit();
    }
    else{
       $user_data = $_SESSION['user_data'];
    }
    session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Welcome Page</title>
    </head>
    <body>
        <form method="get" action="registration.php">
            <h2>
                Registration Done
            </h2>

            <table>
                <th>Field</th>
                <th>Value</th>


                <tr>
                    <td>Name</td>
                    <td>
                        <?php echo $user_data["Name"]; ?>
                    </td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td>
                        <?php echo $user_data["Email"]; ?>
                    </td>
                </tr>
                <tr>
                    <td>Website</td>
                    <td>
                        <?php echo $user_data["Website"]; ?>
                    </td>
                </tr>
                <tr>
                    <td>Comment</td>
                    <td>
                        <?php echo $user_data["Comment"]; ?>
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <?php echo $user_data["Gender"]; ?>
                    </td>
                </tr>
                <input type="submit" value = "Add Another User">
            </table>
        </form>
    </body>
</html>