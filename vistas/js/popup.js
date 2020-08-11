let btnAbrirPopup = document.getElementById("btn-abrir-popup");
let overlay = document.getElementById('overlay');
let popup = document.getElementById('popup');
let btnCerrarPopup = document.getElementById("btn-cerrar-popup");
let btnSuscribir = document.getElementById("btn-submit");

btnAbrirPopup.addEventListener('click', function(){
    overlay.classList.add('active');
    popup.classList.add('active')
})
btnCerrarPopup.addEventListener('click', function(){
    overlay.classList.remove('active');
    popup.classList.remove('active');
})
btnSuscribir.addEventListener('click', function(){
    overlay.classList.remove('active');
    popup.classList.remove('active');
})