<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <link rel='stylesheet' href='../css/style.css'>
</head>
<body>
<div id='backModal'></div>
    <div id='modalReg'>
        <img src='../images/close.png' alt='close' id='closeOneProd'>
        <div id='imgOneProd'><img src='../images/products/boba.png' alt=''></div>
        <div id='infoOneProd'>
            <h3 id='nameProd'>Добрый Кола</h3>
            <div id='rating'>
                <img src='../images/star.svg' alt=''>
                <span id='numRat'>5.0</span>
                <span id='amountRat'>(2343 оценок)</span>
            </div>
            <div id='emtyOneProd'></div>
            <div id='descProd'>
                <span id='desc'>Оригинальный вкус в новой упаковке. Газированный безалкогольный напиток Cola – напиток в металлической банке, освежает и тонизирует с первого глотка. Удивительный чайно-карамельный цвет, приятные пузырьки газа и ни с чем не сравнимый вкус.</span>
                <div></div>
                <span id='more'>Читать полностью</span>
            </div>
            <div id='allBeforePos'>
                <div id='offersOneProd'>
                    <span>Специальное предложение</span>
                    <div id='offerBtm'>
                        <div id='offerBtmLeft'>
                            <img src='../images/checkMark.svg' alt='check mark'>
                            <div id='emtyOneProd1'></div>
                            <div id='offerLeftBtm'>
                                <span id='offerLeftTop'>Оплатите заказ баллами до 30%</span>
                                <span id='offerLeftBtm'>Вернем 5% бонусами</span>
                            </div>
                        </div>
                        <div id='offerBtmRight'>
                            <span id='offerRightTop'>- 40 бонусов</span>
                            <span id='offerRightBtm'>Отменить</span>
                        </div>
                    </div>
                </div>
                <div id='emtyOneProd2'></div>
                <div id='volumeOneProd'>
                    <span>Объем</span>
                    <div id='volumesProd'>
                        <div class='oneV'>0.33</div>
                        <div class='oneV'>0.45</div>
                        <div class='oneV'>0.8</div>
                    </div>
                </div>
                <div id='emtyOneProd3'></div>
                <div id='priceNBtn'>
                    <div id='PriceProd'>
                        <span id='namePrice'>Цена</span>
                        <span id='justPrice'>100 &#8381;</span>
                    </div>
                    <form action='' method='GET'>
                        <input type='hidden' name=''>
                        <input type='submit' value='В корзину' id='toCart'>
                    </form>
                </div>
            </div>
        </div>
    </div> 

    <script>
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
    </script>
</body>
</html>
