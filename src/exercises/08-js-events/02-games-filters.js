let applyBtn = document.getElementById('apply_filters');
let clearBtn = document.getElementById('clear_filters');

let cards = document.getElementById('.card');
let form = document.getElementById('filters');

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
    let matches =  [];
    for (let i = 0; i != cards.length; i++){
        matches[i] = cardMatches(card,filters);
    }
}

function cardMatches(crd, fltr){
    console.log(crd.dataSet.title, fltr.titleFilter);
    return card.dataSet.title.toLowerCase().includes(fltr.titleFilter);
}

function getFilters(){
    const titleE1    = form.elements['title_filter'];
    const genreE1    = form.elements['genre_filter'];
    const platformE1 = form.elements['platform_filter'];
    const sortE1     = form.elements['sort_by'];

    let titlefilter    = (titleE1.value ||'').trim().toLowerCase();
    let genrefilter    = genreE1.value ||'';
    let platformfilter = platformE1.value ||'';
    let sortby         = sortE1.value ||'title_asc';

    return titlefilter;
    return genrefilter;
    return platformfilter;
    return sortby;
}


function clearFilters(){
    console.log('Clearing filters');
}