let applyBtn       = document.getElementById('apply_filters');
let clearBtn       = document.getElementById('clear_filters');
let cardsContainer = document.getElementById('book_cards');
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
        let release_dateA  = Number(a.dataset.release_date);
        let release_dateB  = Number(b.dataset.release_date);

        if (sortby === 'release_date_desc') return release_dateB - release_dateA;
        if (sortby === 'release_date_asc') return release_dateA - release_dateB;

        return titleA.localeCompare(titleB);
    });
    return list;
}

function cardMatches(crd, fltr){
    let title          = crd.dataset.title.toLowerCase();
    let author         = crd.dataset.author;
    let format         = crd.dataset.format;
    let matchTitle     = fltr.titleFilter    === '' || title.includes(fltr.titleFilter);
    let matchAuthor    = fltr.authorFilter   === '' || author === fltr.bookFilter;
    let matchFormat    = fltr.formatFilter   === '' || format.includes (fltr.formatFilter);

    return matchTitle && matchAuthor && matchFormat;
}

function getFilters(){
    const titleE1      = form.elements['title_filter'];
    const authorE1     = form.elements['author_filter'];
    const formatE1     = form.elements['format_filter'];
    const sortE1       = form.elements['sort_by'];

    let titleFilter    = (titleE1.value ||'').trim().toLowerCase();
    let authorFilter   = authorE1.value ||'';
    let formatFilter   = formatE1.value ||'';
    let sortby         = sortE1.value ||'title_asc';

    return {
        titleFilter,
        authorFilter,
        formatFilter,
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