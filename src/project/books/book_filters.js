let applyBtn       = document.getElementById('apply_filters');
let clearBtn       = document.getElementById('clear_filters');
let cardsContainer = document.getElementById('game_cards');
let cards          = document.querySelectorAll('.card');
let form           = document.getElementById('filters');

applyBtn.addEventListener('click', (event) =>{
    event.preventDefault();
    applyFilters();
});

clearBtn.addEventListener('click', (event) =>{
    event.preventDefault();
    clearFilters();
});

function applyFilters(){
    let filters = getFilters()
    for (let i = 0; i != cards.length; i++){
        let card = cards[i];
        let match = cardMatches(card,filters);
        card.classList.toggle('hidden', !match);
    }
    let cardsArray = Array.from(cards);
    const sorted = sortCards(cardsArray, filters.sortby);
    sorted.forEach(card => {
        cardsContainer.appendChild(card);
    })
}

function sortCards(cards, sortby){
    const list = cards.slice();
        list.sort((a,b) => {
        let titleA = a.dataset.title.toLowerCase();
        let titleB = b.dataset.title.toLowerCase();
        let yearA  = Number(a.dataset.year);
        let yearB  = Number(b.dataset.year);

        if (sortby === 'year_desc') return yearB - yearA;
        if (sortby === 'year_asc') return yearA - yearB;

        return titleA.localeCompare(titleB);
    });
    return list;
}

function cardMatches(crd, fltr){
    let title          = crd.dataset.title.toLowerCase();
    let author          = crd.dataset.author;
    let platform       = crd.dataset.platform;
    let matchTitle     = fltr.titleFilter    === '' || title.includes(fltr.titleFilter);
    let matchAuthor     = fltr.authorFilter    === '' || author === fltr.gameFilter;
    let matchPlatform  = fltr.platformFilter === '' || platform.includes (fltr.platformFilter);

    return matchTitle && matchAuthor && matchPlatform;
}

function getFilters(){
    const titleE1      = form.elements['title_filter'];
    const authorE1      = form.elements['author_filter'];
    const platformE1   = form.elements['platform_filter'];
    const sortE1       = form.elements['sort_by'];

    let titleFilter    = (titleE1.value ||'').trim().toLowerCase();
    let authorFilter    = authorE1.value ||'';
    let platformFilter = platformE1.value ||'';
    let sortby         = sortE1.value ||'title_asc';

    return {
        titleFilter,
        authorFilter,
        platformFilter,
        sortby
    };
}

function clearFilters(){
    form.reset();

    cards.forEach(function (card){
        card.classList.remove('hidden');
    })

    let cardsArray = Array.from(cards);
    const sorted = sortCards(cardsArray, 'title');
    sorted.forEach(card => {
        cardsContainer.appendChild(card);
    })
}