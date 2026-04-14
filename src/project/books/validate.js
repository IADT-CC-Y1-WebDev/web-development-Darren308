let submit              = document.getElementById('submit');
let bookForm            = document.getElementById('book_form');
let errorSummaryTop     = document.getElementById('error_summary_top');

let titleInput          = document.getElementById('title');
let releaseDateInput    = document.getElementById('release_date');
let authorInput         = document.getElementById('author');
let descriptionInput    = document.getElementById('description');
let formatIdsInput      = document.getElementsByName('format_ids[]');
let cover_filenameInput = document.getElementById('cover_filename');

let titleError          = document.getElementById('title_error');
let releaseDateError    = document.getElementById('release_date_error');
let authorError         = document.getElementById('author_error');
let descriptionError    = document.getElementById('description_error');
let formatIdsError      = document.getElementById('format_ids_error');
let cover_filenameError = document.getElementById('cover_filename_error');

let errors = {};

submit.addEventListener('click', onSubmitForm);

function addError(fieldName, message) {
    errors[fieldName] = message;
}

function showErrorSummaryTop() {
    const messages = Object.values(errors);
    if (messages.length === 0) {
        errorSummaryTop.style.display = 'none';
        errorSummaryTop.innerHTML = '';
        return;
    }

    errorSummaryTop.innerHTML =
        '<strong>Please fix the following:</strong><ul>' +
        messages
            .map(function (m) {
                return '<li>' + m + '</li>';
            })
            .join('') + '</ul>';
    errorSummaryTop.style.display = 'block';
}

function showFieldErrors() {
    titleError         .innerHTML = errors.title          || '';
    authorError        .innerHTML = errors.author         || '';
    releaseDateError   .innerHTML = errors.release_date   || '';
    descriptionError   .innerHTML = errors.description    || '';
    formatIdsError     .innerHTML = errors.format_ids   || '';
    cover_filenameError.innerHTML = errors.cover_filename || '';
}

function isRequired(value) {
    return String(value).trim() !== '';
}

function isMinLength(value, min) {
    return String(value).trim().length >= min;
}

function isMaxLength(value, max) {
    return String(value).trim().length <= max;
}

function onSubmitForm(evt) {
    evt.preventDefault();

    errors = {};

    const titleMin = Number(titleInput.dataset.minlength || 5);
    const titleMax = Number(titleInput.dataset.maxlength || 255);
    const descMin  = Number(descriptionInput.dataset.minlength || 10);

    //title--
    if (!isRequired(titleInput.value)) {
        addError('title', 'Title is required.');
    } 
    else if (!isMinLength(titleInput.value, titleMin)) {
        addError('title', 'Title must be at least ' + titleMin + ' characters.');
    } 
    else if (!isMaxLength(titleInput.value, titleMax)) {
        addError('title', 'Title must be at most ' + titleMax + ' characters.');
    }

    //author--
    if (!isRequired(authorInput.value)) {
        addError('author', 'Author is required.');
    }
    else if (!isMinLength(authorInput.value, titleMin)) {
        addError('author', 'Author must be at least ' + titleMin + ' characters.');

    //release date--
    if (!isRequired(releaseDateInput.value)) {
        addError('release_date', 'Release year is required.');
    }
    else {
        const date = new Date(releaseDateInput.value);
        
        if (Number.isNaN(date.getTime())) {
            addError('release_date', 'Please enter a valid date.');
        }
    }

    //description--
    if (!isRequired(descriptionInput.value)) {
        addError('description', 'Description is required.');
    } 
    else if (!isMinLength(descriptionInput.value, descMin)) {
        addError('description', 'Description must be at least ' + descMin + ' characters.');
    }

    let formatChecked = false;
    for (let i = 0; i < formatIdsInput.length; i++) {
        
        if (formatIdsInput[i].checked) {
            formatChecked = true;
            break;
        }
    }

    if (!formatChecked) {
        addError('format_ids', 'Select at least one format.');
    }

    //image--
    if (!cover_filenameInput.files || cover_filenameInput.files.length === 0) {
        addError('cover_filename', 'Image is required.');
    }

    showErrorSummaryTop();
    showFieldErrors();

    if (Object.keys(errors).length === 0) {
        alert('Book form is valid. In a real app, this would submit to the server.');
        bookForm.submit();
    }
}
}