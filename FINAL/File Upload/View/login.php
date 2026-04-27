<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <form action = "../Controller/loginValidation.php" , method="post">
        <h1 style="color: red">Welcome to Login Page</h1>

        <table>
            <tr>
                <td>
                    <label for="name">Name: </label>
                </td>

                <td>
                    <input type="text" name="name" required>
                </td>
            </tr>
            <tr>
                <td>
                <label for="password">Password: </label>
                </td>
                <td>
                    <input type="password" name="password" required>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="sumbit">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>