//*====================================
//*  FUNCTIONS ON DOCUMENT READY      =
//*====================================
//*  FUNCTIONS CALC, RESIZE, SCROLL   =
//*====================================
//*  ANIMATION                        =
//*====================================
//*  HEADER                           =
//*====================================
//*  POPUPS                           =
//*====================================
//*  KEY FOCUS, TABS, ACCORDION       =
//*====================================
//*  DYNAMIC LOAD JS                  =
//*====================================
//*  OTHER JS                         =
//*====================================

const _functions = {};
let winW, winH, winScr, isTouchScreen, isAndroid, isChrome, isIPhone, isMac, isSafari, isFirefox;

jQuery(function ($) {
    "use strict";

    //*================================
    //*  FUNCTIONS ON DOCUMENT READY  =
    //*================================
    isTouchScreen = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i),
        isAndroid = navigator.userAgent.match(/Android/i),
        isChrome = navigator.userAgent.indexOf('Chrome') >= 0 && navigator.userAgent.indexOf('Edge') < 0,
        isIPhone = navigator.userAgent.match(/iPhone/i),
        isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0,
        isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent),
        isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;


    if (isTouchScreen) $('html').addClass('touch-screen');
    if (isAndroid) $('html').addClass('android');
    if (isChrome) $('html').addClass('chrome');
    if (isIPhone) $('html').addClass('ios');
    if (isMac) $('html').addClass('mac');
    if (isSafari) $('html').addClass('safari');
    if (isFirefox) $('html').addClass('firefox');




    //*===================================
    //*  FUNCTIONS CALC, RESIZE, SCROLL  =
    //*===================================
    // Function Calculations on page
    _functions.pageCalculations = function () {
        winW = $(window).outerWidth();
        winH = $(window).outerHeight();
    }
    _functions.pageCalculations();

    /* Function on page scroll */
    $(window).on('scroll', function () {
        _functions.scrollCall();
    });


    var prev_scroll = 0;
    _functions.scrollCall = function () {
        winScr = $(window).scrollTop();

        if (winScr > $('header').innerHeight()) {
            $('header').addClass('scrolled');

        } else if (winScr <= $('header').innerHeight()) {
            $('header').removeClass('scrolled');
            prev_scroll = 0;
        }

        prev_scroll = winScr;
    }
    _functions.scrollCall();


    /* Function on page resize */
    _functions.resizeCall = function () {
        setTimeout(function () {
            _functions.pageCalculations();
        }, 100);
    };


    if (!isTouchScreen) {
        $(window).on('resize', function () {
            _functions.resizeCall();
        });

    } else {
        window.addEventListener("orientationchange", function (e) {

            // Portrait
            if (window.orientation == 0) {
                $('html').removeClass('landscape');
            }
            // Landscape
            else {
                $('html').addClass('landscape');
            }

            _functions.resizeCall();
        }, false);
    }




    //*==============
    //*  ANIMATION  =
    //*==============
    const observerFunction = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;

            entry.target.classList.add('|', 'animated')
            observer.unobserve(entry.target)
        })

    }, {
        root: null,
        threshold: 0,
        rootMargin: (window.innerWidth > 767) ? "-50px" : "0%"
    });

    document.querySelectorAll('.section').forEach(block => {
        observerFunction.observe(block)
    });




    //*===========
    //*  HEADER  =
    //*===========
    if (winW < 1200) {
        // Open menu
        $(document).on('click', '.js-open-menu', function () {
            $('html').toggleClass('overflow-menu');
            $('header').toggleClass('open-menu');
        });

        // Close menu
        $(document).on('click', '.h-menu-overlay', function () {
            $('html').removeClass('overflow-menu');
            $('header').removeClass('open-menu');
        });
    }



    //*===========
    //*  POPUPS  =
    //*===========
    _functions.scrollWidth = function () {
        let scrWidth = $(window).outerWidth() - $('body').innerWidth();

        $('body, .h-wrap').css({
            "paddingRight": `${scrWidth}px`
        });
    }


    // Popups Functions
    let popupTop = 0;
    _functions.removeScroll = function () {
        _functions.scrollWidth();
        popupTop = winScr;
        $('html').css({
            "top": '-' + winScr,
            "width": "100%"
        }).addClass("overflow-hidden");
    }

    _functions.addScroll = function () {
        _functions.scrollWidth();
        $('html').removeClass("overflow-hidden");
        window.scroll(0, popupTop);
    }

    _functions.openPopup = function (popup) {
        $('.popup-content').removeClass('active');
        $(popup + ', .popup-wrapper').addClass('active');
        _functions.removeScroll();
    };

    _functions.closePopup = function () {
        $('.popup-wrapper, .popup-content').removeClass('active');
        $('.video-popup iframe').remove();
        _functions.addScroll();
    };

    // Close  popup
    $(document).on('click', '.popup-content .close-popup, .popup-content .layer-close', function (e) {
        e.preventDefault();
        _functions.closePopup();
    });

    // Ajax popup
    $(document).on('click', '.open-popup', function (e) {
        const popupWrapper = document.getElementById("popups");

        if (e.target.closest('.open-popup')) {
            let dataRel = e.target.closest('.open-popup').getAttribute('data-rel');
            e.preventDefault();

            if (popupWrapper.hasChildNodes()) {
                _functions.openPopup('.popup-content[data-rel="' + dataRel + '"]');

            } else {
                const ajaxPopup = new XMLHttpRequest();

                ajaxPopup.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        popupWrapper.innerHTML = this.responseText;

                        setTimeout(function () {
                            _functions.initSelect('.popup-wrapper');
                            _functions.initMask()
                            _functions.openPopup('.popup-content[data-rel="' + dataRel + '"]');
                        }, 50);
                    }
                };
                ajaxPopup.open("GET", "inc/popups/_popups.php", true);
                ajaxPopup.send();
            }
        }
    });




    //*===============================
    //*  KEY FOCUS, TABS, ACCORDION  =
    //*===============================
    // Detect if user is using keyboard tab-button to navigate
    // with 'keyboard-focus' class we add default css outlines
    function keyboardFocus(e) {
        if (e.keyCode !== 9) {
            return;
        }

        switch (e.target.nodeName.toLowerCase()) {
            case 'input':
            case 'select':
            case 'textarea':
                break;
            default:
                document.documentElement.classList.add('keyboard-focus');
                document.removeEventListener('keydown', keyboardFocus, false);
        }
    }
    document.addEventListener('keydown', keyboardFocus, false);

    // tabs
    $(document).on('click', '._tab-item', function () {
        let tab = $(this).closest('._tabs').find('._tab');
        let i = $(this).index();

        $(this).addClass('is-active').siblings().removeClass('is-active');
        tab.eq(i).siblings('._tab:visible').stop().finish().fadeOut(function () {
            tab.eq(i).fadeIn(200);
        });
    });

    // accordion
    $(document).on('click', '.accordion-title', function () {
        if ($(this).hasClass('is-active')) {
            $(this).removeClass('is-active').next().slideUp();
        } else {
            $(this).closest('.accordion').find('.accordion-title').not(this).removeClass('is-active').next().slideUp();
            $(this).addClass('is-active').next().slideDown();
        }
    });



    //*====================
    //*  DYNAMIC LOAD JS  =
    //*====================
    const videoObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;

            _functions.videoLoad(entry.target);
            observer.unobserve(entry.target)
        })
    }, {
        root: document,
        rootMargin: "50%",
    });

    document.querySelectorAll(".video").forEach((element) => {
        videoObserver.observe(element);
    });

    _functions.videoLoad = function (block) {
        let videoBlock = $(block).find('video'),
            videoSrc = videoBlock.data('src');
        videoBlock.attr('src', videoSrc);
    };

    //activate autoplay video
    if ($('.video').length) {
        $(this).find('video').attr("autoplay", "");
    }




    //*=============
    //*  OTHER JS  =
    //*=============
    // Seo block
    $(document).on("click", ".seo-btn", function () {
        let th = $(this);
        let parent = th.closest('.seo-block');

        th.toggleClass('is-active');
        parent.find('.more-content').slideToggle(600);
    });

    // Marquee
    function marqueeBlock() {
        class LoopingElement {
            constructor(e, t, a, o) {
                (this.element = e),
                    (this.currentTranslation = t),
                    (this.speed = a),
                    (this.originalSpeed = a),
                    (this.direction = !0),
                    (this.scrollTop = 0),
                    (this.metric = 100),
                    (this.lerp = {
                        current: this.currentTranslation,
                        target: this.currentTranslation,
                        factor: 0.2,
                    }),
                    this.render(),
                    (this.go = o
                        ? ((this.direction = !0),
                            (this.lerp.target += 2 * this.speed))
                        : ((this.direction = !1),
                            (this.lerp.target -= 2 * this.speed)));
            }
            lerpFunc(e, t, a) {
                this.lerp.current = e * (1 - a) + t * a;
            }
            goForward() {
                (this.lerp.target += this.speed),
                    this.lerp.target > this.metric &&
                    ((this.lerp.current -= 2 * this.metric),
                        (this.lerp.target -= 2 * this.metric));
            }
            goBackward() {
                (this.lerp.target -= this.speed),
                    this.lerp.target < -this.metric &&
                    ((this.lerp.current -= 2 * -this.metric),
                        (this.lerp.target -= 2 * -this.metric));
            }
            animate() {
                this.direction ? this.goForward() : this.goBackward(),
                    this.lerpFunc(
                        this.lerp.current,
                        this.lerp.target,
                        this.lerp.factor
                    ),
                    this.element.style.setProperty(
                        "--x",
                        this.lerp.current + "%"
                    );
            }
            render() {
                this.animate(),
                    window.requestAnimationFrame(() => this.render());
            }
            setSpeed(speed) {
                this.speed = speed;
            }
            setDirection(direction) {
                this.direction = direction;
            }
            resetSpeed() {
                this.speed = this.originalSpeed;
            }
        }

        document.querySelectorAll(".marquee-line").forEach((el) => {
            const spd =
                winW < 768
                    ? Number(el.dataset.mobile)
                    : Number(el.dataset.speed);
            const dir = el.dataset.direction === "false" ? "" : "false";

            const firstItem = el.querySelector(".marquee-item");
            const content = firstItem.querySelector(
                `:scope ${".marquee-content"}`
            );

            let eq = Math.ceil(el.offsetWidth / content.offsetWidth);

            for (let i = 0; i < eq; i++) {
                firstItem.appendChild(content.cloneNode(true));
            }

            el.appendChild(firstItem.cloneNode(true));

            let item = el.querySelectorAll(".marquee-item");

            const loopingElement1 = new LoopingElement(item[0], 0, spd, dir);
            const loopingElement2 = new LoopingElement(item[1], -100, spd, dir);

            function handleDragStart(clientX, clientY) {
                return { startX: clientX, startY: clientY };
            }

            function handleDragMove(startX, startY, currentX, currentY, e) {
                if (!startX || !startY) return;

                let diffX = startX - currentX;
                let diffY = startY - currentY;

                if (Math.abs(diffX) > Math.abs(diffY)) {
                    if (e && e.preventDefault) e.preventDefault();

                    let dragSpeed = Math.min(Math.abs(diffX) / 2, spd * 8);
                    loopingElement1.setSpeed(dragSpeed);
                    loopingElement2.setSpeed(dragSpeed);

                    if (diffX > 0) {
                        loopingElement1.setDirection(false);
                        loopingElement2.setDirection(false);
                    } else {
                        loopingElement1.setDirection(true);
                        loopingElement2.setDirection(true);
                    }
                }
            }

            function handleDragEnd() {
                setTimeout(() => {
                    loopingElement1.resetSpeed();
                    loopingElement2.resetSpeed();
                    loopingElement1.setDirection(dir ? true : false);
                    loopingElement2.setDirection(dir ? true : false);
                }, 100);
            }

            if (isTouchScreen) {
                let touchData = {};

                el.addEventListener('touchstart', function (e) {
                    touchData = handleDragStart(e.touches[0].clientX, e.touches[0].clientY);
                }, { passive: true });

                el.addEventListener('touchmove', function (e) {
                    handleDragMove(touchData.startX, touchData.startY, e.touches[0].clientX, e.touches[0].clientY, e);
                }, { passive: false });

                el.addEventListener('touchend', function (e) {
                    handleDragEnd();
                    touchData = {};
                }, { passive: true });
            }

            if (!isTouchScreen) {
                let mouseData = {};
                let isDragging = false;

                el.addEventListener('mousedown', function (e) {
                    isDragging = true;
                    mouseData = handleDragStart(e.clientX, e.clientY);
                    e.preventDefault();
                });

                el.addEventListener('mousemove', function (e) {
                    if (!isDragging) return;
                    handleDragMove(mouseData.startX, mouseData.startY, e.clientX, e.clientY, e);
                });

                el.addEventListener('mouseup', function (e) {
                    if (!isDragging) return;
                    isDragging = false;
                    handleDragEnd();
                    mouseData = {};
                });

                el.addEventListener('mouseleave', function (e) {
                    if (!isDragging) return;
                    isDragging = false;
                    handleDragEnd();
                    mouseData = {};
                });
            }
        });
    }
    marqueeBlock();

});