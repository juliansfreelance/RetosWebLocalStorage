function getData(id,e) {
    var objForm=document.getElementById(id);
    if(formValidation(objForm,e)) {
        login(objForm);
    }else {
        alert("Error Validate");
    }
}

function login(objForm) {
    var inputForm = objForm.querySelectorAll('input');
    var ArrayData=new Array();
    for(var i=0;i<inputForm.length;i++) {
        ArrayData.push(inputForm[i].value);
    }
    sedDataStorage(ArrayData);
}

function formValidation(objForm, e) {
    var validations=true;
    var inputForm = objForm.querySelectorAll('input');
    for(var i=0;i<inputForm.length;i++) {
        if(inputForm[i].value=="" || inputForm[i].value.length<1) {
            validations=false;
            break;
        }
    }
    e.preventDefault();
    return validations;
}

function sedDataStorage(arrayData){
    if(typeof(Storage)!=="undefined"){
        localStorage.setItem('email',arrayData[0]);
        localStorage.setItem('password',arrayData[1]);
    }
    getDataStorage();

}

function getDataStorage(page) {
    if(typeof(Storage)!=="undefined") {
        if (localStorage.getItem('correo') && localStorage.getItem('hash')) {
            setUp(page, true);
        }else{
            setUp(page, false);
        }
    }
}


function closeSession() {


}

function setUp(page, action) {
    const nav = document.querySelector('.nav');
    const menu = document.querySelector('.contenidos');
    if (action) {
        switch (page) {
            case 'index':
                nav.innerHTML += '<li class="nav-item"><a class="nav-link link-light" href="home.html">Perfil</a></li>';
                menu.innerHTML += '<div class="col-lg-6">' +
                                    '<div class="card">' +
                                        '<div class="card-body">' +
                                            '<h5 class="card-title">Perfil</h5>' +
                                            '<p class="card-text">Ya iniciaste seción anteriormente puedes ingresar automaticamente gracias a los datos en el localStorage, o cerrar sección desde aquí.</p>' +
                                            '<div class="d-grid gap-2 d-flex justify-content-start">' +
                                                '<a href="#" class="btn btn-danger">Cerrar Sesión</a>' +
                                                '<a href="home.html" class="btn btn-primary">Ir al Perfil</a>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div >' +
                                '</div >';
                break;
            case 'registro':
                nav.innerHTML += '<li class="nav-item"><a class="nav-link link-light" href="home.html">Perfil</a></li>';
                break;
            case 'login':
                window.location.assign('home.html');
                break
        }
    } else {
        switch (page) {
            case 'index':
                nav.innerHTML += '<li class="nav-item"><a class="nav-link link-light" href="login.html">LogIn</a></li>';
                menu.innerHTML += '<div class="col-lg-6">'+
                                    '<div class="card">'+
                                        '<div class="card-body">'+
                                            '<h5 class="card-title">Ingresar</h5>'+
                                            '<p class="card-text">Ingresa tus credenciales para solicitar acceso a la base de datos mediante Ajax y guardar información en el localStorage.</p>' +
                                            '<a href="login.html" class="btn btn-primary">Ingresar</a>'+
                                        '</div>'+
                                    '</div >'+
                                '</div >';
                break;
            case 'registro':
                nav.innerHTML += '<li class="nav-item"><a class="nav-link link-light" href="login.html">LogIn</a></li>';
                break;
        }
    }
}