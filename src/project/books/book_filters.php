<!-- <form id="filters" class="filters">
            <div class="input">
                <label class="filter-label" for="title_filter">Title:</label>
                <div>
                    <input type="text" id="title_filter" name="title_filter" placeholder="Part of a title">
                </div>
            </div>
            <div class="input">
                <label class="filter-label" for="author_filter">Author:</label>
                <div>
                    <select id="author_filter" name="author_filter">
                        <option value="">All Authors</option>
                        <?php foreach ($authors as $author): ?>
                            <option value="<?= htmlspecialchars($author) ?>">
                                <?= htmlspecialchars($author) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="input">
                <label class="filter-label" for="platform_filter">Platform:</label>
                <div>
                    <select id="platform_filter" name="platform_filter">
                        <option value="">All Platforms</option>
                        <?php foreach ($platforms as $platform): ?>
                            <option value="<?= htmlspecialchars($platform) ?>">
                                <?= htmlspecialchars($platform) ?>
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

        <div id="game_cards" class="cards">
            <?php foreach ($games as $game): ?>
                <div class="card"
                    data-title="<?= htmlspecialchars($game['title']) ?>"
                    data-author="<?= htmlspecialchars($game['author']) ?>"
                    data-platform="<?= htmlspecialchars($game['platform']) ?>"
                    data-year="<?= $game['year'] ?>">
                    <h3><?= htmlspecialchars($game['title']) ?></h3>
                    <p><?= htmlspecialchars($game['author']) ?> · <?= htmlspecialchars($game['platform']) ?> (<?= (int) $game['year'] ?>)</p>
                </div>
            <?php endforeach; ?>
        </div>
        <script src="02-games-filters.js"></script>
    </body>
</html> -->