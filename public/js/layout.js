document.addEventListener("DOMContentLoaded", ready);

/*header*/
function ready(){
    toggleClassOnEvent('burg', 'active', 'noneActive', 'click');
    eventHoverDelegation(document.getElementById('gallery'), '.mycontainer', overHandler, outHandler);
    adapter(document.getElementById('carousel'));
    showPopup(document.getElementById('popup'), document.getElementById('showpopup'));
    showIllustratiion(document.querySelector('.illustration'));
    addAttribute();
    switchLi(document.getElementById('switch'));
    feedback();
    buttongratitude(document.getElementById('buttongratitude'));
}

function toggleClassOnEvent(id, classActive, classNonActive, event) {
    let elem;
    if (typeof id == 'string'){
        elem = document.getElementById(id);
    } else {
        elem = id;
    }
    elem.addEventListener(event, () => {
        if (!elem.classList.contains(classActive) && !elem.classList.contains(classNonActive)) {
            elem.classList.add(classActive);
            showMenu();
            return;
        }
        elem.classList.toggle(classActive);
        elem.classList.toggle(classNonActive);
        showMenu();
    });
}



function toggleClass(elem, classActive, classNonActive){
    if (!elem.classList.contains(classActive) && !elem.classList.contains(classNonActive)) {
        elem.classList.add(classActive);
        return;
    }
    elem.classList.toggle(classActive);
    elem.classList.toggle(classNonActive);
}

function eventHoverDelegation(container, elemSelector, overHandler, outHandler){
    if (container){
        let currentElem = null;
        container.addEventListener('pointerover', pointerover);
        // container.addEventListener('focus', pointerover);
        container.addEventListener('pointerout', pointerout);
        // container.addEventListener('blur', pointerout);

        function pointerover(e){
            if (currentElem) return;
            let target = e.target.closest(elemSelector);
            if (!target) return;
            currentElem = target;
            overHandler(currentElem);
            let span = currentElem.querySelector('span');
            if (span){
                span.addEventListener('focus', overHandler(currentElem));
                span.addEventListener('blur', outHandler(currentElem));
            }
        }

        function pointerout(e){
            if (!currentElem) return;
            let relatedTarget = e.relatedTarget;
            while (relatedTarget){
                if (relatedTarget == currentElem) return;
                relatedTarget = relatedTarget.parentNode;
            }
            outHandler(currentElem);
            currentElem = null;
        }
    }
}



function overHandler(elem){
    addAndDeleteClass(elem.querySelector('div'), 'myhover');
    addAndDeleteClass(elem.querySelector('span'), 'myhover');
}
function outHandler(elem){
    addAndDeleteClass(elem.querySelector('div'), 'myhover');
    addAndDeleteClass(elem.querySelector('span'), 'myhover');
}
function addAndDeleteClass(elem, className){
    if (elem.classList.contains(className)){
        elem.classList.remove(className);
    } else {
        elem.classList.add(className);
    }
}

function adapter(carousel){
    // let instance = new bootstrap.Carousel(carousel, {
    //     interval: false,
    //     wrap: false
    // })
    if (carousel){
        let currentImg = carousel.querySelector('div.active img');
        let previousValue = currentImg.clientHeight;
        let parent = currentImg.closest('div.carousel-inner');
        // console.log(parent);
        parent.style.height = previousValue + 'px';

        carousel.addEventListener('slid.bs.carousel', changed);

        function changed() {
            currentImg = carousel.querySelector('div.active img');
            let nextValue = currentImg.clientHeight;
            // currentImg.style.width = '100%';
            // currentImg.style.height = previousValue;
            animate(parent, previousValue, nextValue, {timing: timingLinear, draw: drawHeight, duration: 300});
            previousValue = nextValue;
        }
    }
}

