<?php
    require_once 'php/lib/config.php';
    require_once 'php/lib/session.php';
    require_once 'php/lib/forms.php';
    require_once 'php/lib/utils.php';

    startSession();

    try{
        $publisher = Publisher::findAll();
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
        <title>Add New Book</title>
    </head>

        <body>
            <?php require 'php/inc/flash_message.php'; ?>
            <div class="width-12">

            <h1>Add New Book</h1>

            <form id="book_form" action="book_store.php" method="POST" enctype="multipart/form-data" novalidate>
                <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>

                <div class="input">
                    <label for="title">Book Title:</label>
                    <input type="text" id="title" name="title" value="<?= h(old('title')) ?>" required>
                    <p id="title_error" class="error"><?= error('title') ?></p>
                </div>

                <div class="input">
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" value="<?= h(old('author')) ?>" required>
                    <p id="author_error" class="error"><?= error('author') ?></p>
                </div>

                <div class="input">
                    <label for="publisher_id">Publisher:</label>
                    <select id="publisher_id" name="publisher_id">
                        <option value="">-- Select Publisher --</option>
                                
                        <?php foreach ($publisher as $p){ ?>
                            <option value="<?= h($p->id) ?>" <?= chosen('publisher_id', $p->id) ? "selected" : "" ?> required>
                                <?= h($p->name) ?>
                            </option>
                        <?php } ?>
                    </select>
                    <p id="publisher_error" class="error"><?= error('publisher_id') ?></p>
                </div>

                <div class="input">
                    <label for="year">Year:</label>
                    <input type="text" id="year" name="year" value="<?= h(old('year')) ?>" required>
                    <p id="year_error" class="error"><?= error('year') ?></p>
                </div>

                <div class="input">
                    <label for="isbn">ISBN:</label>
                    <input type="text" id="isbn" name="isbn" value="<?= h(old('isbn')) ?>" required>

                    <p id="isbn_error" class="error"><?= error('isbn') ?></p>
                </div>

                <div class="input">
                    <span class="label-style">Formats</span>
                    <div>
                        <?php foreach ($formats as $format) { ?>
                            <div>
                                <input type="checkbox" id="format_ids<?= h($format->id) ?>" name="format_ids[]" value="<?= h($format->id) ?>"<?= chosen('format_ids', $format->id) ? "checked" : "" ?> required>
                                <label for="format_ids<?= h($format->id) ?>"><?= h($format->name) ?></label>
                            </div>
                        <?php } ?>
                    </div>
                    <p id="format_error" class="error"><?= error('format_ids') ?></p>
                </div>

                <div class="input">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="5"><?= h(old('description')) ?></textarea>
                    <p id="description_error" class="error"><?= error('description') ?></p>
                </div>

                <div class="input">
                    <label for="cover_filename">Book Cover Image (max 2MB):</label>
                    <input type="file" id="cover_filename" name="cover_filename" accept="image/*" required>
                    <p id="cover_filename_error" class="error"><?= error('cover_filename') ?></p>
                </div>

                <div class="input">
                    <button id="submitBtn" class="button" type="submit">Create Book</button>
                    <div class="button"><a href="book_list.php">Cancel</a></div>
                </div>
            </form>
            </div>
            <script src="./js/validate.js"></script>
        </body>
    </html>
    
<?php
    clearFormData();
    clearFormErrors();
?>