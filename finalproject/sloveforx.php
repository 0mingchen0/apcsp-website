<!DOCTYPE html>
<html>
  <head>
    <title>Slove for X</title>
  </head>


  <body>

    <h1> Slove for x </h1>
<p>   Enter a linear equation in one variable of the form aX² - b = 0  </p>    
    <?php
       // define variables and set to empty values
       $arg1 = $arg2 = $arg3 = $output = $retc = "";

       if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $arg1 = test_input($_POST["arg1"]);
         $arg2 = test_input($_POST["arg2"]);
         exec("/usr/lib/cgi-bin/sp2b/sloveforx " . $arg1 . " " . $arg2 , $output, $retc); 
       }

       function test_input($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
       }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      A: <input type="text" name="arg1"><br>
      B: <input type="text" name="arg2"><br>
      <br><br>
      <input type="submit" value="Go!">
    </form>

    <?php
       // only display if return code is numeric - i.e. exec has been called
       if (is_numeric($retc)) {
         echo "<h2>Your Input:</h2>";
         echo "A: " . $arg1;
         echo "<br>";
         echo "B: " . $arg2;
         echo "<br>";
         
         echo "<h2>Program Output (an array):</h2>";
         foreach ($output as $line) {
           echo $line;
           echo "<br>";
         }
       
         echo "<h2>Program Return Code:</h2>";
         echo $retc;
       }
    ?>
    
  </body>
</html>
