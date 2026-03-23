let box          = document.getElementById('box');
let toggleboxbtn = document.getElementById('toggle_box_btn');
let preview      = document.getElementById('preview');
let previewInput = document.getElementById('preview_input');

toggleboxbtn.addEventListener('click', (event) => {
    toggleBoxVisability(box);
});

function toggleBoxVisability(box2){
    box2.classList.toggle('hidden');
}

previewInput.addEventListener('change', (event) => {
    updatePreview(preview,event.target.value);
});

function updatePreview(previewElement,text){
    const trimmed = text.trim();
    if(trimmed === ''){
        previewElement.textContent = 'nothing yet';
        previewElement.classList.add('empty');
    } 
    else{
    previewElement.textContent = trimmed;
    previewElement.classList.remove('empty');
    }
}