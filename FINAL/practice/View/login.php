<?php
include "../Controller/loginValidation.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <form action = "" , method="post">
        <h1 style="color: red">Welcome to Login Page</h1>
        <?php if(!empty($loginError)) { ?>
            <p style="color:red;">
                <?php echo $loginError; ?>
            </p>
        <?php } ?>
        <table>
            <tr>
                <td>
                    <label for="name">Name: </label>
                </td>

                <td>
                    <input type="text" name="name" required>
                </td>
                <td><?php echo $nameError ?></td>
            </tr>
            <tr>
                <td>
                <label for="password">Password: </label>
                </td>
                <td>
                    <input type="password" name="password" required>
                </td>
                <td><?php echo $passwordError ?></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="login">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>