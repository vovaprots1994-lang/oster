function on(selector, event, childSelector, handler) {
    document.addEventListener(event, function(e) {
        const target = e.target.closest(childSelector);
        if (target && e.target.closest(selector)) {
            handler.call(target, e);
        }
    });
}

document.querySelector('.h-cart-icon i').style.display='none';
on('.stepper:not(.addons-stepper):not(.prd-stepper)', 'click', '.decr', function () {
    const stepper = this.closest('.stepper');
    const input = stepper.querySelector('input');
    let val = parseInt(input.value, 10);
    const min = input.hasAttribute('data-min') ? parseInt(input.getAttribute('data-min'), 10) : 1;

    val = val !== min ? val - 1 : min;
    input.value = val;
});

on('.stepper:not(.addons-stepper):not(.prd-stepper)', 'click', '.incr', function () {
    console.log('Increment Click');
    const stepper = this.closest('.stepper');
    const input = stepper.querySelector('input');
    let val = parseInt(input.value, 10);

    input.value = val + 1;
});


document.addEventListener('DOMContentLoaded', () => {
    const cart = document.querySelector('.h-cart.js_cart_open');
    const cartOut = document.getElementById('cart-popup-out');

    if (cart) {
        const cartEmptyInner = cart.querySelector('.h-cart-empty-inner');

        cart.addEventListener('click', () => {
            const html = document.querySelector('html');
            if (html.classList.contains('cart-is-open')) {
                return;
            }
            const data = new FormData();
            data.append('action', 'open_cart');

            fetch(ajaxurl.url, {
                method: "POST",
                body: data
            })
            .then(response => response.json())
            .then(data => {
                html.classList.add('cart-is-open');
                if (data.count === 0) {
                    document.querySelector('html').classList.remove('cart-is-open');
                }

                cartOut.innerHTML = data.cartHtml;
                _functions.removeScroll();
            })
        });
    }

});

document.addEventListener("click", function(event) {
    if (event.target.closest(".js_cart_close")) {
        document.documentElement.classList.remove("cart-is-open");
        _functions.addScroll();
    }
});

const addCart = document.querySelectorAll('.add-to-cart');
const js_cart_items = document.querySelector('.js_cart_items');

addCart.forEach(elem => {
    elem.addEventListener('click', function (e) {
        if (e.target.closest('.incr, .decr')) return;

        let productId = this.dataset.id;
        let productQty = this.dataset.countPrd;
        let productType = this.dataset.productType;

        const formData = new FormData();
        formData.append('action', 'update_cart_product');
        formData.append('id', productId);
        formData.append('qty', productQty);

        if (productType === 'variable') {
            let variationId = this.dataset.variationId;
            if (!variationId) {
                alert('Спочатку оберіть варіант товару!');
                return;
            }
            formData.append('variation_id', variationId);
        }

        let addons = {};
        document.querySelectorAll('.js-addon').forEach(function(addon) {
            let addonId = addon.getAttribute('data-addon-id');
            let addonQty = parseInt(addon.querySelector('.addons-stepper input').value);
            if (addonQty > 0) {
                addons[addonId] = addonQty;
            }
        });

        if (Object.keys(addons).length > 0) {
            formData.append('addons', JSON.stringify(addons));
        }

        fetch(ajaxurl.url, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.count > 0) {
                js_cart_items.classList.remove('d-none');
                js_cart_items.textContent = data.count;
                document.querySelector('.js_cart_items').style.display='flex';
            }
        })
    });
});


document.addEventListener('click', function(e) {
    let button = e.target.closest('.cart-products .decr, .cart-products .incr');
    let js_cart_total = document.querySelector('.js_cart_total');
    let price_t = document.getElementById('price');
    if (button) {
        let stepper = button.closest('.stepper');
        let cart_item_key = stepper.dataset.key;
        let currentQty = document.querySelector('.currentQty');
        let value = currentQty.value;
        let main = document.querySelector('.cart-inner');
        main.classList.add('loading2');

        const formData = new FormData();
        formData.append('action', 'update_cart_product');
        formData.append('key', cart_item_key);
        formData.append('qty', value);
        
        console.log(value);
        fetch(ajaxurl.url, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.count > 0) {
                js_cart_items.classList.remove('d-none');
                js_cart_items.textContent = data.count;
                price_t.textContent = data.subtotal;
                main.classList.remove('loading2');
                document.querySelector('.js_cart_items').style.display='flex';
            }
            js_cart_total.textContent = data.total;
        })
    }
});

