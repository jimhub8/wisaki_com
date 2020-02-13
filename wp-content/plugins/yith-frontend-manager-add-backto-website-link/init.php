<?php
/*
Plugin Name: YITH Frontend Manager Add Back to webiste url to dashboard
Description: YITH Frontend Manager Add Back to webiste url to dashboard
Author: YITHEMES
Version: 1.0.0
Author URI: http://yithemes.com/
*/
/*
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly 

add_action( 'yith_wcfm_extra_menu_items', 'yith_wcfm_extra_menu_items', 99 );
add_action( 'wp_enqueue_scripts', 'yith_wp_enqueue_scripts', 20 );

if( ! function_exists( 'yith_wp_enqueue_scripts' ) ){
	function yith_wp_enqueue_scripts(){
		$handle = 'yith_wcfd-skin-style';
		$css = '#yith-wcfm-navigation-menu > li.yith-wcfm-navigation-link--back-to-website > a::before {content: "\f340";}';
		wp_add_inline_style( $handle, $css );
	}
}

if( ! function_exists( 'yith_wcfm_extra_menu_items' ) ){
	function yith_wcfm_extra_menu_items(){
		ob_start();
		$li_classes = $section_classes = wc_get_account_menu_item_classes( 'back-to-website' );
		printf( '<li class="%s"><a href="%s">%s</a></li>', $li_classes, home_url(), __( 'Back to website', 'yith-frontend-manager-for-woocommerce' )  );
		echo ob_get_clean();
	}
}