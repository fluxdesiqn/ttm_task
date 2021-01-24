<?php
/**
 * TTM enqueue scripts
 *
 * @package TTM
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'ttm_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function ttm_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		wp_enqueue_script( 'jquery' );

		if ( file_exists( get_template_directory() . '/assets/css/theme.min.css' ) ) {
			$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/css/theme.min.css' );
			wp_enqueue_style( '_themename-styles', get_template_directory_uri() . '/assets/css/theme.min.css', [],
				$css_version );
		} else if ( file_exists( get_template_directory() . '/assets/css/theme.css' ) ) {
			$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/css/theme.css' );
			wp_enqueue_style( '_themename-styles', get_template_directory_uri() . '/assets/css/theme.css', [],
				$css_version );
		}

		if ( file_exists( get_template_directory() . '/assets/js/theme.min.js' ) ) {
			$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/js/theme.min.js' );
			wp_register_script( '_themename-scripts', get_template_directory_uri() . '/assets/js/theme.min.js', [],
				$js_version, TRUE );
		} else if ( file_exists( get_template_directory() . '/assets/js/theme.js' ) ) {
			$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/js/theme.js' );
			wp_register_script( '_themename-scripts', get_template_directory_uri() . '/assets/js/theme.js', [],
				$js_version, TRUE );
		}
		wp_localize_script('_themename-scripts', 'js_params', ['google_api_key' => get_field('google_api_key', 'options')]);
		wp_enqueue_script('_themename-scripts');
	}
} // End of if function_exists( 'ttm_scripts' ).
if ( ! function_exists( 'ttm_admin_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function ttm_admin_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		if ( file_exists( get_template_directory() . '/assets/css/admin.min.css' ) ) {
			$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/css/admin.min.css' );
			wp_enqueue_style( '_themename-admin-styles', get_template_directory_uri() . '/assets/css/admin.min.css', [],
				$css_version );
		} else if ( file_exists( get_template_directory() . '/assets/css/admin.css' ) ) {
			$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/css/admin.css' );
			wp_enqueue_style( '_themename-admin-styles', get_template_directory_uri() . '/assets/css/admin.css', [],
				$css_version );
		}

		if ( file_exists( get_template_directory() . '/assets/js/admin.min.js' ) ) {
			$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/js/admin.min.js' );
			wp_enqueue_script( '_themename-admin-scripts', get_template_directory_uri() . '/assets/js/admin.min.js', [],
				$js_version, TRUE );
		} else if ( file_exists( get_template_directory() . '/assets/js/admin.js' ) ) {
			$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/js/admin.js' );
			wp_enqueue_script( '_themename-admin-scripts', get_template_directory_uri() . '/assets/js/admin.js', [],
				$js_version, TRUE );
		}
	}
} // End of if function_exists( 'ttm_admin_scripts' ).

if ( ! function_exists( 'ttm_login_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function ttm_login_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		if ( file_exists( get_template_directory() . '/assets/css/login.min.css' ) ) {
			$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/css/login.min.css' );
			wp_enqueue_style( '_themename-login-styles', get_template_directory_uri() . '/assets/css/login.min.css', [],
				$css_version );
		} else if ( file_exists( get_template_directory() . '/assets/css/admin.css' ) ) {
			$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/css/login.css' );
			wp_enqueue_style( '_themename-login-styles', get_template_directory_uri() . '/assets/css/login.css', [],
				$css_version );
		}

		if ( file_exists( get_template_directory() . '/assets/js/login.min.js' ) ) {
			$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/js/login.min.js' );
			wp_enqueue_script( '_themename-login-scripts', get_template_directory_uri() . '/assets/js/login.min.js', [],
				$js_version, TRUE );
		} else if ( file_exists( get_template_directory() . '/assets/js/login.js' ) ) {
			$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/js/login.js' );
			wp_enqueue_script( '_themename-login-scripts', get_template_directory_uri() . '/assets/js/login.js', [],
				$js_version, TRUE );
		}
	}
} // End of if function_exists( 'ttm_login_scripts' ).
add_action( 'wp_enqueue_scripts', 'ttm_scripts' );
add_action( 'login_enqueue_scripts', 'ttm_login_scripts' );
add_action( 'admin_enqueue_scripts', 'ttm_admin_scripts' );
