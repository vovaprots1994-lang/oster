//*==========
//* CART =
//*==========

jQuery(function ($) {
    "use strict";

    //checkout tabs
    $('.toggle-block-control').on('change', function () {
        $(this).closest('.form-group').find('.ch-box-wrap.with-border').removeClass('active');
        $(this).closest('.ch-box-wrap.with-border').addClass('active');
        let blockNum = $(this).data('block'),
            rel = $(this).data('rel'),
            $showBlock = $('.toggle-block[data-block="' + blockNum + '"][data-rel="' + rel + '"]'),
            $hideBlock = $('.toggle-block[data-block="' + blockNum + '"]:visible');

        if ($(this).is('input[type="checkbox"]')) {
            $showBlock.slideToggle();
            return;
        }

        if ($hideBlock.length) {
            $hideBlock.slideUp(500, function () {
                $hideBlock.removeClass('active');
                $showBlock.slideDown();
            });
        } else {
            $showBlock.slideDown();
            $showBlock.addClass('active');
        }

    });

    //checkout all sum calculate
    _functions.calculateTotalCheckoutPrice = function () {
        let allSummProduct = 0;
        $('.checkout-products .js_product').each(function () {
            allSummProduct += +$(this).data('price') * +$(this).find('.stepper input').val();
        });

        let allSummCheckout = allSummProduct - +$('.price-discount').html();

        // $('.all-product-price-el').text(_functions.addThousandsSeparator(allSummCheckout));
        $('.all-summ-product, .thank-price-item .price-total').text(allSummProduct);
        $('.all-product-price-el').text(allSummCheckout);

        //show empty cart message
        if (allSummProduct === 0) {
            $('.cart-empty-sec').show();
            $('.section.checkout-sec').hide();
        }
    };

    _functions.calculateTotalCheckoutPrice();

    //checkout item calculate
    $(document).on('click', '.js_product .stepper button', function () {
        console.log('click')
        _functions.calculateTotalCheckoutPrice();

        let prod = $(this).closest('.js_product'),
            productSum = +prod.data('price') * +prod.find('input').val();

            console.log('productSumPrice ', +prod.data('price'));
            console.log('productSuminput ', +prod.find('input').val());

        prod.find('.price b').text(productSum);
        prod.find('.price b').text(productSum);
    });

    //remove product from cart
    $(document).on('click', '.js_product .js_product_remove', function () {
        $(this).closest('.js_product').slideUp(0, function () {
            $(this).remove();
            _functions.calculateTotalCheckoutPrice();
        });
    });

    //clear promocode
    $(document).on('click', '.set-promocode .js-clear-promocode', function () {
        $(this).closest('.input-field').removeClass('invalid success');
    });

});