<form id="filters" class="filters">
            <div class="input">
                <label class="filter-label" for="title_filter">Title:</label>
                <div>
                    <input type="text" id="title_filter" name="title_filter" placeholder="Part of a title">
                </div>
            </div>

            <div class="input">
                <label class="filter-label" for="publisher_filter">Publisher:</label>
                <div>
                    <select id="publisher_filter" name="publisher_filter">
                        <option value="">All publishers</option>
                        <?php foreach ($publsihers as $p): ?>
                            <option value="<?= htmlspecialchars($p) ?>">
                                <?= htmlspecialchars($p) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="input">
                <label class="filter-label" for="format_filter">Format:</label>
                <div>
                    <select id="format_filter" name="format_filter">
                        <option value="">All Formats</option>
                        <?php foreach ($formats as $f): ?>
                            <option value="<?= htmlspecialchars($f) ?>">
                                <?= htmlspecialchars($f) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="input">
                <label class="filter-label" for="sort_by">Sort:</label>
                <div>
                    <select id="sort_by" name="sort_by">
                        <option value="title_asc">Title A-Z</option>
                        <option value="year_desc">Year (newest first)</option>
                        <option value="year_asc">Year (oldest first)</option>
                    </select>
                </div>
            </div>

            <div class="input">
                <label class="filter-label" for="apply_filters">Actions</label>
                <div>
                    <button type="button" id="apply_filters">Apply Filters</button>
                    <button type="button" id="clear_filters">Clear Filters</button>
                </div>
            </div>
        </form>

        <div id="book_cards" class="cards">
            <?php foreach ($books as $book): ?>
                <div class="card"
                    data-title        ="<?= htmlspecialchars($book['title'       ]) ?>"
                    data-publisher_id ="<?= htmlspecialchars($book['publisher_id']) ?>"
                    data-isbn         ="<?= htmlspecialchars($book['isbn'        ]) ?>"
                    data-format_ids   ="<?= htmlspecialchars($book['format_ids'  ]) ?>"
                    data-year         ="<?= $book['year'] ?>">
                    <h3><?= htmlspecialchars($book['title']) ?></h3>
                    <p>
                        <?= htmlspecialchars($book['title'     ]) ?>
                        <?= htmlspecialchars($book['publsiher' ]) ?>
                        <?= htmlspecialchars($book['isbn'      ]) ?>
                        <?= htmlspecialchars($book['format_ids']) ?>
                        <?= (int) $book['year'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <script src="book_filters.js"></script>
    </body>
</html>