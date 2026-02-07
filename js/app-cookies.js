//*=============
//*  Cookies   =
//*=============
//*  informer  =
//*=============

jQuery(function ($) {
    "use strict";

    //*=============
    //*  Cookies   =
    //*=============
    _functions.createCookie = function (name, value, days) {
        let expires;

        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        } else {
            expires = "";
        }
        document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
    }

    _functions.readCookie = function (name) {
        let nameEQ = encodeURIComponent(name) + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ')
                c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0)
                return decodeURIComponent(c.substring(nameEQ.length, c.length));
        }
        return null;
    }

    _functions.eraseCookie = function (name) {
        createCookie(name, "", -1);
    }

    if (!_functions.readCookie("my_cookie") == true) {
        setTimeout(function () {
            $('.cookies-informer').addClass('active');
        }, 4000);
    }

    $(document).on('click', '.close-cookies', function () {
        $(this).parents('.cookies-informer').removeClass('active');
    });

    $(document).on('click', '.cookies-informer .set-cookie', function () {
        _functions.createCookie("my_cookie", true, 30);
    });



    //*=============
    //*  informer  =
    //*=============
    $(document).on('click', '.informer-close', function () {
        $(this).closest('.informer').removeClass('is-active');
        $('html').removeClass('promo-active');
        _functions.addScroll();
    })

    $(document).on('click', '.promotional-informer .set-cookie', function () {
        _functions.createCookie("my_sale", true, 1);
    });

    // Promotional informer
    if (!_functions.readCookie("my_sale") == true) {
        setTimeout(() => {
            $('.promotional-informer').addClass('is-active');
            $('html').addClass('promo-active');
            _functions.removeScroll();
        }, 4500);
    }
});