//*==========
//* CART =
//*==========

jQuery(function ($) {
    "use strict";

    const $html = $("html");
    const $cartInner = $('.cart-inner');
    const $cartTotal = $('.js_cart_total');
    const $cartItems = $('.js_cart_items');

    // Open/Close Cart
    $(document).on("click", ".js_cart_open, .js_cart_close", function () {
        const isOpen = $html.hasClass("cart-is-open");
        $html.toggleClass("cart-is-open");

        isOpen ? _functions.addScroll() : _functions.removeScroll();
    });


    // Open/Close Cart is Empty
    $(document).on("click", function (e) {
        const $cartEmpty = $(".h-cart.is-empty");

        if ($cartEmpty.is(e.target) || $cartEmpty.has(e.target).length) {
            $cartEmpty.toggleClass("is-active");
        } else {
            $cartEmpty.removeClass("is-active");
        }
    });


    // Toggle Addons
    $(document).on("click", ".prd-horiz-addons-title", function () {
        const $this = $(this);
        const isActive = $this.hasClass('is-active');

        $this.toggleClass('is-active').next()[isActive ? 'slideUp' : 'slideDown']();
    });


    // Calculate Total Sum in Cart
    _functions.calculateCartTotalPrice = function () {
        let total = 0;
        let totalItems = 0;
        const $products = $('.cart-products .js_product');

        $products.each(function () {
            const $product = $(this);
            const basePrice = +$product.attr('data-price') || 0;
            const quantity = +$product.find('.stepper input').val() || 1;

            // Calculate addons price
            const addonsPrice = $product.find('.prd-horiz-addon')
                .toArray()
                .reduce((sum, addon) => sum + (+$(addon).attr('data-price') || 0), 0);

            // Toggle addons visibility
            const $addonsInner = $product.find('.prd-horiz-addons-inner');
            $addonsInner.toggleClass('d-none', addonsPrice === 0);

            // Calculate and update product total
            const productTotal = (basePrice + addonsPrice) * quantity;
            total += productTotal;
            totalItems += quantity;

            // Update product price display
            const $priceElement = $product.find('.price:not(.old) b').length
                ? $product.find('.price:not(.old) b')
                : $product.find('.price b').last();

            $priceElement.html(productTotal);
        });

        // Update cart total, items count and empty state
        $cartTotal.html(total);
        $cartItems.html(totalItems);
        $cartInner.toggleClass('is-empty', total === 0);

        // Hide/show cart items indicator
        $cartItems.toggleClass('d-none', totalItems === 0);
    };
    _functions.calculateCartTotalPrice();


    // Update total when changing quantity
    $(document).on('click', '.cart-products .stepper .decr, .cart-products .stepper .incr', () => {
        setTimeout(_functions.calculateCartTotalPrice, 50);
    });


    // Remove addon from product
    $(document).on('click', '.js_addon_delete_prd-horiz', function () {
        $(this).fadeOut(200, function () {
            $(this).remove();
            _functions.calculateCartTotalPrice();
        });
    });


    // Remove product from cart  
    $(document).on('click', '.cart-inner .js_product_remove', function () {
        $(this).closest('.js_product').slideUp(300, function () {
            $(this).remove();
            _functions.calculateCartTotalPrice();
        });
    });
});