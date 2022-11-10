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
    let exp = new Map();
    exp.set('0', 'Объект');
    exp.set('1', new Map());
    exp.get('1').set('2', new Map());
    exp.get('1').get('2').set('3', '');

    // console.dir(exp);

    getTree(nav);

    function getTree(container){
        let tree = new Map();
        buildTree(nav);
        //исходим из того, что <a> - конечный элемент и не может иметь вложенных <a>
        //если у <a> есть потомки, то они вложены в соседний <ul>
        function buildTree(parent){
            let desc = parent.children;
            if (desc.length > 0){
                for (let child of desc){
                    if (child.tagName == 'A'){
                        // if (getMapElem(tree, child)){
                        //
                        // } else {
                        //
                        // }
                        console.log(findParent(child, nav));

                    } else {

                    }
                }
            }
        }
        function saveA(){

        }

        //рекурсивно ищет ключ в заданном Map, возвращает если найдено [ключ, значение(Map или '')]
        function getMapElem(map, key){
            let result = false;
            getKey(map,key);
            function getKey (map, key){
                for (let entry of map){
                    if (entry[0] === key){
                        result = entry;
                        return;
                    } else if (entry[1] && typeof entry[1] == 'object') {
                        getKey(entry[1], key);
                    }
                }
            }
            return {foundKey: result[0], value: result[1]};
        }
        // console.log(getMapElem(exp, "2"));

        //ищет ближайшего родителя <ul> в пределах nav, затем проверяет, есть ли предыдущий
        //элемент <a>, если есть - это родитель, его возвращает, если нет - false
        function findParent(elemA, nav){
            let parent = false;
            while (!parent === nav){
                let ul = elemA.closest('ul');
                if (ul){
                    let previousElem = ul.previousElementSibling;
                    if (previousElem.tagName == 'A'){
                        parent = previousElem;
                        break;
                    }
                }
            }
            return parent;
        }
    }


    let currentElem = null;
    nav.addEventListener('pointerover', pointerover);
    nav.addEventListener('pointerout', pointerout);

    function pointerover(e){
        if (currentElem) return;
        let target = e.target.closest('a');
        if (!target) return;
        currentElem = target;
        console.log('зашли на - ', currentElem);
        // showSubMenu(currentElem);
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