function animate(elem, previousValue, nextValue, {timing, draw, duration}, callback=null) {
    let start = performance.now();
    requestAnimationFrame(function animate(time) {
        // timeFraction изменяется от 0 до 1
        let timeFraction = (time - start) / duration;
        if (timeFraction > 1) timeFraction = 1;
        // вычисление текущего состояния анимации
        let progress = timing(timeFraction);
        draw(elem, progress, previousValue, nextValue); // отрисовать её
        if (timeFraction < 1) {
            requestAnimationFrame(animate);
        } else {
            if (callback) callback();
        }
    });
}

function timingLinear(timeFraction) {
    return timeFraction;
}
function drawHeight(elem, progress, previousValue, nextValue) {
    elem.style.height = previousValue + (nextValue - previousValue) * progress + 'px';
}

/*show menu*/
function showMenu(){
    let menu = document.getElementById('menu');
    let clone = menu.cloneNode(true);
    clone.id = 'cloneMenu';
    let status = getStatusMenu(menu.parentElement.querySelector('#burg'));
    let screen = document.getElementById('screen');
    if (status){
        toggleClass(screen, 'activeMenu', 'nonActiveMenu');
        hideScroll(document.body);
        screen.prepend(clone);
        animate(document.getElementById('cloneMenu'), 100, 0, {
            timing: timingLinear,
            draw: changeTransform,
            duration: 200
        });
        let arrA = Array.from(screen.querySelectorAll('a'));
        console.log(arrA);
        arrA.forEach((a)=>{
            a.addEventListener('click', (e)=>{
                if (status){
                    // hideMenuAnimate(screen);
                    document.getElementById('burg').dispatchEvent(new Event('click'));
                }
            });
        });

    } else {
        hideMenuAnimate(screen);
    }
}

function getStatusMenu(trigger){
    if (trigger.classList.contains('active')){
        return true;
    } else {
        return false;
    }
}
function hideMenuAnimate(screen){
    animate(document.getElementById('cloneMenu'), 0, 100, {
        timing: timingLinear,
        draw: changeTransform,
        duration: 200
    }, function (){
        toggleClass(screen, 'activeMenu', 'nonActiveMenu');
        hideScroll(document.body, false);
        screen.innerHTML = '';
    });
}

function changeTransform(elem, progress, previousValue, nextValue){
    elem.style.transform = `translateX(${previousValue + (nextValue - previousValue) * progress}%)`;
}

//show popup
function showPopup(popup, trigger){
    if (!trigger) return;
    trigger.addEventListener('click', ()=>{
        let screen = document.getElementById('screen');
        if (!popup.classList.contains('activePopup')){
            toggleClass(screen, 'activeMenu', 'nonActiveMenu');
            toggleClass(popup, 'activePopup', 'nonActivePopup');
            hideScroll(document.body);
            let burg = document.getElementById('burg');
            let displeyBurg = getComputedStyle(burg).display;
            let statusBurg = false;
            if (displeyBurg != 'none'){
                burg.style.display = 'none';
                statusBurg = true;
            }
            let cross = document.getElementById('cross');
            cross.style.display = 'flex';
            screen.prepend(popup);
            screen.prepend(cross);
            screen.style.overflow = 'scroll';
            animate(popup, 100, 0, {
                timing: timingLinear,
                draw: changeTransformY,
                duration: 200
            });
            cross.addEventListener('click', ()=>{
                if (popup.classList.contains('activePopup')){
                    animate(popup, 0, 100, {
                        timing: timingLinear,
                        draw: changeTransformY,
                        duration: 200
                    });
                    cross.style.display = 'none';
                    document.body.append(cross);
                    document.getElementById('introduce').append(popup);
                    if (statusBurg) burg.style.display = displeyBurg;
                    toggleClass(screen, 'activeMenu', 'nonActiveMenu');
                    console.log(screen, screen.className);
                    toggleClass(popup, 'activePopup', 'nonActivePopup');
                    hideScroll(document.body, false);
                }
            });
        }
    });
}