document.addEventListener('click', function(e) {
    if (!e.target.closest('.js_product_remove')) {
        return;
    }
    const cart_inner = document.getElementById('cart-inner');
    const product = e.target.closest('.prd-horiz');
    const productKey = product.querySelector('.stepper').dataset.key;
    let main = document.querySelector('.cart-inner');
        main.classList.add('loading2');
    
    const formData = new FormData();
    formData.append('action', 'remove_cart_product');
    formData.append('key', productKey);
    
    fetch(ajaxurl.url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            main.classList.remove('loading2');
            product.remove();

            document.querySelector('.cart-total').textContent = data.total + ' грн';

            document.querySelector('.js_cart_items').textContent = data.count;
            
            if (data.count === 0) {
                document.querySelector('.js_cart_items').style.display='none';

                setTimeout(() => {
                  document.querySelector('html').classList.remove('cart-is-open');
                }, 300);

                
            } else {
                document.querySelector('.js_cart_items').style.display='flex';
            }
        }
    });
});


function calculateProductPrice(productCard) {
    const basePrice = parseInt(productCard.getAttribute('data-variation-price')) || parseInt(productCard.getAttribute('data-price')) || 0;
    const qtyInput = productCard.querySelector('.prd-detail-controls .stepper input');
    const qty = parseInt(qtyInput ? qtyInput.value : 1) || 1;

    let addonsTotal = 0;
    const activeAddons = productCard.querySelectorAll('.addon.active');
    
    activeAddons.forEach(function(addon) {
        const addonPrice = parseInt(addon.getAttribute('data-addon-price')) || 0;
        const addonInput = addon.querySelector('input');
        const addonQty = parseInt(addonInput ? addonInput.value : 0) || 0;
        addonsTotal += addonPrice * addonQty;
    });

    const totalPrice = (basePrice + addonsTotal) * qty;

    const priceEl = productCard.querySelector('.prd-detail-controls .price:not(.old) b');
    if (priceEl) {
        priceEl.textContent = totalPrice;
    }

    const popupContent = productCard.closest('.popup-content');
    if (popupContent && popupContent.classList.contains('active')) {
        const priceElPopup = popupContent.querySelector('.prd-detail-controls .price:not(.old) b');
        if (priceElPopup) {
            priceElPopup.textContent = totalPrice;
        }
    }
}

function updateVariation(form) {
    const variationData = form.getAttribute('data-product_variations');
    
    if (variationData && variationData.length) {
        const variationArray = JSON.parse(variationData);
        
        const selectedAttributes = {};
        const checkedInputs = form.querySelectorAll('input[type="radio"]:checked');
        
        checkedInputs.forEach(function(input) {
            const name = input.getAttribute('name');
            const slug = input.getAttribute('data-attr-slug');
            selectedAttributes[name] = slug;
        });
        
        variationArray.forEach(function(variation) {
            if (JSON.stringify(variation.attributes) === JSON.stringify(selectedAttributes)) {
                const variationId = variation.variation_id;
                const price = variation.display_price;
                const isInStock = variation.is_in_stock;
                
                const productCard = form.closest('.js_product');
                
                if (productCard) {
                    productCard.setAttribute('data-variation-price', price);
                    
                    const orderBtn = productCard.querySelector('.js_order_btn');
                    if (orderBtn) {
                        orderBtn.setAttribute('data-variation-id', variationId);
                        
                        const btnText = orderBtn.querySelector('b');
                        
                        if (isInStock) {
                            orderBtn.disabled = false;
                            orderBtn.classList.remove('out-of-stock');
                            orderBtn.style.pointerEvents = '';
                            orderBtn.style.opacity = '';
                            
                            if (btnText) {
                                btnText.textContent = orderBtn.getAttribute('data-original-text') || 'Додати в кошик';
                            }
                        } else {
                            if (btnText && !orderBtn.hasAttribute('data-original-text')) {
                                orderBtn.setAttribute('data-original-text', btnText.textContent);
                            }
                            
                            orderBtn.disabled = true;
                            orderBtn.classList.add('out-of-stock');
                            orderBtn.style.pointerEvents = 'none';
                            orderBtn.style.opacity = '0.6';
                            
                            if (btnText) {
                                btnText.textContent = 'Немає в наявності';
                            }
                        }
                    }
                    
                    const priceEl = productCard.querySelector('.price[itemprop="price"] b');
                    if (priceEl) {
                        priceEl.textContent = price;
                    }
                    calculateProductPrice(productCard);
                }
            }
        });
    }
}

document.addEventListener('change', function(e) {
    if (e.target.matches('.ch-box-filter input')) {
        const form = e.target.closest('form[data-product_variations]');
        if (form) {
            updateVariation(form);
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[data-product_variations]');
    if (form) {
        updateVariation(form);
    }
});