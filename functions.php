<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'storefront-gutenberg-blocks' ) );
    }
endif;
//add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

function my_scripts_and_styles(){

$cache_buster = date("YmdHi", filemtime( get_stylesheet_directory() . '/css/main.css'));
wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/css/main.css', array(), $cache_buster, 'all' );

}

add_action( 'wp_enqueue_scripts', 'my_scripts_and_styles', 100);

// END ENQUEUE PARENT ACTION
// 
add_action("woocommerce_after_single_product_summary", function(){
	$output= <<<EOT
<div class="user-review">
	<div class="review44">
		<img src="https://mskeydeals.com/wp-content/uploads/2024/03/trustpilot-rating-badge.svg">
		<p>Trust Score 4.5 Great | 397 reviews</p>
	</div>
</div>
EOT;
	echo $output;
}, 0);

// Make postal code optional
add_filter( 'woocommerce_default_address_fields', 'customize_extra_fields', 1000, 1 );
function customize_extra_fields( $address_fields ) {
    $address_fields['postcode']['required'] = false; //Postcode
    return $address_fields;
}

// Hide checkout fields
function reorder_billing_fields($fields) {
    $billing_order = [
        'billing_first_name',
        'billing_last_name',
		'billing_email',
//         'billing_company',
        'billing_country',
        'billing_address_1',
//         'billing_address_2',
//         'billing_city',
//         'billing_state',
        'billing_postcode',
        'billing_phone'
    ];

    foreach ($billing_order as $field) {
		if('billing_phone' == $fields['billing'][$field]){
			
		}
        $ordered_fields[$field] = $fields['billing'][$field];
    }

	$ordered_fields['billing_phone']['required'] = false;


    $fields['billing'] = $ordered_fields;

    return $fields;
}

add_filter('woocommerce_checkout_fields', 'reorder_billing_fields');

