

function setCookie(cname, cvalue, exdays = 1) {
    let d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();

    let cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    //console.log(cookie);
    document.cookie = cookie;
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            let cookie = c.substring(name.length, c.length);

            //console.log(cookie);
            return cookie;
        }
    }
    return "";
}



(function() {

    /*
    let navbarHeight = $("#demoNavbar").outerHeight();

    let $body = $("body");
    let marginTop = $body.css("margin-top");
    $body.css("margin-top", "+=" + navbarHeight + "px");

    console.log($body.css("margin-top"));
    */


    //console.log(getCookie("demoUcrmKey"));


})();




function applyClick() {

    let $demoUcrmUrl = $("#demoUcrmUrl");
    let $demoUcrmKey = $("#demoUcrmKey");
    let $demoLanguage = $("#demoLanguage");

    setCookie("demoUcrmUrl", $demoUcrmUrl.val());

    //console.log($demoUcrmUrl.val());
    setCookie("demoUcrmKey", $demoUcrmKey.val());

    //console.log($demoUcrmKey.val());
    setCookie("demoLanguage", $demoLanguage.val());


    //event.preventDefault();
}


$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
    if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
    }
    var $subMenu = $(this).next(".dropdown-menu");
    $subMenu.toggleClass('show');


    $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
        $('.dropdown-submenu .show').removeClass("show");
    });


    return false;
});