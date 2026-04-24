<?php
include "../Controller/RegistrationValidation.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form</title>
    </head>
    <body>
        <form method="post" action="">
            <h2>PHP Validation Example</h2>
            <p style="color: red">* required field</p>
            <table>
                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name="name"></td>
                    <td> <p style = 'color: red'>*</p></td>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password"></td>
                    <td> <p style = 'color: red'>*</p> </td>
                    <td><?php echo $password; ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name = "email"></td>
                    <td><p style="color: red">*</p></td>
                    <td><?php echo $email?></td>
                </tr>
                <tr>
                    <td>Website:</td>
                    <td><input type="text" name="website"></td>
                    <td> <p style = 'color: red'>*</p> </td>
                    <td><?php echo $website; ?></td>
                </tr>
                <tr>
                    <td>Comment:</td>
                    <td><textarea cols="20" rows="5" name="comment"></textarea> </td>
                    <td><?php echo $comment; ?></td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>
                        <input type="radio" name="gender" value="Female" >Female <?php if($gender == "Female") echo " <span style='color: green;'>checked</span>"; ?>
                        <input type="radio" name="gender" value="Male"> Male <?php if($gender == "Male") echo " <span style='color: green;'>checked</span>"; ?>
                        <input type="radio" name="gender" value="Other"> Other <?php if($gender == "Other") echo " <span style='color: green;'>checked</span>"; ?>
                    </td>
                    <td> <p style = 'color: red'>*</p> </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
        
    </body>
</html>