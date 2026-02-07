//*============
//*  Cabinet  =
//*============

jQuery(function ($) {
    "use strict";

    // Open Cabinet Dropdown
    $(document).on('click', '.h-cabinet:not(.open-popup)', function () {
        $(this).toggleClass('is-active');
    });

    // Close Cabinet Dropdown
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.h-cabinet').length) {
            $('.h-cabinet').removeClass('is-active');
        }
    });

    // Remove Disable from Btn
    $(document).on('change', '.cbn-form .input, .cbn-form select', function () {
        $(this).closest('.cbn-form').find('.btn').removeClass('disabled');
    });

    // Visible Order
    $(document).on('click', '.js_order-det', function () {
        let num = $(this).closest('.order-tr').attr('data-tr');
        $(this).closest('.order-tr').toggleClass('is-active');
        $(`.order-detail[data-tr="${num}"]`).slideToggle(250).toggleClass('is-active');
    });
});