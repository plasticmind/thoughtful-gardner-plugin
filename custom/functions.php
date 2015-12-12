<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * functions.php
 * Add PHP snippets here
 */

// # Remove WooCommerce Credit, Add Our Own

add_action( 'init', 'tg_remove_footer_credit', 10 );
function tg_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
    add_action( 'storefront_footer', 'tg_storefront_credit', 20 );
} 

function tg_storefront_credit() {
	?>
	<div class="site-info">
		&copy; <?php echo get_bloginfo( 'name' ) . ' ' . get_the_date( 'Y' ); ?> ~ <em>Thanks for supporting our little cottage industry!</em>
		<section id="wpcom_social_media_icons_widget-5" class="widget widget_wpcom_social_media_icons_widget" title="Shift-click to edit this widget."><ul><li><a title="View thoughtfulgardner’s profile on Facebook" href="https://www.facebook.com/thoughtfulgardner/" class="genericon genericon-facebook" target="_blank"><span class="screen-reader-text">View thoughtfulgardner’s profile on Facebook</span></a></li><li><a title="View thoughtgardner’s profile on Twitter" href="https://twitter.com/thoughtgardner/" class="genericon genericon-twitter" target="_blank"><span class="screen-reader-text">View thoughtgardner’s profile on Twitter</span></a></li><li><a title="View thoughtfulgardner’s profile on Instagram" href="https://instagram.com/thoughtfulgardner/" class="genericon genericon-instagram" target="_blank"><span class="screen-reader-text">View thoughtfulgardner’s profile on Instagram</span></a></li></ul></section>
	</div><!-- .site-info -->
	<?php
}

add_action('template_redirect', 'remove_sidebar_shop');
function remove_sidebar_shop() {
	if ( is_product() ) {
    	remove_action('storefront_sidebar', 'storefront_get_sidebar');
    }
}

// Replace logo

add_action( 'after_setup_theme', 'browncoats_theme_setup' );

function browncoats_theme_setup() {
	remove_action('storefront_site_branding');
	/* Add filters, actions, and theme-supported features. */
}

// Free shipping notice

//add_action('woocommerce_cart_totals_before_order_total','tg_free_shipping_notice');
add_action('woocommerce_cart_totals_before_shipping','tg_free_shipping_notice');

function tg_free_shipping_notice() {

	if ( WC()->cart->subtotal < 50 ) {
		echo '<tr><td colspan="2"><b style="color:red;font-size:1.1em"><em><b>🎁 Order $50 or more and shipping is free!</b></em></td></tr>';

	}
}

//Page Slug Body Class

function add_shop_class( $classes ) {
    if ( is_shop() ) {
        //$classes[] = $post->post_type . '-' . $post->post_name;
        $classes[] = 'page-shop';
    }
    return $classes;
}
add_filter( 'body_class', 'add_shop_class',1,3 );