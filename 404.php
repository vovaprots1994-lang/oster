<?php
/**
 * 404
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header(); ?>

    <main class="content">
        <section class="error-page text-center">
            <div class="container">
                <h1 class="h1">404</h1>
                <a href="<?php echo THEME_HOME_URL; ?>" class="btn btn-secondary"><?php _e('Home', 'pixel'); ?></a>
            </div>
        </section>
    </main>

<?php //get footer
get_footer();