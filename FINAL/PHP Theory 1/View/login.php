<!DOCTYPE html>
<html>
    <head>
       <title>My First PHP code</title>
    </head>
    <body>
        <form action="../controller/loginvalidation.php" method = "post">
            <table>
                <tr>
                    <td>
                       <label for="name">User Name: </label>
                    </td>
                    <td>
                       <input type="text">
                    </td>
                </tr>
                <tr>
                    <td>
                       <label for="passoword">Password: </label>
                    </td>
                    <td>
                       <input type="password"> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value = "submit">
                    </td>
                </tr>
            </table>
        </form>

        <!-- PHP codes -->
        <?php
            // echo "<h2 style = 'color: red'>Hello world!</h2>";
            
            // $var1 = "Tipto";
            // $var2 = "Ghosh";
            
            // echo '<h1>'.$var1.'</h1>';

            // $a = -12;
            // if($a > 0) {
            //    echo "value is positive";
            // }
            // elseif($a == 0) { 
            //     echo "value is equal to zero";
            // }
            // else{
            //    echo "value is negative";
            // }
            // echo "<br><br><br><br>";
            
            // array
            // $courses = array(['IP' , 'java' , 'c#' , 'web Technology']);
            // var_dump($courses); // show the data-type and the value of a variable

            // ECHO "Hello";

            // IF($a < 0) {
            //     echo "Hey";
            // }
            
            $txt = "W3Schools.com";
            echo '<br>'.'I love'.$txt.'!<br>';

            $x = 5;
            $y = 4;
            // echo $x + $y;

            // var_dump($x); // int(5)

           function myFunction(int $x) {
              static $static_variable = 10;
              echo "Variable x inside function is: $x <br>";
              echo "Static Variable inside function is: $static_variable<br>";
              $static_variable ++;
           }
           // now static_variable = 10
        //    myFunction(12); // now static_variable = 11
        //    myFunction(11); // now static_variable = 12
        //    myFunction(100); // now static_variable = 13

           
            // to access global variable inside function we use global key
            function Test(){
                global $x , $y;
                $y = $x + $y;
            }

            test(); // not case sensitive
            echo "value of y: $y <br>"; // 9

            function Globals_superglobal(){
                $GLOBALS['y'] = $GLOBALS['x'] + $GLOBALS['y'];
                // y = y_current + x_current = 9 + 5 = 14  
            }
            Globals_superglobal();
            echo "value of y: $y <br>";
        ?>
    </body>
</html>