<?php
/**
 * TTM functions and definitions
 *
 * @package TTM
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// TTM's includes directory.
$ttm_inc_dir = get_template_directory() . '/inc';

// Array of files to include.
$ttm_includes = [
	'/theme-settings.php',                                      // Initialize theme default settings.
	'/setup.php',                                               // Theme setup and custom theme supports.
	'/widgets.php',                                             // Register widget area.
	'/enqueue.php',                                             // Enqueue scripts and styles.
	'/template-tags.php',                                       // Custom template tags for this theme.
	'/pagination.php',                                          // Custom pagination for this theme.
	'/acf-hooks.php',                                           // Custom ACF hooks.
	'/hooks.php',                                               // Custom hooks.
	'/extras.php',                                              // Custom functions that act independently of the theme templates.
	'/customizer.php',                                          // Customizer additions.
	'/custom-comments.php',                                     // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',                        // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/ttm/ttm/issues/567.
	'/class-wp-bootstrap-catwalker.php',                        // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/ttm/ttm/issues/567.
	'/editor.php',                                              // Load Editor functions.
	'/safe-svg/safe-svg.php',                                   // Safely include SVG's
	'/post-types.php'                                           // Custom Post Types / Taxonomies
];

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$ttm_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$ttm_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $ttm_includes as $file ) {
	require_once $ttm_inc_dir . $file;
}

acf_add_options_page( [
	'page_title' => 'Global Settings',
	'menu_title' => 'Global Settings',
	'menu_slug'  => 'global-settings',
	'capability' => 'edit_posts',
] );
