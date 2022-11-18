document.addEventListener("DOMContentLoaded", ready);

/*header*/
function ready(){
    toggleClassOnEvent('burg', 'active', 'noneActive', 'click');
    eventHoverDelegation(document.getElementById('gallery'), '.mycontainer', overHandler, outHandler);
    adapter(document.getElementById('carousel'));
    showPopup(document.getElementById('popup'), document.getElementById('showpopup'));
    showIllustratiion(document.querySelector('.illustration'));
}

function toggleClassOnEvent(id, classActive, classNonActive, event) {
    let elem;
    if (typeof id == 'string'){
        elem = document.getElementById(id);
    } else {
        elem = id;
    }
    elem.addEventListener(event, () => {
        console.log('щелкнули по burg');
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
    let currentElem = null;
    container.addEventListener('pointerover', pointerover);
    container.addEventListener('pointerout', pointerout);

    function pointerover(e){
        if (currentElem) return;
        let target = e.target.closest(elemSelector);
        if (!target) return;
        currentElem = target;
        // console.log('зашли на - ', currentElem);
        overHandler(currentElem);
    }

    function pointerout(e){
        if (!currentElem) return;
        let relatedTarget = e.relatedTarget;
        while (relatedTarget){
            if (relatedTarget == currentElem) return;
            relatedTarget = relatedTarget.parentNode;
        }
        // console.log('покинули - ', currentElem);
        outHandler(currentElem);
        currentElem = null;
    }
}

function overHandler(elem){
    // console.log('зашли на - ', elem);
    addAndDeleteClass(elem.querySelector('div'), 'myhover');
    addAndDeleteClass(elem.querySelector('span'), 'myhover');
}
function outHandler(elem){
    // console.log('покинули - ', elem);
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
    let instance = new bootstrap.Carousel(carousel, {
        interval: false,
        wrap: false
    })

    let currentImg = carousel.querySelector('div.active img');
    let previousValue = currentImg.clientHeight;

    carousel.addEventListener('slid.bs.carousel', changed);

    function changed() {
        currentImg = carousel.querySelector('div.active img');
        let nextValue = currentImg.clientHeight;
        currentImg.style.width = '100%';
        currentImg.style.height = previousValue;
        animate(currentImg, previousValue, nextValue, {timing: timingLinear, draw: drawHeight, duration: 300});
        previousValue = nextValue;
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
    // clone.removeAttribute('id');
    clone.id = 'cloneMenu';
    let status = getStatusMenu(menu.parentElement.querySelector('#burg'));
    let screen = document.getElementById('screen');
    if (status){
        // if (!screen.classList.contains('activeMenu')) screen.classList.add('activeMenu');
        // if (screen.classList.contains('nonActiveMenu')) screen.classList.remove('nonActiveMenu');
        toggleClass(screen, 'activeMenu', 'nonActiveMenu');
        hideScroll(document.body);
        screen.prepend(clone);
        animate(document.getElementById('cloneMenu'), 100, 0, {
            timing: timingLinear,
            draw: changeTransform,
            duration: 200
        });
    } else {
        // if (screen.classList.contains('activeMenu')) screen.classList.remove('activeMenu');
        // if (!screen.classList.contains('nonActiveMenu')) screen.classList.add('nonActiveMenu');
        animate(document.getElementById('cloneMenu'), 0, 100, {
            timing: timingLinear,
            draw: changeTransform,
            duration: 200
        }, function (){
            // if (screen.classList.contains('activeMenu')) screen.classList.remove('activeMenu');
            // if (!screen.classList.contains('nonActiveMenu')) screen.classList.add('nonActiveMenu');
            toggleClass(screen, 'activeMenu', 'nonActiveMenu');
            hideScroll(document.body, false);
            screen.innerHTML = '';
        });
    }
}

function getStatusMenu(trigger){
    //'active', 'noneActive'
    if (trigger.classList.contains('active')){
        return true;
    } else {
        return false;
    }
}

function changeTransform(elem, progress, previousValue, nextValue){
    elem.style.transform = `translateX(${previousValue + (nextValue - previousValue) * progress}%)`;
}

//show popup
function showPopup(popup, trigger){
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
    let showed = elem.querySelector('.show');
    let hidden = elem.querySelector('.nonshow');
    let select = document.querySelector('form div.radioGroup');
    select.addEventListener('change', ()=>{
        // console.log(showed, hidden, select);
        toggleClass(showed, 'nonshow', 'show');
        toggleClass(hidden, 'show', 'nonshow');
    });
}
