<!DOCTYPE html>
<html>
    <head>
       <title>My First PHP code</title>
    </head>
    <body>
        <!-- <form action="../controller/loginvalidation.php" method = "post">
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
        </form> -->

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
            
            // $txt = "W3Schools.com";
            // echo '<br>'.'I love'.$txt.'!<br>';

            // $x = 5;
            // $y = 4;
            // echo $x + $y;

            // var_dump($x); // int(5)

        //    function myFunction(int $x) {
        //       static $static_variable = 10;
        //       echo "Variable x inside function is: $x <br>";
        //       echo "Static Variable inside function is: $static_variable<br>";
        //       $static_variable ++;
        //    }
           // now static_variable = 10
        //    myFunction(12); // now static_variable = 11
        //    myFunction(11); // now static_variable = 12
        //    myFunction(100); // now static_variable = 13

           
            // to access global variable inside function we use global key
            // function Test(){
            //     global $x , $y;
            //     $y = $x + $y;
            // }

            // test(); // not case sensitive
            // echo "value of y: $y <br>"; // 9

            // function Globals_superglobal(){
            //     $GLOBALS['y'] = $GLOBALS['x'] + $GLOBALS['y'];
            //     // y = y_current + x_current = 9 + 5 = 14  
            // }
            // Globals_superglobal();
            // echo "value of y: $y <br>";

            // var_dump(5); // int(5)
            // var_dump("tipto"); // string(5)"tipto"
            // print("hello"); // hello
            // print("<h2>PHP is Fun!</h2>");

            // $bool = false;
            // echo $bool; // output: 1
            
            // $x = "tipto";
            // $x = null;
            // echo $x; // prints nothing
            

            // ---------------------- String ----------------------
            // $x = "Hello World!";
            // echo strlen($x);
            // echo "<br><br>";
            // echo str_word_count($x);
          
            $txt = "I really love PHP!";
            // echo (str_contains($txt, "love")); // 1
            // var_dump(str_contains($txt, "love")); // bool(true)
            
            // $isExists = strpos($txt , "love");
            // echo $isExists;
            // strtoupper($txt); // return the upper case, main string remain same
            // echo $txt;
            
            // $t = str_replace("love" , "hate" , $txt); // return modified string
            // echo $t;

            // $x = "Hello";
            // $y = "world";
            // $z = "$x $y";
            // $w = $x + $y; // error
            // echo $z;

            // $x = "Hello World!";
            // echo substr($x, -5, 3); // o is at -5 so from o, it will return 3 chars
            // $x = "Hi, how are you?";
            // echo substr($x, 5, -3); # start from index 5 and go till -3 index(excluded)
            
            $x = "We are the so-called \"Vikings\" from the north.";
            // echo $x;
            $num = -1;
            // if($num % 2 == 0 && $num < 20) {
            //    echo "Hello";
            // }
            // if($num) {
            //     echo "Hello";
            // }

            $x = 12;
            $y = 1;
            $y .= $x; // 112
            $z = $x . $y; // 12112
            // echo $z;

            // $str1 = "Tipto";
            // function modifyString(string &$s){
            //     $s .= " Ghosh";
            // }
            // modifyString($str1);
            // echo $str1;
            
            $courses = array('c++' , 'java' , 'c#' , 'web Technology');
            // echo count($courses);
            // echo $courses[1];
            
            function updateArrayElement(array &$arr , int $pos , string $element) {
                $arr[$pos] = $element;
            }

            updateArrayElement($courses , 1 , "python");
            var_dump($courses);
            echo "<br><br><br><br>";

            foreach($courses as $c){
                echo "$c | ";
            }
            echo "<br><br><br><br>";
            // echo $courses[12];

            $myArr = [];
            $myArr[0] = "apples";
            $myArr[1] = "bananas";
            $myArr["fruit"] = "cherries";

            echo $myArr["0"].'<br>'; // works both number and string
            echo $courses["2"];

            $cars = array("Volvo", "BMW", "Toyota");
            foreach ($cars as &$x) {
            $x = "Ford";
            }
            unset($x);

            $x = "ice cream";

            var_dump($cars);

        ?>
    </body>
</html>