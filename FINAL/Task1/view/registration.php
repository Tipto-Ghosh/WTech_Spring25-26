<?php
include "../controller/registrationValidation.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form</title>
    </head>
    <body>
        <form action="" method="post">
            <table>
                <tr>
                    <td>
                        <p style='color: red'> * Required Field </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="name">User Name: </label>
                    </td>
                    <td>
                        <input type="text" id="name" name="name">
                    </td>
                    <td> 
                        <p style='color: red'>*</p> 
                    </td>
                    <td>
                        <p><?php 
                           echo $name;
                        ?></p>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label for="pass">Password: </label>
                    </td>
                    <td>
                        <input type="password" id="pass" name="pass">
                    </td>
                    <td> <p style='color: red'>*</p> </td>
                    <td>
                        <p><?php 
                           echo $password;
                        ?></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="website">Website: </label>
                    </td>
                    <td>
                        <input type="text" id="website" name="website">
                    </td>
                    <td> <p style='color: red'>*</p> </td>
                    <td>
                        <p><?php 
                           echo $website;
                        ?></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="comment">Comment: </label>
                    </td>
                    <td>
                        <textarea id="comment" name="comment" cols="20" rows="5"></textarea>
                    </td>
                    <td>
                        <p><?php 
                           echo $comment;
                        ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="gender">Gender: </label>
                    </td>
                    <td>
                        <input type="radio" name="gender" value="female"> Female
                        <input type="radio" name="gender" value="male"> Male
                        <input type="radio" name="gender" value="other"> Other
                    </td>
                    <td>
                        <p><?php 
                           echo $gender;
                        ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Submit">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>