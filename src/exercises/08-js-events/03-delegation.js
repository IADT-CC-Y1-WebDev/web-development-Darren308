let cardsContainer = document.getElementById('cards');

function handleClicks(event){

    const card = event.target.closest('.card');
    if (!card) return;

    const action = event.target.dataset.action;
    if (action === "select"){
        toggleCardHighlight(card);
    }
    
    else if (action === "log"){
        logCardTitle(card);
    }
}

function toggleCardHighlight(card){
    card.classList.toggle('selected');
}

function logCardTitle(card){
    console.log('Card title: ', card.dataset.title);
}

cardsContainer.addEventListener('click', handleClicks);