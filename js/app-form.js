//*==============
//*  Inputs     =
//*==============
//*  Inputmask  =
//*==============
//*  Select     =
//*==============
//*  Calendar   =
//*==============

jQuery(function ($) {
    "use strict";
    $(document).on("click", "[disabled], .disabled", function (e) {
        e.preventDefault();
    });

    //*==============
    //*  Inputs     =
    //*==============
    $(document).on('focus', '.input-field .input, .input-button-wrap .input', function () {
        $(this).closest('.input-field').addClass('focus');
    });
    $(document).on('blur', '.input-field .input, .input-button-wrap .input', function () {
        $(this).closest('.input-field').removeClass('focus');
    });
    $(document).on('keyup', '.input-field .input', function () {
        if ($(this).val()) $(this).closest('.input-field').addClass('value');
        else $(this).closest('.input-field').removeClass('value');
    });


    // Invalid Input
    $(document).on('blur', '.input-field .input[required]', function () {
        if ($(this).val().trim()) {
            $(this).closest('.input-field').removeClass('invalid');
        } else {
            $(this).closest('.input-field').addClass('invalid');
        }
    });


    // Check if input has value or autofill
    $(document).ready(function () {
        $('.input-field .input').each(function () {
            let th = $(this);
            if (th.val()) {
                th.closest('.input-field').addClass('value');
            }
        });

        $('.input-field .input:-webkit-autofill').each(function () {
            let th = $(this);

            th.closest('.input-field').addClass('value');
        });
    });


    // Validate email
    _functions.validateEmail = function (email) {
        let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    $(document).on('keyup', 'input[type="email"]', function () {
        const email = $(this);

        if (!_functions.validateEmail(email.val())) {
            email.closest('.input-field').addClass('invalid-email');
        } else {
            email.closest('.input-field').removeClass('invalid-email');
        }

        if (email.val() == '') {
            email.closest('.input-field').removeClass('invalid-email');
        }
    });

    // Password Hide/Show
    $(document).on('click', '.password-control', function () {
        let thisInput = $(this).siblings('.input');

        if (thisInput.attr('type') == 'password') {
            $(this).addClass('view');
            thisInput.attr('type', 'text');
        } else {
            $(this).removeClass('view');
            thisInput.attr('type', 'password');
        }
        return false;
    });

    // Edit input address
    $(document).on('click', '.input-edit', function (e) {
        e.preventDefault();

        const thisInput = $(this).closest('.input-field').find('.input');
        const inputEl = thisInput[0];

        thisInput.focus();

        const valueLength = inputEl.value.length;
        inputEl.setSelectionRange(valueLength, valueLength);
    });

    // Remove input address
    $(document).on('click', '.input-remove', function (e) {
        e.preventDefault();

        $(this).closest('.col-12').remove();
    });


    function stopResendTimer() {
        $('.text-count[data-time]').each(function () {
            var $el = $(this);
            if ($el.data('timerId')) {
            clearInterval($el.data('timerId'));
            $el.removeData('timerId');
            }
        });
    }

    function startResendTimer() {
        stopResendTimer();

        $('.text-count[data-time]').each(function () {
        var $el = $(this);
        var time = parseInt($el.attr('data-time'), 10) || 15;

        $el.text(time);

        var timer = setInterval(function () {
            time--;
            $el.text(time);
            if (time <= 0) {
            clearInterval(timer);
            }
        }, 1000);

        $el.data('timerId', timer);
        });
    }

    $(document).on('click', '.open-popup[data-rel="8-2"]', function () {
        setTimeout(startResendTimer, 150);
    });

    $(document).on('click', '.close-popup[data-rel="8-2"]', function () {
        stopResendTimer();
    });


    //*==============
    //*  Inputmask  =
    //*==============
    _functions.initMask = function () {
        if ($('.input[type="tel"]').length) {
            $('.input[type="tel"]').inputmask({
                mask: "+380 (99) 999 99 99",
                placeholder: "_",
                showMaskOnHover: false,
                showMaskOnFocus: false,
                clearMaskOnLostFocus: false,
                definitions: {
                    '9': {
                        validator: "[0-9]"
                    }
                }
            });
        }
    }

    _functions.initMask()


    //*==============
    //*  Select     =
    //*==============
    _functions.initSelect = function (parent) {
        $("" + parent + " .SelectBox").each(function () {
            if ($(".SelectBox[multiple]")) {
                $(this).SumoSelect({
                    floatWidth: 0,
                    nativeOnDevice: [],
                    okCancelInMulti: true,
                    csvDispCount: 1,
                    captionFormat: '{0} Selected',
                    locale: ['Ok', 'Cancel', 'All'],
                    placeholder: ''
                });
            } else {
                $(this).SumoSelect({
                    floatWidth: 0,
                    nativeOnDevice: [],
                    placeholder: ''
                });
            }


            $(this).on('sumo:opened', function () {
                $(this).closest('.input-field').addClass('focus');
            });

            $(this).on('sumo:closed', function () {
                $(this).closest('.input-field').removeClass('focus');
            });
        });
    }

    _functions.initSelect('html');



    $(document).ready(function () {
        if ($('select').val()) {
            $(this).closest('.input-field').addClass('value');
        } else {
            $(this).closest('.input-field').removeClass('value');
        }
    });

    $(document).on('change', 'select', function () {
        if ($(this).val()) {
            $(this).closest('.input-field').addClass('value');
        } else {
            $(this).closest('.input-field').removeClass('value');
        }
    });



    //*==============
    //*  Calendar   =
    //*==============
    // https://wakirin.github.io/Lightpick/
    _functions.initCalendar = function (selector = document) {
        $(selector).find(".calendar").each(function () {
            const calendar = $(this);
            const isSingle = Boolean(calendar.attr("data-single"));

            const options = {
                field: calendar.get(0),
                parentEl: calendar.closest(".input-field").get(0),
                autoclose: true,
                lang: "ua",
                format: "DD.MM.YYYY",
                singleDate: isSingle,
                selectForward: true,
                selectBackward: false,
                // minDate: new Date(), // Встановлюється динамічно нижче
                // minDays: 3,
                // maxDays: 7,
                // numberOfMonths: 6,
                // numberOfColumns: 3,
                footer: false,
                locale: {
                    buttons: {
                        prev: '',
                        next: '',
                        close: '',
                        reset: 'Скасувати',
                        apply: 'Підтвердити'
                    },
                    tooltip: {
                        one: 'День',
                        few: 'Дні',
                        many: 'Днів',
                        other: 'Днів'
                    },
                    pluralize: function (i, locale) {
                        if ('one' in locale && i % 10 === 1 && !(i % 100 === 11)) return locale.one;
                        if ('few' in locale && i % 10 === Math.floor(i % 10) && i % 10 >= 2 && i % 10 <= 4 && !(i % 100 >= 12 && i % 100 <= 14)) return locale.few;
                        if ('many' in locale && (i % 10 === 0 || i % 10 === Math.floor(i % 10) && i % 10 >= 5 && i % 10 <= 9 || i % 100 === Math.floor(i % 100) && i % 100 >= 11 && i % 100 <= 14)) return locale.many;
                        if ('other' in locale) return locale.other;

                        return '';
                    }
                },
                onOpen: function () {
                    calendar.closest(".input-field").removeClass("invalid");
                },
                // onSelect: function (start, end) {
                //   console.log(start)
                //   console.log(end)

                //   if (!isSingle) {
                //     let str = '';
                //     str += start ? start.format('DD.MM.YYYY') + ' - ' : '';
                //     str += end ? end.format('DD.MM.YYYY') : '';

                //     if (str.length > 0) {
                //       calendar.closest(".input-field").addClass("value");
                //     }

                //     calendar.val(str);
                //   }
                // },
                onClose: function () {
                    if (calendar.attr("required")) {
                        calendar.closest(".input-field").addClass("invalid");

                    } else {
                        calendar.closest(".input-field").removeClass("invalid");
                    }

                    if (calendar.val().length > 0) {
                        calendar.closest(".input-field").addClass("value");

                    } else {
                        calendar.closest(".input-field").removeClass("value");
                    }
                },
            };

            const max = calendar.attr("data-max");
            if (max) options.maxDate = max;

            const birth = calendar.hasClass("birthday");
            if (birth) options.maxDate = new Date();

            const min = calendar.attr("data-min");
            if (min) {
                options.minDate = moment(min, 'YYYY-MM-DD');
            } else {
                options.minDate = new Date();
            }

            calendar.get(0)._picker = new Lightpick(options);

            calendar.attr("readonly", "readonly");

            calendar.closest(".input-field").append('<i class="input-clear"></i>')
        });
    };

    _functions.initCalendar();

});