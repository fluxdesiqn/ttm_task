<?php
/**
 * Theme basic setup
 *
 * @package TTM
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

add_action( 'after_setup_theme', 'ttm_setup' );

if ( ! function_exists( 'ttm_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ttm_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ttm, use a find and replace
		 * to change '_themename' to the name of your theme in all the template files
		 */
		load_theme_textdomain( '_themename', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Register Menu locations
		register_nav_menus(
			[
				'primary' => __( 'Primary Menu', '_themename' ),
				'top'     => __( 'Top Menu', '_themename' ),
				'footer'  => __( 'Footer Menu', '_themename' ),
			]
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			]
		);

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			[
				'aside',
				'image',
				'video',
				'quote',
				'link',
			]
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'ttm_custom_background_args',
				[
					'default-color' => 'ffffff',
					'default-image' => '',
				]
			)
		);

		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Check and setup theme default settings.
		ttm_setup_theme_default_settings();

		add_image_size( 'article_image_large', 1320, 544, TRUE );
		add_image_size( 'article_image_medium', 825, 340, TRUE );
		add_image_size( 'article_image_small', 607, 250, TRUE );
	}
}


add_filter( 'excerpt_more', 'ttm_custom_excerpt_more' );

if ( ! function_exists( 'ttm_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function ttm_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}

		return $more;
	}
}

add_filter( 'wp_trim_excerpt', 'ttm_all_excerpts_get_more_link' );

if ( ! function_exists( 'ttm_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function ttm_all_excerpts_get_more_link( $post_excerpt ) {
		if ( ! is_admin() ) {
			$post_excerpt = $post_excerpt . ' [...]<p><a class="btn btn-secondary ttm-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __(
					'Read More...',
					'_themename'
				) . '</a></p>';
		}

		return $post_excerpt;
	}
}
