<?php
/**
 * The header for our theme
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Put your description here.">
	<meta name="format-detection" content="telephone=no" />
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
	<meta name="theme-color" content="var(--clr-white)" />

	<link rel="preload" href="<?php echo THEME_URI; ?>/fonts/Nunito.woff2" as="font" type="font/woff2" crossorigin>
	<style type="text/css">
	@font-face {
	    font-family: 'Nunito';
	    src: url('<?php echo THEME_URI; ?>/fonts/Nunito.woff2') format('woff2');
	    font-style: normal;
	    font-display: swap;
	}

	body {
	    font-family: 'Nunito', sans-serif;
	}
	</style>

    <?php wp_head(); ?>
</head>

<body <?php body_class( ); ?>>

	<div id="content-block">
		<header>
		    <div class="h-wrap">
		        <div class="container">
		            <div class="h-inner">
		                <div class="h-inner-top">
		                    <div class="h-menu">
		                        <nav class="h-links">
		                            <ul>
		                                <li class="is-active"><a href="about.php">Про компанію</a></li>
		                                <li><a href="blog__page.php">Акції</a></li>
		                                <li><a href="checkout__delivery.php">Доставка та оплата</a></li>
		                                <li><a href="contacts.php">Контакти</a></li>
		                            </ul>
		                        </nav>

		                        <div class="h-contacts">
		                            <div class="contact-item">
		                                <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-city-location.svg" alt="Icon" loading="eager">
		                                <div class="contact-item-info"><strong>м. Остер</strong></div>
		                            </div>

		                            <div class="contact-item">
		                                <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-phone.svg" alt="Icon" loading="eager">

		                                <div class="contact-item-info">
		                                    <a href="tel:+380980800884">
		                                        <span itemprop="telephone">+38 (098) 08 008 84</span>
		                                    </a>
		                                </div>
		                            </div>

		                            <div class="contact-item">
		                                <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-clock.svg" alt="Icon" loading="eager">

		                                <div class="contact-item-info">
		                                    <p>Пн - Пт: <strong>10:00 - 20:00</strong></p>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>

		                <div class="h-inner-bottom">
		                    <a class="h-logo" href="index.php" aria-label="Company logo">
		                        <img width="121" height="40" src="<?php echo THEME_URI; ?>/img/logo.svg" alt="Company Logo" loading="eager">
		                    </a>

		                    <div class="h-catalog">
		                        <nav class="h-links">
		                            <ul>
		                                <li class="is-active">
		                                    <a href="product__category.php">
		                                        <span><img width="42" height="42" src="<?php echo THEME_URI; ?>/img/icons/icon-desserts.svg" alt="Icon" loading="eager"></span>
		                                        <b>Десерти</b>
		                                    </a>
		                                </li>
		                                <li>
		                                    <a href="product__category.php">
		                                        <span><img width="42" height="42" src="<?php echo THEME_URI; ?>/img/icons/icon-kebab.svg" alt="Icon" loading="eager"></span>
		                                        <b>Кебаб</b>
		                                    </a>
		                                </li>
		                                <li>
		                                    <a href="product__category.php">
		                                        <span><img width="42" height="42" src="<?php echo THEME_URI; ?>/img/icons/icon-drinks.svg" alt="Icon" loading="eager"></span>
		                                        <b>Напої</b>
		                                    </a>
		                                </li>
		                                <li>
		                                    <a href="product__category.php">
		                                        <span><img width="42" height="42" src="<?php echo THEME_URI; ?>/img/icons/icon-hot-dogs.svg" alt="Icon" loading="eager"></span>
		                                        <b>Хот-Доги</b>
		                                    </a>
		                                </li>
		                                <li>
		                                    <a href="product__catalog.php">
		                                        <span><img width="42" height="42" src="<?php echo THEME_URI; ?>/img/icons/icon-menu.svg" alt="Icon" loading="eager"></span>
		                                        <b>Меню</b>
		                                    </a>
		                                </li>
		                            </ul>
		                        </nav>
		                    </div>

		                    <div class="contact-item">
		                        <img width="24" height="24" src="<?php echo THEME_URI; ?>/img/icons/icon-city-location-white.svg" alt="Icon" loading="eager">
		                        <div class="contact-item-info"><strong>м. Остер</strong></div>
		                    </div>

		                    <!-- IF CART IS EMPTY ADD CLASS "is-empty" TO "h-cart" -->
		                    <div class="h-cart js_cart_open">
		                        <div class="h-cart-icon">
		                            <img width="42" height="42" src="<?php echo THEME_URI; ?>/img/icons/icon-basket.svg" alt="Icon" loading="eager">
		                            <i class="js_cart_items <?php (!empty(WC()->cart->get_cart_contents_count() ? '' : 'd-none')); ?>"><?php echo WC()->cart->get_cart_contents_count(); ?></i>
		                        </div>
		                        <b>Кошик</b>

		                        <div class="h-cart-empty">
		                            <div class="h-cart-empty-inner">
		                                <img width="68" height="47" src="<?php echo THEME_URI; ?>/img/cart-empty.svg" alt="Decor Image" loading="lazy">
		                                <div class="text"><strong>!</strong></div>
		                                <div class="text"></div>
		                            </div>
		                        </div>
		                    </div>

		                    <div class="h-login open-popup" data-rel="6">
		                        <div class="h-login-icon">
		                            <img width="42" height="42" src="<?php echo THEME_URI; ?>/img/icons/icon-login.svg" alt="Icon" loading="eager">
		                        </div>
		                        <b>Вхід</b>
		                    </div>

		                    <div class="h-burger js-open-menu">
		                        <img width="42" height="42" src="<?php echo THEME_URI; ?>/img/icons/icon-gl-menu.svg" alt="Icon" loading="eager">
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		    <div class="h-menu-overlay"></div>
		</header>

		<main>
			