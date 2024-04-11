let logIn = document.getElementById('logIn') ;
let backLogIn = document.getElementById('backModalLogIn');
let modalLogIn = document.getElementById('logInModal');
let closeLogIn = document.getElementById('closeLogIn');
let changeToSignIn = document.getElementById('changeToSignIn');
let modalSignIn = document.getElementById('signInModal');
let changeToLogIn = document.getElementById('changeToLogIn');
let closeSignIn = document.getElementById('closeSignIn');
let navThreeDivs = document.getElementById('navThreeDivs');


// Открыть Войти
logIn.addEventListener('click', function(){
    backLogIn.style.height = "100vmin";
    modalLogIn.style.top = "50%";
})
// Закрыть Войти по Крестику
closeLogIn.addEventListener('click', function(){
    backLogIn.style.height = "0vmin";
    modalLogIn.style.top = "-50%";
})
// Закрыть Войти и Регистрацию по Фону
backLogIn.addEventListener('click', function(){
    backLogIn.style.height = "0vmin";
    modalSignIn.style.top = "-50%";
    modalLogIn.style.top = "-50%";
})
// Сменить модальное окно Входа на Регистрацию
changeToSignIn.addEventListener('click', function(){
    modalLogIn.style.top = "-50%";
    modalSignIn.style.top = "50%";
})
// Сменить модальное окно Регистриации на Войти
changeToLogIn.addEventListener('click', function(){
    modalLogIn.style.top = "50%";
    modalSignIn.style.top = "-50%";
})
// Закрыть Регистрацию по Крестику
closeSignIn.addEventListener('click', function(){
    backLogIn.style.height = "0vmin";
    modalSignIn.style.top = "-50%";
})
