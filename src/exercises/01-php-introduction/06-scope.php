<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scope Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/06-scope.php">View Example &rarr;</a>
    </div>

    <h1>Scope Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Global Counter</h2>
    <p>
        <strong>Task:</strong> 
        Create a global variable $totalPoints starting at 0. Create a function 
        addPoints() that adds a specified number of points to $totalPoints using 
        the global keyword. Call the function three times with different values 
        and display the total after each call.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $totalPoints = 0;
        function addPoints(){
            global $totalPoints;
            $totalPoints++;
            echo "<p>The total number of points is now: $totalPoints</p>";
        }
        addPoints();
        addPoints();
        addPoints();
        echo "<p>Final amount of points: $totalPoints</p>";
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Static Visit Counter</h2>
    <p>
        <strong>Task:</strong> 
        Create a function visitCounter() that uses a static variable to count how
        many times it has been called. Each time it's called, it should display 
        the visit count. Call it 5 times.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        function visitCounter(){
            static $visitCount = 0;
            $visitCount++;
            echo "<p>This page has been visited $visitCount time(s)</p>";
        }
        visitCounter();
        visitCounter();
        visitCounter();
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Local vs Global</h2>
    <p>
        <strong>Task:</strong> 
        Create a global variable $message = "Global". Create a function testScope() 
        that has a local variable $message = "Local". Display both the local 
        message inside the function and the global message outside the function 
        to demonstrate they are different.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $message = "Global";
        function testScope(){
            $message = "Local";
            echo "<p>$message</p>";
            global $message;
            echo "<p>$message</p>";
        }
        testScope();
        ?>
    </div>

</body>
</html>
