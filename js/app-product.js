//*====================================
//*  Product                          =
//*====================================

jQuery(function ($) {
    "use strict";

    // Thousands separator
    _functions.addThousandsSeparator = function (number, separator = " ") {
        let numberString = number.toString();
        numberString = numberString.replace(/\B(?=(\d{3})+(?!\d))/g, separator);
        return numberString;
    };

    //remove product from card
    $(document).on("click", ".js_product_remove", function () {
        $(this).closest(".js_cart-product").slideUp(300, function () {
            $(this).remove();

            if ($(".js_cart-product").length == 0) {
                $(".cart-products").html("");
            }

            _functions.calculateCartTotalPrice();
        });
    });

    // Order Button Click Animation Example
    $(document).on('click', '.js_order_btn', function () {
        $(this).addClass('loading');

        let nameProduct = $(this).parents('.js_product').find('.js_product_title').html();

        setTimeout(() => {
            $(this).removeClass('loading');
            $('.cart-informer').addClass('is-active');
            $('.cart-informer').find('.text b').html(nameProduct);

            setTimeout(() => {
                $('.cart-informer').removeClass('is-active');
            }, 2000);
        }, 2000);
    })

    // calculate single product
    _functions.calculateSinglePrice = function ($parentEl) {
        let singleProd = $parentEl,
            summProduct = 0;

        summProduct = singleProd.attr('data-price') * +singleProd.find('.stepper input').val();

        $('.js_product-detail').find('.price b').html(_functions.addThousandsSeparator(summProduct));

    };

    // product_variations color
    $(document).on('click', '.product-variations-color .color-variation', function (e) {
        let $this = $(this)
        $this.addClass('active').siblings().removeClass('active');
    });

    // product_variations
    $(document).on('click', '.product-variations-wrapper .product-variation', function (e) {
        let $this = $(this),
            price = $this.attr('data-price');

        $this.addClass('active').siblings().removeClass('active');
        $('.js_product-detail').find('.price b').html(price);
        _functions.calculateSinglePrice($(this).closest('.js_product-detail'));

    });

    // calculate product detail
    $(document).on('click', '.js_product-detail .stepper button', function () {
        _functions.calculateSinglePrice($(this).closest('.js_product-detail'));
    });


    // ADDONS
function calculateProductPrice($productCard) {
    const basePrice = parseInt($productCard.attr('data-variation-price')) || parseInt($productCard.attr('data-price')) || 0;
    const qty = parseInt($productCard.find('.prd-detail-controls .stepper input').val()) || 1;

    let addonsTotal = 0;
    $productCard.find('.addon.active').each(function () {
        const addonPrice = parseInt($(this).attr('data-addon-price')) || 0;
        const addonQty = parseInt($(this).find('input').val()) || 0;
        addonsTotal += addonPrice * addonQty;
    });

    const totalPrice = (basePrice + addonsTotal) * qty;

    const priceEl = $productCard.find('.prd-detail-controls .price:not(.old) b');

    if($productCard.closest('.popup-content').hasClass('active')){
        const priceElPopup = $productCard.closest('.popup-content').find('.prd-detail-controls .price:not(.old) b');
        priceElPopup.html(totalPrice);
    }

    priceEl.html(totalPrice);;
}

    function addProductAddon($productCard, addonId) {
        const $addon = $productCard.find(`.js-addon[data-addon-id=${addonId}]`);
        const $addonQtyInput = $addon.find("input");
        const addonQty = +$addonQtyInput.val();

        $addonQtyInput.val(addonQty + 1);
        $addon.addClass("active");

        calculateProductPrice($productCard);
    }

    function removeProductAddon($productCard, addonId, removeAll = false) {
        const $addon = $productCard.find(`.addon[data-addon-id=${addonId}]`);
        const $addonQtyInput = $addon.find("input");
        const addonQty = +$addonQtyInput.val();

        if (addonQty == 1) {
            $addon.removeClass("active");
            $addonQtyInput.val(0);
        } else if (addonQty > 0) {
            $addonQtyInput.val(addonQty - 1);
        }

        calculateProductPrice($productCard);
    }

    $(document).on("click", ".js_product .addons-stepper .incr", function () {
        const addonId = $(this).closest("[data-addon-id]").attr("data-addon-id");
        addProductAddon($(this).closest(".js_product"), addonId);
    });

    $(document).on("click", ".js_product .addons-stepper .decr", function () {
        const addonId = $(this).closest("[data-addon-id]").attr("data-addon-id");
        removeProductAddon($(this).closest(".js_product"), addonId);
    });

    $(document).on("click", ".js_product .addon.active .addon__image, .js_product .addon.active .addon__title", function () {
        const addonId = $(this).closest("[data-addon-id]").attr("data-addon-id");
        removeProductAddon($(this).closest(".js_product"), addonId, true);
    });

    $(document).on("click", ".js_product .addon:not(.active) .addon__image, .js_product .addon:not(.active) .addon__title", function () {
        const addonId = $(this).closest("[data-addon-id]").attr("data-addon-id");
        addProductAddon($(this).closest(".js_product"), addonId);
    });

    $(document).on("click", ".prd-detail-controls .prd-stepper .incr", function () {
        const $productCard = $(this).closest(".js_product");
        const $input = $(this).siblings("input");
        $input.val(+$input.val() + 1);
        calculateProductPrice($productCard);
    });

    $(document).on("click", ".prd-detail-controls .prd-stepper .decr", function () {
        const $productCard = $(this).closest(".js_product");
        const $input = $(this).siblings("input");
        const val = Math.max(1, +$input.val() - 1);
        $input.val(val);
        calculateProductPrice($productCard);
    });

    //*====================================
    //*  Product Card                     =
    //*====================================
    // Counter Value from Data-attribute
    _functions.initProductCounters = function () {
        $('.js_order_btn').each(function () {
            const $btn = $(this);
            const countValue = $btn.attr('data-count-prd') || '1';
            const $counter = $btn.find('.js_prd_count');

            $counter.text(countValue);

            if (parseInt(countValue) > 1) {
                $btn.addClass('is-visible');
            }
        });
    };
    _functions.initProductCounters();


    // Counter Decrement Click
    $(document).on('click', '.js_order_btn .decr', function (e) {
        e.stopPropagation();
        e.preventDefault();

        const $btn = $(this).closest('.js_order_btn');
        const $counter = $btn.find('.js_prd_count');
        let currentValue = parseInt($btn.attr('data-count-prd')) || 1;

        if (currentValue > 1) {
            currentValue--;
            $btn.attr('data-count-prd', currentValue);
            $counter.text(currentValue);
            if (currentValue <= 1) {
                $btn.removeClass('is-visible');
            }
        }
    });


    // Counter Increment Click
    $(document).on('click', '.add-to-cart .incr', function (e) {
        e.stopPropagation();
        e.preventDefault();

        const $btn = $(this).closest('.js_order_btn');
        const $counter = $btn.find('.js_prd_count');
        let currentValue = parseInt($btn.attr('data-count-prd')) || 1;

        currentValue++;
        $btn.attr('data-count-prd', currentValue);
        $counter.text(currentValue);
        if (currentValue > 1) {
            $btn.addClass('is-visible');
        }
    });

    // Filter Products
    $(document).on('click', '.js_filter_item', function (e) {
        e.preventDefault();

        const $this = $(this);
        const filter = $this.data('filter');

        $this.addClass('is-active').siblings('.js_filter_item').removeClass('is-active');

        if ($(window).width() < 992) {
            const $productsGrid = $('.prd-grid');
            if ($productsGrid.length) {
                setTimeout(() => {
                    $productsGrid[0].scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 300);
            }
        }

        setTimeout(() => {
            const $allProducts = $('.js_product');

            if (filter === 'all' || !filter) {
                $allProducts.stop(true, true).fadeIn(300);
            } else {
                const $targetProducts = $allProducts.filter(`[data-filter="${filter}"]`);
                const $visibleProducts = $allProducts.filter(':visible');

                $visibleProducts.not($targetProducts).stop(true, true).fadeOut(200, function () {
                    $targetProducts.fadeIn(300);
                });
            }
        }, 300);
    });
});