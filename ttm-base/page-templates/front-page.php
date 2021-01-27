<?php
/**
 * Template Name: Front Page
 *
 * Template for the front page
 *
 * @package TTM
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'ttm_container_type' );

if( have_posts() ) :
  
	while( have_posts() ) : the_post(); ?>

  		<main>
		  <?php get_template_part( 'module', 'banner' );?>


  		</main>

  	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>