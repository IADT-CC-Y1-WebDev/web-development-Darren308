<?php
    require_once "lib/session.php";
    require_once "lib/utils.php";

    startSession();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include './inc/head_content.php'; ?>
        <title>Success</title>
    </head>
    <body>
        <?php require './inc/flash_message.php'; ?>
        <div class="back-link">
            <a href="index.php">&larr; Back to Form Handling </a>
        </div>

        
        <h1>Success</h1>

        <?php dd(getFormData()); ?>
        <?php dd(getFormErrors()); ?>

        <?php
        ?>
    </body>
</html>