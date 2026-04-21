<?php
    require_once 'php/lib/config.php';
    require_once 'php/lib/session.php';
    require_once 'php/lib/forms.php';
    require_once 'php/lib/utils.php';

    try {
        $books = Book::findAll();
        $publishers = Publisher::findAll();
        $formats  = Format::findAll();
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
                <div class="button">
                    <a href="book_create.php">Add New Book</a>
                </div>
            </div>

            <?php if (!empty($books)) { ?>
                <div class="width-12 filters">
                    <form id="form-filters">
                        <div>
                            <label for="title_filter">Title:</label>
                            <input type="text" id="title_filter" name="title_filter">
                        </div>

                        <div>
                            <label for="author_filter">Author:</label>
                            <select id="author_filter" name="author_filter">
                                <option value="">All authors</option>
                                <?php foreach ($authors as $a) { ?>
                                <option value="<?= h($a->id) ?>"><?= h($a->name) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div>
                            <label for="publisher_filter">Publisher:</label>
                            <select id="publisher_filter" name="publisher_filter">
                                <option value="">All publishers</option>
                                <?php foreach ($publishers as $p) { ?>
                                <option value="<?= h($p->id) ?>"><?= h($p->name) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div>
                            <label for="format_filter">Formats:</label>
                            <select name="format_filter" id="format_filter">
                                <option value="">All Formats</option>
                                <?php foreach ($formats as $f) { ?>
                                <option value="<?= h($f->id) ?>"><?= h($f->name)?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div>
                            <button type="button" id="apply_filters">Apply Filters</button>
                            <button type="button" id="clear_filters">Clear Filters</button>
                        </div>
                    </form>
                </div>

            <?php } if (empty($books)) { ?>
                <p>No books found.</p>
            <?php } else { ?>
                
                <div class="width-12 cards">
                    <?php 
                    foreach ($books as $book) {
                        $formats = Format::findByBook($book->id);
                        $formatIds = [];
                        foreach ($formats as $f) {
                            $formatIds[] = $f->id;
                        }
                        $formatIdsStr = implode(" ", $formatIds);
                    ?>
                        <div class="card"
                            data-title="<?= htmlspecialchars($book->title) ?>"
                            data-publisher="<?= htmlspecialchars($book->publisher_id) ?>"
                            data-format_ids="<?= htmlspecialchars($formatIdsStr) ?>"
                        >
                            <div class="top-content">
                                <h2><?= h($book->title) ?></h2>
                                <p>Year: <?= h($book->year) ?></p>
                            </div>

                            <div class="bottom-content">
                                <img src="images/<?= h($book->cover_filename) ?>" alt="Image for <?= h($book->title) ?>" />
                                <div class="actions">
                                    <a href="book_view.php?id=<?= h($book->id) ?>">View</a>/ 
                                    <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a>/ 
                                    <a href="book_delete.php?id=<?= h($book->id) ?>">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <script src="./js/book_filters.js"></script>
    </body>
</html>