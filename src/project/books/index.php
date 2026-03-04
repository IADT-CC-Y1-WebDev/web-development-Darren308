<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';


try {
    $books = Book::findAll();
    $formats = Format::findAll();
} 

catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include './php/inc/head_content.php'; ?>
        <title>Books</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require './php/inc/flash_message.php'; ?>
            </div>
            <div class="width-12 header">
                <p><a href="book_list.php">View Books</a></p>
            </div>
        </div>
    </body>
</html>
      