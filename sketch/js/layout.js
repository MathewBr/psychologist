document.addEventListener("DOMContentLoaded", ready);

/*header*/
function ready(){
    insertData(document.getElementById('data'), document.getElementById('time'));
    menu(document.getElementById('mainMenu'));
}

//widget data and time
function insertData(parentData= false, parentTime = false){
    let lang = parentData.dataset.format ? parentData.dataset.format : window.navigator.language;
    if (parentData){
        parentData.innerHTML = formatterData(lang).format(Date.now());
    }
    if (parentTime){
        pastTime();
        parentTime.timer = setInterval(pastTime, 1000);

        function pastTime(){
            parentTime.innerHTML = formatterTime(lang).format(Date.now());
        }
    }
    function formatterData(locale){ //пятница, 4 ноября 2022 г.
        return new Intl.DateTimeFormat(locale, {
            year: "numeric",
            month: "long",
            day: "numeric",
            weekday: "long",
        });
    }
    function formatterTime(locale){
        return new Intl.DateTimeFormat(locale, {
            hour: "numeric",
            minute: "numeric",
            second: "numeric",
        });
    }
}

/*menu*/
function menu(nav){


    let currentElem = null;
    nav.addEventListener('pointerover', pointerover);
    nav.addEventListener('pointerout', pointerout);

    function pointerover(e){
        if (currentElem) return;
        let target = e.target.closest('a');
        if (!target) return;
        currentElem = target;
        console.log('зашли на - ', currentElem);
        showSubMenu(currentElem);
    }

    function pointerout(e){
        if (!currentElem) return;
        let relatedTarget = e.relatedTarget;
        while (relatedTarget){
            if (relatedTarget == currentElem) return;
            relatedTarget = relatedTarget.parentNode;
        }
        console.log('покинули - ', currentElem);
        currentElem = null;
    }

    function showSubMenu(a){
        let parent = a.parentNode;
        let subUl = parent.childNodes;
        for (let elem of subUl){
            if (elem.tagName == 'UL'){
                if (getComputedStyle(elem).display == 'none'){
                    elem.style.display = 'flex';//inline-block
                    elem.style.zIndex = '999';
                }
            }
        }
    }
    function hideSubMenu(parent){

    }
}