function hideScroll(elem, trigger = true){
    let before = elem.clientWidth;
    // let set = getComputedStyle(elem).paddingRight.match(/\d+/);
    // set = set[0] ? set[0] : 0;
    let offset;
    if (trigger === true){
        elem.style.overflow = 'hidden';
        offset = elem.clientWidth - before;//17
        if (offset) {
            elem.style.paddingRight = `${offset}px`;//set +
            // elem.addPaddingRight = offset;
        }
    }
    if (trigger === false){
        elem.style.overflow = '';
        offset = elem.clientWidth - before;
        if (offset){
            // if ('addPaddingRight' in elem) {}
            elem.style.paddingRight = `${offset}px`;
        }
    }
}

function changeTransformY(elem, progress, previousValue, nextValue){
    elem.style.transform = `translateY(${previousValue + (nextValue - previousValue) * progress}%)`;
}

function showIllustratiion(elem){
    if (!elem) return;
    let showed = elem.querySelector('.show');
    let hidden = elem.querySelector('.nonshow');
    let select = document.querySelector('form div.radioGroup');
    select.addEventListener('change', ()=>{
        // console.log(showed, hidden, select);
        toggleClass(showed, 'nonshow', 'show');
        toggleClass(hidden, 'show', 'nonshow');
    });
}

function addAttribute(){
    let buttons = document.querySelectorAll('.my-signup');
    for (let button of buttons){
        button.addEventListener('click', (e)=>{
            e.preventDefault();
            let elemTo = document.getElementById('feedback');
            if (elemTo) elemTo.scrollIntoView(true);
        });
    }
}

/*виджет переключения типа консультации*/
function switchLi(ul){
    if (!ul) return;
    let arrLi = Array.from(ul.querySelectorAll('li'));
    arrLi.forEach((li)=>{
        li.addEventListener('click', (e)=>{
            showHiddenLi(ul, arrLi);
            clickHandlerLi(e, arrLi, ul);
        });
    });
}
function showHiddenLi(ul, arrLi){
    if (getComputedStyle(ul).display == 'flex') return;
    let count = 1;
    arrLi.forEach((li)=>{
        if (getComputedStyle(li).display == 'none' && !li.classList.contains('showed')){
            showLi(li, count++);
        } else if (li.classList.contains('showed')){
            hideLi(li);
        }
    });
    count = 1;
}
function clickHandlerLi(e, arrLi, ul){
    if (!e.target.classList.contains('selected')){
        arrLi.forEach((li)=>{
            li.classList.remove('selected');
            document.getElementById(`details-content-${li.dataset.id}`).style.display = 'none';
        });
        e.target.classList.add('selected');
        document.getElementById(`details-content-${e.target.dataset.id}`).style.display = 'flex';
    }
}

function showLi(li, index){
        li.classList.add('showed');
        li.style.display = 'block';
        li.style.transform = `translateY(${index * 100}%)`;
}
function hideLi(li){
        li.classList.remove('showed');
        li.style.display = '';
        li.style.transform = '';
}

function buttongratitude(button){
    button.addEventListener('click', (e)=>{
        let innert = document.getElementById('bodygratitude').querySelectorAll('a');
        let modalbody = document.getElementById('modalbogy');
        for (let a of innert){
            modalbody.append(a);
            a.querySelector('img').style.width = '100%';
            a.querySelector('img').style.height = 'auto';
            a.style.padding = '1rem';
        };
        modalbody.style.display = 'flex';
        modalbody.style.justifyContent = 'space-around';
        document.getElementById('exampleModalLabel').innerHTML = 'Оставить отзыв.';
        document.getElementById('modal').dispatchEvent(new Event('click'));
    });
}

/*отправка письма без перезагрузки страницы*/
function feedback(){
    document.querySelector('body').addEventListener('click', async (e)=>{
        if (e.target.classList.contains('send')){
            e.preventDefault();
            let form = e.target.closest('form');
            let response = await fetch('feedback/fetch', {
                method: 'POST',
                body: new FormData(form)
            });
            let html = await response.text();
            document.getElementById('modalbogy').innerHTML = html;
            document.getElementById('exampleModalLabel').innerHTML = 'Сообщение об отправке.';
            document.getElementById('modal').dispatchEvent(new Event('click'));
        }
    });
}