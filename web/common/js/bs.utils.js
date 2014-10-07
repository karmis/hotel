var BS = {
    Utils: {

    },
    Forms: {
        Collection: {}
    },
    Temp: {
        Forms: {
            Collection: {
                common: {
                    items: {}
                }
            }
        }
    }
};
// FORMS
// Add/Remove collection field //
// Only this call
BS.Forms.Collection.init = function (arr, settings) {
//    BS.Temp.Forms.Collection.common.items = {};
    if (!settings) {
        var setting = {};
    }
    var defSettings = {
        remove: true,
        add: true,
        events: {},
        max: 5,
        classes: {
            addBtn: "btn btn-small btn-darkbrown",
            removeBtn: "btn btn-small btn-black"
        }
    };

    var sett = BS.Temp.Forms.Collection.common.settings = $.extend(true, defSettings, settings);
    var items = BS.Forms.Collection.getItems(arr, sett);
    BS.Forms.Collection.add(items, sett);
}

BS.Forms.Collection.getItems = function(arr, sett, forLast){
    var aL = arr.length;
    var current = {};
    var lastSel = ":last";
    if(!forLast){
        lastSel = "";
    }
    for (var i = aL - 1; i >= 0; i--) {
        var id = arr[i].substr(1);
        current[id] = {};

        current[id].holder = $(arr[i]);
        if (sett.remove === true) {
            current[id].holder.find('li' + lastSel).each(function () {
                BS.Forms.Collection.remove($(this), sett,  id);
            });

//            current[id].holder.children().each(function () {
//                BS.Forms.Collection.remove($(this), sett, id);
//            });
        }

        if (sett.add === true) {
            current[id] = BS.Forms.Collection.appendAddButton(current[id], sett, id);
        }
    }

    return current;
}

BS.Forms.Collection.appendAddButton = function(current, sett, id){
    current.addLink = $('<a href="#" >Добавить</a>').attr('id', "add_link_" + id).addClass(sett.classes.addBtn);
    current.newLinkLi = $('<li></li>').append(current.addLink);
    current.holder.append(current.newLinkLi);
    current.holder.data('index', current.holder.find(':input').length);

    return current;
}

//BS.Forms.Collection.reinit = function(arr, settings){
//    if(!settings) {
//        settings = BS.Temp.Forms.Collection.common.setting;
//    }
//}

BS.Forms.Collection.remove = function($tagFormLi, sett, id) {
    var $removeFormA = $('<a class="btn btn-danger btn-sm" href="#">Удалить</a>').addClass(sett.classes.removeBtn);
//    debugger;
    $tagFormLi.append($removeFormA);
//    $tagFormLi.insertAfter($removeFormA);
    $removeFormA.on('click', function (e) {
        e.preventDefault();
        $tagFormLi.remove();
    });
}

BS.Forms.Collection.add = function(items, sett) {
    $.each(items, function (key, current) {
        current.addLink.on('click', function (e) {
            e.preventDefault();
            var prototype = current.holder.data('prototype');
            var index = current.holder.data('index');
            var newForm = prototype.replace(/__name__/g, index);
            current.holder.data('index', index + 1);
            $neForm = $(newForm);
            BS.Forms.Collection.remove($neForm, sett);
            current.newLinkLi.before($neForm);
            if(BS.Temp.Forms.Collection.common.settings.included && BS.Temp.Forms.Collection.common.settings.included.length > 0) {
                $.each(BS.Temp.Forms.Collection.common.settings.included, function(key, sel){

                    if($neForm.find(sel).length > 0){
                        var sel = "#" + $neForm.find('div[data-included-id]').attr('id');
                        BS.Forms.Collection.add(BS.Forms.Collection.getItems([sel], BS.Temp.Forms.Collection.common.settings))
                    }
                });
            }
        });
    });
}

// Translit
BS.Utils.translit = function(word){
    var answer = ""
        , a = {};

    a["Ё"]="YO";a["Й"]="I";a["Ц"]="TS";a["У"]="U";a["К"]="K";a["Е"]="E";a["Н"]="N";a["Г"]="G";a["Ш"]="SH";a["Щ"]="SCH";a["З"]="Z";a["Х"]="H";a["Ъ"]="_";
    a["ё"]="yo";a["й"]="i";a["ц"]="ts";a["у"]="u";a["к"]="k";a["е"]="e";a["н"]="n";a["г"]="g";a["ш"]="sh";a["щ"]="sch";a["з"]="z";a["х"]="h";a["ъ"]="_";
    a["Ф"]="F";a["Ы"]="I";a["В"]="V";a["А"]="a";a["П"]="P";a["Р"]="R";a["О"]="O";a["Л"]="L";a["Д"]="D";a["Ж"]="ZH";a["Э"]="E";
    a["ф"]="f";a["ы"]="i";a["в"]="v";a["а"]="a";a["п"]="p";a["р"]="r";a["о"]="o";a["л"]="l";a["д"]="d";a["ж"]="zh";a["э"]="e";
    a["Я"]="Ya";a["Ч"]="CH";a["С"]="S";a["М"]="M";a["И"]="I";a["Т"]="T";a["Ь"]="_";a["Б"]="B";a["Ю"]="YU";
    a["я"]="ya";a["ч"]="ch";a["с"]="s";a["м"]="m";a["и"]="i";a["т"]="t";a["ь"]="_";a["б"]="b";a["ю"]="yu";a[" "]="_";

    for (i in word){
        if (word.hasOwnProperty(i)) {
            if (a[word[i]] === undefined){
                answer += word[i];
            } else {
                answer += a[word[i]];
            }
        }
    }
    return answer.toLowerCase();
}