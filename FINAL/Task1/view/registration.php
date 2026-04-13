<?php
include "../Task1/controller/registrationValidation.php"
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form</title>
    </head>
    <body>
        <form action="registrationValidation.php" method="post">
            <table>
                <tr>
                    <td>
                        <label for="name">User Name: </label>
                    </td>
                    <td>
                        <input type="text" id="name" name="name">
                    </td>
                    <td> <p style='color: red'>*</p> </td>
                </tr>
                
                <tr>
                    <td>
                        <label for="pass">Password: </label>
                    </td>
                    <td>
                        <input type="password" id="pass" name="pass">
                    </td>
                    <td> <p style='color: red'>*</p> </td>
                </tr>

                <tr>
                    <td>
                        <label for="website">Website: </label>
                    </td>
                    <td>
                        <input type="text" id="website" name="website">
                    </td>
                    <td> <p style='color: red'>*</p> </td>
                </tr>

                <tr>
                    <td>
                        <label for="comment">Comment: </label>
                    </td>
                    <td>
                        <textarea id="comment" name="comment" cols="20" rows="5"></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" value="Submit">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>