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

function getDataStorage(){
    var pages="";
    if(typeof(Storage)!=="undefined"){

        if(localStorage.getItem('email')){
            pages="home.html";
        }else{
            pages="login.html";
        }
    window.location.assign(pages);
    }
}


function closeSession() {


}