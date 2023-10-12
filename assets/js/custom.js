$(document).ready(() => {
    $('.sidenav').sidenav();
    $('.tabs').tabs();
    $('.datepicker').datepicker();
    $('select').formSelect();
    $('.timepicker').timepicker();
    $('.collapsible').collapsible();

    var elem = document.querySelector('.collapsible.expandable');
    var instance = M.Collapsible.init(elem, {
    accordion: false
    })

    var elem2 = document.querySelector('.coll-1');
    var instance2 = M.Collapsible.init(elem2, {
    accordion: false
    })

    var elem3 = document.querySelector('.coll-2');
    var instance2 = M.Collapsible.init(elem3, {
    accordion: false
    })

    var elem4 = document.querySelector('.coll-3');
    var instance2 = M.Collapsible.init(elem4, {
    accordion: false
    })
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();

        //>=, not <=
        if (scroll >= 10) {
            $('nav.white')[0].classList.add('box-shadow')
        } else {
            $('nav.white')[0].classList.remove('box-shadow')
        }
    });

    AOS.init();
})