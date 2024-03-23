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
wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/css/main.css', array(), '1.0.0', 'all' );

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

function storefront_credit() {
	$links_output = '';
?>
<div class="site-info">
	<div class="col50 col-left">
		<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . "MsKeyDeals Ltd" . ' ' . gmdate( 'Y' ) ) ); ?>
		<br/>
		<?php echo "GENUINE SOFTWARE LICENSES KEYS"; ?>
	</div>
	<div class="col50 col-right">
		<img src="https://genuinelicense.store/wp/wp-content/uploads/2024/01/payments_.svg" />		
	</div>
	
</div><!-- .site-info -->
<?php
}


function storefront_handheld_footer_bar_home_link(){
    echo '<a href="https://mskeydeals.com/">' . esc_attr__( 'Home', 'storefront' ) . '</a>';
}

function storefront_handheld_footer_bar_shop_link(){
    echo '<a href="' . esc_url( get_permalink( get_option( 'woocommerce_shop_page_id' ) ) ) . '">' . esc_attr__( 'Shop', 'storefront' ) . '</a>';
}
function storefront_handheld_footer_bar() {
	$links = array(
		'home'      => array(
			'priority' => 10,
			'callback' => 'storefront_handheld_footer_bar_home_link',
		),
		'shop'      => array(
			'priority' => 20,
			'callback' => 'storefront_handheld_footer_bar_shop_link',
		),
		'my-account' => array(
			'priority' => 30,
			'callback' => 'storefront_handheld_footer_bar_account_link',
		),
		'search'     => array(
			'priority' => 40,
			'callback' => 'storefront_handheld_footer_bar_search',
		),
		'cart'       => array(
			'priority' => 50,
			'callback' => 'storefront_handheld_footer_bar_cart_link',
		),
	);

	if ( did_action( 'woocommerce_blocks_enqueue_cart_block_scripts_after' ) || did_action( 'woocommerce_blocks_enqueue_checkout_block_scripts_after' ) ) {
		return;
	}

	if ( wc_get_page_id( 'myaccount' ) === -1 ) {
		unset( $links['my-account'] );
	}

	if ( wc_get_page_id( 'cart' ) === -1 ) {
		unset( $links['cart'] );
	}

	$links = apply_filters( 'storefront_handheld_footer_bar_links', $links );
	?>
	<div class="storefront-handheld-footer-bar">
		<ul class="columns-<?php echo count( $links ); ?>">
			<?php foreach ( $links as $key => $link ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>">
					<?php
					if ( $link['callback'] ) {
						call_user_func( $link['callback'], $key, $link );
					}
					?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}


add_shortcode("html_block", "html_block");

function html_block() {

	ob_start();
	
	?>
	<div class="html_block">
		<ul class="tic-icon-list-items">
			<li class="tic-icon-list-item">
			<span class="tic-icon-list-icon">
			<i aria-hidden="true" class="fas fa-cloud-download-alt"></i> </span>
			<span class="tic-icon-list-text"> Download Immediately After Purchase</span>
			</li>
			<li class="tic-icon-list-item">
			<span class="tic-icon-list-icon">
			<i aria-hidden="true" class="fas fa-check-circle"></i> </span>
			<span class="tic-icon-list-text">One Time Payment - Lifetime Licence</span>
			</li>
			<li class="tic-icon-list-item">
			<span class="tic-icon-list-icon">
			<i aria-hidden="true" class="fas fa-shield-alt"></i> </span>
			<span class="tic-icon-list-text">Genuine Retail Software Guaranteed</span>
			</li>
			<li class="tic-icon-list-item">
			<span class="tic-icon-list-icon">
			<i aria-hidden="true" class="fas fa-envelope"></i> </span>
			<span class="tic-icon-list-text"> Dedicated After Sales Support Team</span>
			</li>
			</ul>
	</div>
	<?php
	return ob_get_clean();
}