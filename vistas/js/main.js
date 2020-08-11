const btnIngresar = document.getElementById('btn-ingreso');
const btnRegistrar = document.getElementById('btn-registro');
const selection = document.getElementById('selection');
const formIniciar = document.getElementById('form-iniciar');
const formRegistro = document.getElementById('form-registro');
const ContenedorForm = document.getElementById('form-cont');
const aIniciar = document.getElementById('a-Iniciar');
const aRegistrar = document.getElementById('a-Registrar');

aRegistrar.addEventListener('click', function(){
    Registrar();
});
aIniciar.addEventListener('click', function(){
    Iniciar();
});
btnRegistrar.addEventListener('click', function(){
    Registrar();
});

btnIngresar.addEventListener('click', function(){
    Iniciar()
});


function Registrar(){
    selection.style.left = "115px";
    formIniciar.style.left = "-300px";
    formRegistro.style.left = "35px"
    ContenedorForm.style.height = "400px";
}
function Iniciar(){
    ContenedorForm.style.height = "350px";
    selection.style.left = "0px";
    formIniciar.style.left = "25px";
    formRegistro.style.left = "300px"
}
function AJAXVersiones(){
    let xhr;
    const inputUsuario = document.getElementById("codUser");
    const inputProducto = document.getElementById("codProducto");
    
    inputUsuario.addEventListener('change',(e)=>{
        let usuario = inputUsuario.value;
        let datos = FormData();
        datos.append("consulUsuario",usuario);            
        if(window.XMLHttpRequest){
            xhr = new XMLHttpRequest();
        }else{
            xhr = new ActiveXObject("Microsoft.XMLHTTP")
        }
        xhr.open('POST', 'ajax/ajax.controlador.php');
        xhr.addEventListener('load',()=>{
            let resul = JSON.parse(xhr.response);
            console.log(resul);
            const resultUser = document.getElementById("resultUsuario");
            console.log(resultUser);
        })
        xhr.send(datos);
    })
}