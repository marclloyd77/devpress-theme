<?php
/**
 * Devpress back compat functionality
 *
 * Prevents Devpress from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backward compatible beyond that
 * and relies on many newer functions and markup changes introduced in 3.6.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Devpress 1.0
 */

/**
 * Prevent switching to Devpress on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Devpress 1.0
 *
 * @return void
 */
function devpress_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'devpress_upgrade_notice' );
}
add_action( 'after_switch_theme', 'devpress_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Devpress on WordPress versions prior to 3.6.
 *
 * @since Devpress 1.0
 *
 * @return void
 */
function devpress_upgrade_notice() {
	$message = sprintf( __( 'Devpress requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'devpress' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Theme Customizer from being loaded on WordPress versions prior to 3.6.
 *
 * @since Devpress 1.0
 *
 * @return void
 */
function devpress_customize() {
	wp_die( sprintf( __( 'Devpress requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'devpress' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'devpress_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 * @since Devpress 1.0
 *
 * @return void
 */
function devpress_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Devpress requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'devpress' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'devpress_preview' );
