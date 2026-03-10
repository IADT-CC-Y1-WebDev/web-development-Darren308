console.log('Hello World');

let myBtn = document.getElementById('myButton');
let myInput = document.getElementById('title');

function addParagraph() {
  const p = document.createElement('p');
  p.innerHTML = myInput.value;
  document.body.appendChild(p);
}

myBtn.addEventListener('click', addParagraph);

myInput.addEventListener('keyup', function(e){
    console.log(e.key);
    if (e.key === 'Enter'){
        addParagraph();
    }
})