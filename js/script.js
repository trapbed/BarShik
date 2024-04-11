let btn = document.getElementById('forArrow');

let fizzL = document.getElementById('fizzLeft');
let fizzR = document.getElementById('fizzRight');
let bank = document.getElementById('bankImgIndex');

btn.addEventListener('click', function(){
    bank.style.top = '-100vmax';
    fizzL.style.left = "-80vmax";
    fizzR.style.left = "300vmax";
    let redirection=()=>{
        location.href='catalog.php';
    };
    setTimeout(redirection, 1000);

}) 