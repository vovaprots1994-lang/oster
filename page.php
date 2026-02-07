<?php
/**
 * Default page template
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header(); ?>
	
	<?php //HTML HERE ?>

		<?php while(have_posts()){ the_post();
			the_title( '<h1>', '</h1>');
			the_content();
		} ?>    		
	
	<?php //HTML HERE ?>

<?php //get footer
get_footer();