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
        redirect('/index.php');
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

            <div width-12>

            <h1>Add New Book</h1>

            <form action="book_store.php" method="POST" enctype="multipart/form-data" novalidate>
                <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>

                <div class="input">
                    <label for="title">Book Title:</label>
                    <input type="text" id="title" name="title" value="<?= h(old('title')) ?>" required>
                    <p><?= error('title') ?></p>
                </div>

                <div class="input">
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" value="<?= h(old('author')) ?>" required>
                    <p><?= error('author') ?></p>
                </div>

                <div class="input">
                    <label for="publisher_id">Publisher:</label>
                    <select id="publisher_id" name="publisher_id">
                        <option value="">-- Select Publisher --</option>
                                
                        <?php foreach ($publisher as $pub): ?>
                            <option value="<?= $pub['id'] ?>" <?= chosen('publisher_id', $pub['id']) ? "selected" : "" ?> required>
                                <?= h($pub['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <?php if (error('publisher_id')): ?>
                        <p class="error"><?= error('publisher_id') ?></p>
                    <?php endif; ?>
                </div>

                <div class="input">
                    <label for="release_date">Year:</label>
                    <input type="text" id="release_date" name="release_date" value="<?= h(old('release_date')) ?>" required>

                    <?php if (error('release_date')): ?>
                        <p class="error"><?= error('release_date') ?></p>
                    <?php endif; ?>
                </div>

                <div class="input">
                    <label for="isbn">ISBN:</label>
                    <input type="text" id="isbn" name="isbn" value="<?= h(old('isbn')) ?>" required>

                    <?php if (error('isbn')): ?>
                        <p class="error"><?= error('isbn') ?></p>
                    <?php endif; ?>
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
                    <p><?= error('format_ids') ?></p>
                </div>

                <div class="input">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="5"><?= h(old('description')) ?></textarea>

                    <?php if (error('description')): ?>
                        <p class="error"><?= error('description') ?></p>
                    <?php endif; ?>
                </div>

                <div class="input">
                    <label for="cover_filename">Book Cover Image (max 2MB):</label>
                    <input type="file" id="cover_filename" name="cover_filename" accept="image/*" required>

                    <?php if (error('cover_filename')): ?>
                        <p class="error"><?= error('cover_filename') ?></p>
                    <?php endif; ?>
                </div>

                <div class="input">
                    <button class="button" type="submit">Create Book</button>
                    <div class="button"><a href="index.php">Cancel</a></div>
                </div>
            </form>
            </div>
            <script src="validate.js"></script>
        </body>
    </html>
    
<?php
    clearFormData();
    clearFormErrors();
?>