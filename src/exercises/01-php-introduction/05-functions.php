<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/05-functions.php">View Example &rarr;</a>
    </div>

    <h1>Functions Exercises ✓</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Temperature Converter</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called celsiusToFahrenheit() that takes a Celsius temperature as a parameter and returns the Fahrenheit equivalent. Formula: F = (C × 9/5) + 32. Test it with a few values.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        function celsiusToFahrenheit() {
            $celsius = rand(0,50);
            echo $fahrenheit = ($celsius * 9/5) + 32;
        }
        celsiusToFahrenheit();
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Rectangle Area</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called calculateRectangleArea() that takes width
         and height as parameters. It should return the area. If only one 
         parameter is provided, assume it's a square (both dimensions equal).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        function calculateRectangleArea(){
            $height = rand(1,50);
            $width = rand(1,50);
            echo $area = $height * $width;
        }
        calculateRectangleArea();
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Even or Odd</h2>
    <p>
        <strong>Task:</strong>
        Create a function called checkEvenOdd() that takes a number and returns 
        "Even" if the number is even, or "Odd" if it's odd. Use the modulo 
        operator (%).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        function checkEvenOdd(){
            $num = rand(1,9999);
            $check = $num %2;
            if ($check == 0){
                echo "$num is Even";
            }
            else{
                echo "$num is Odd";
            }
        }
        checkEvenOdd();
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Array Statistics</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called getArrayStats() that takes an array of numbers 
        and returns an array with three values: minimum, maximum, and average. 
        Use array destructuring to display the results.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        function getArrayStats(){
            $num1 = rand(1,10);
            $num2 = rand(1,10);
            $num3 = rand(1,10);
            echo "<p>First number: $num1</p>" . "<p>Second number: $num2</p>" . "<p>Third number: $num3</p>";
            if ($num1>$num2 && $num1>$num3){
                echo "<p>argest number is $num1</p>";
                if ($num2>$num3){
                    echo "<p>Smallest number is $num3</p>";
                }
                else{
                    "<p>Smallest number is $num2</p>";
                }
            }
            else if ($num2>$num1 && $num2>$num3){
                echo "<p>Largest number is $num2</p>";
                if ($num1>$num3){
                    echo "<p>smallest number is $num3</p>";
                }
                else{
                    echo "<p>smallest number is $num1</p>";
                }
            }
            else{
                echo "<p>Largest number is $num3</p>";
            }
            $average = ($num1 + $num2 + $num3)/3;
            echo "<p>The average of the 3 numbers is: $average</p>";
        }
        getArrayStats();
        ?>
    </div>
</body>
</html>
