let submitBtn = document.getElementById('submit_btn');
let commentForm = document.getElementById('comment_form');
let nameInput = document.getElementById('name');
let nameError = document.getElementById('name_error');

submitBtn.addEventListener('click', onSubmitForm);

function addError(fieldName,message){
    errors[fieldName] = message;
}

function showFieldErrors(){
    nameError.innerHTML = errors.name || '';
}

let errors = {};

function onSubmitForm(e){
    e.preventDefault();

    errors = {};
    
    const name = nameInput.value.trim();
    const nameRE = /^[A-Za-z ]+$/;

    if (name === ''){
        nameError.innerHTML = 'Name is required'
    }
    else if (!nameRE.test(name)){
        errors['name'] = 'Name can only contain letters and spaces';
    }

    if (Object.keys(errors).length === 0){
        commentForm.submit();
    }
    else{
        showFieldErrors();
    }
}