<?php
    require_once 'php/lib/config.php';
    require_once 'php/lib/utils.php';
    require_once 'php/lib/session.php';
    require_once 'php/lib/forms.php';

    startSession();

    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            throw new Exception('Invalid request method.');
        }
        if (!array_key_exists('id', $_GET)) {
            throw new Exception('No book ID provided.');
        }

        $id = $_GET['id'];

        $book = Book::findById($id);

        if ($book === null) {
            throw new Exception("Book not found.");
        }

        $bookFormats = Format::findByBook($book->id);
        $bookFormatsIds = [];
        
        foreach ($bookFormats as $format) {
            $bookFormatsIds[] = $format->id;
        }

        $publishers = Publisher::findAll();
        $formats = Format::findAll();
    }

    catch (PDOException $e) {
        setFlashMessage('error', 'Error: ' . $e->getMessage());
        redirect('book_list.php');
    }

?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <?php include 'php/inc/head_content.php'; ?>
            <title>Edit Book</title>
        </head>

        <body>
            <div class="container">
                <div class="width-12">
                    <?php require 'php/inc/flash_message.php'; ?>
                </div>

                <div class="width-12">
                    <h1>Edit Book</h1>
                </div>

                <div class="width-12">
                    <form action="book_update.php" method="POST" enctype="multipart/form-data">
                        <div class="input">
                            <input type="hidden" name="id" value="<?= h($book->id) ?>">
                        </div>

                        <div class="input">
                            <label class="special" for="title">Title:</label>
                            <div>
                                <input type="text" id="title" name="title" value="<?= old('title', $book->title) ?>" required>
                                <p><?= error('title') ?></p>
                            </div>
                        </div>

                        <div class="input">
                            <label class="special" for="author_id">Author:</label>
                            <div>
                                <select id="author_id" name="author_id" required>
                                    <?php foreach ($authors as $a) { ?>
                                        <option value="<?= h($a->id) ?>" <?= chosen('author_id', $a->id, $book->author_id) ? "selected" : "" ?>>
                                            <?= h($a->name) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <p><?= error('author_id') ?></p>
                            </div>
                        </div>

                        <div class="input">
                            <label class="special" for="publisher_id">Publisher:</label>
                            <div>
                                <select id="publisher_id" name="publisher_id" required>
                                    <?php foreach ($publishers as $pub) { ?>
                                        <option value="<?= h($pub->id) ?>" <?= chosen('publisher_id', $pub->id, $book->publisher_id) ? "selected" : "" ?>>
                                            <?= h($pub->name) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <p><?= error('publisher_id') ?></p>
                            </div>
                        </div>

                        <div class="input">
                            <label class="special" for="year">Year:</label>
                            <div>
                                <input type="year" id="year" name="year" value="<?= old('year', $book->year) ?>" required>
                                <p><?= error('year') ?></p>
                            </div>
                        </div>

                        <div class="input">
                            <label class="special" for="isbn">ISBN:</label>
                            <div>
                                <input type="isbn" id="isbn" name="isbn" value="<?= old('isbn', $book->isbn) ?>" required>
                                <p><?= error('isbn') ?></p>
                            </div>
                        </div>

                        <div class="input">
                            <label class="special">Formats:</label>
                            <div>
                                <?php foreach ($formats as $f) { ?>
                                    <div>
                                        <input type="checkbox" 
                                            id="format_ids<?= h($f->id) ?>" 
                                            name="format_ids[]" 
                                            value="<?= h($f->id) ?>"
                                            <?= chosen('format_ids', $f->id, $bookFormatsIds) ? "checked" : "" ?>>
                                        <label for="format_ids<?= h($f->id) ?>"><?= h($f->name) ?></label>
                                    </div>
                                <?php } ?>
                            </div>
                            <p><?= error('format_ids') ?></p>
                        </div>

                        <div class="input">
                            <label class="special" for="description">Description:</label>
                            <div>
                                <textarea id="description" name="description" required><?= old('description', $book->description) ?></textarea>
                                <p><?= error('description') ?></p>
                            </div>
                        </div>

                        <div><img src="images/<?= $book->cover_filename ?>" /></div>
                        <div class="input">
                            <label class="special" for="cover_filename">Image (optional):</label>
                            <div>
                                <input type="file" id="cover_filename" name="cover_filename" accept="image/*">
                                <p><?= error('cover_filename') ?></p>
                            </div>
                        </div>
                        
                        <div class="input">
                            <button class="button" type="submit">Update Book</button>
                            <div class="button"><a href="book_list.php">Cancel</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </body>
    </html>

<?php
    clearFormData();
    clearFormErrors();
?>