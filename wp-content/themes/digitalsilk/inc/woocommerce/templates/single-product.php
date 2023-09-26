<?php
/**
 * Change Single Product Page
 */
Class DS_SingleProduct {

	public function __construct()
	{
		add_filter('woocommerce_reviews_title', array($this, 'reviews_title'), 10, 3);

		add_action('woocommerce_single_product_summary', array($this, 'shipping_sidebar'), 25);

		if (has_action('tinvwl_wishlist_addtowishlist_button')) {
			add_action('tinvwl_wishlist_addtowishlist_button', array($this, 'request_quote'), 99);
		}
		else{
			add_action('woocommerce_single_product_summary', array($this, 'request_quote'), 31);
		}

		add_filter( 'woocommerce_product_tabs', array( $this, 'product_tabs' ) );

		add_action('ds_after_content', array($this, 'bottom_banner'), 15);
	}

	public function product_tabs( $tabs )
	{
		global $product;

		unset( $tabs['description'] );

		if( $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) {
			add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );
			$tabs['additional_information']['title'] = __( 'Specification' );
		}

		$description = get_field( 'description' );
		if ( ! empty( $description ) ) {
			$tabs['custom_description'] = array(
				'title'    => __( 'Description', 'dstheme-woocommerce' ),
				'priority' => 1,
				'callback' => array( $this, 'product_custom_description' ),
			);
		}

		$faq = get_field( 'faq' );
		if ( ! empty( $faq ) ) {
			$tabs['faq'] = array(
				'title'    => __( 'FAQ', 'dstheme-woocommerce' ),
				'priority' => 25,
				'callback' => array( $this, 'product_faq' ),
			);
		}

		return $tabs;
	}

	public function product_faq()
	{
		get_template_part( '/woocommerce/single-product/tabs/faq' );
	}

	public function product_custom_description()
	{
		get_template_part( '/woocommerce/single-product/tabs/custom-description' );
	}

	public function shipping_sidebar()
	{
		get_template_part( '/woocommerce/single-product/shipping-bar' );
	}

	public function request_quote()
	{
		get_template_part( '/woocommerce/single-product/product-inquiry' );
	}

	public function bottom_banner()
	{
		get_template_part( '/woocommerce/single-product/bottom-banner' );
	}

	public function reviews_title( $html, $count, $product )
	{
		$html  = "<span>".__('Customer reviews','dstheme-woocommerce')."</span>";
		$html .= "<div>";
		$html .= $product->get_average_rating();
		$html .= wc_get_rating_html( $product->get_average_rating(), $product->get_rating_count() );
		$html .= "</div>";
		$html .= "<span>".$count.__(' reviews','dstheme-woocommerce')."</span>";

		return $html;
	}

}
new DS_SingleProduct();
