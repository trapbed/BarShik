
    let back = document.getElementById('backModal');
    let modal = document.getElementById('modalReg');
    let body = document.querySelector('body');
    let close = document.getElementById('closeOneProd');

    let btns = document.getElementsByClassName('plusProd');
    for(let i=0 ; i < btns.length; i++){
        btns[i].addEventListener('click', function(){
            body.style.overflowY = 'hidden';
            back.style.height = '100vmin';
            modal.style.top = '50%';
        })
    }
    back.addEventListener('click', function(){
        body.style.overflowY = 'visible';
        back.style.height = '0vmax';
        modal.style.top = '-50%';
    })

    close.addEventListener('click', function(){
        body.style.overflowY = 'visible';
        back.style.height = '0vmax';
        modal.style.top = '-50%';
    })