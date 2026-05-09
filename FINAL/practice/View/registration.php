<?php
include "../Controller/registrationValidation.php"
?>

<!DOCTYPE html>
<html>
    <head>
       <title>Registration Form</title>
    </head>

    <body>
       <form action="" method = "post">
          <h2>Registration Page</h2>
          <table>
            <tr>
                <td>
                   <label for="name">User Name: </label>
                </td>
                <td>
                   <input type="text" name = "name">
                </td>
                <td>
                    <p style="color:red">*</p>
                </td>
                <td>
                    <?php echo $nameError?>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                   <label for="email">Email: </label>
                </td>
                <td>
                    <br>
                   <input type="email" name="email">
                </td>
                <td>
                    <p style="color:red">*</p>
                </td>
                <td>
                    <?php echo $emailError?>
                </td>
            </tr>

            <tr>
                <td>
                    <br>
                   <label for="password">Password: </label>
                </td>
                <td>
                    <br>
                   <input type="password" name="password">
                </td>
                <td>
                    <p style="color:red">*</p>
                </td>
                <td>
                    <?php echo $passwordError?>
                </td>
            </tr>
            
            <tr>
                <td>
                 <input type="submit" value="submit">
                </td>
                <td>
                    <p>Already have an account? <a href="../View/login.php">Click Here</a></p>
                </td>
            </tr>
          </table>
       </form>    
    </body>
</html>