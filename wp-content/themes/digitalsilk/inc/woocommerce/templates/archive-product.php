<?php
/**
 * Change Shop Page
 */

class DS_ArchiveProduct {

	public function __construct()
	{
		/**
		 * enable woocommerce archive page widgets
		 */
		add_action('widgets_init', array($this, 'register_woocommerce_sidebar'));
		add_action('widgets_init', array($this, 'register_woocommerce_filter'));

		/**
		 * rebuild archive page subheader
		 */
		add_filter('woocommerce_show_page_title', '__return_false');
		remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
		remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
		add_action('woocommerce_archive_description', array($this, 'add_archive_subheader'), 10);

		/**
		 * move breadcrumbs after subheader
		 */
		add_action('woocommerce_before_main_content', array($this, 'remove_archive_breadcrumbs'));
		//add_action( 'woocommerce_before_shop_loop', 'woocommerce_breadcrumb', 5 );

		/**
		 * archive page wrappers
		 */
		add_action('woocommerce_before_shop_loop', array($this, 'add_shop_filter'), 5);

		remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
		remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
		add_action('woocommerce_before_shop_loop', array($this, 'open_ordering_container'), 11);
		add_action('woocommerce_before_shop_loop', array($this, 'add_shop_sidebar_toggle_button'), 11);;
//		add_action('woocommerce_before_shop_loop', array( $this, 'perpage_select' ), 13 );
//		add_action('pre_get_posts', array( $this, 'perpage_products_query' ) );
		add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 13);
		add_action('woocommerce_before_shop_loop', 'woocommerce_pagination', 13);
		add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 14);
		add_action('woocommerce_before_shop_loop', array($this, 'close_ordering_container'), 20);
		add_action('woocommerce_before_shop_loop', array($this, 'open_archive_container'), 21);
		add_action('woocommerce_before_shop_loop', array($this, 'add_shop_sidebar'), 22);
		add_action('woocommerce_before_shop_loop', array($this, 'open_loop_container'), 23);

		add_action('woocommerce_after_shop_loop', array($this, 'open_bottom_ordering_container'), 4);
		add_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 5);
		add_action('woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10);
		add_action('woocommerce_after_shop_loop', array($this, 'close_bottom_ordering_container'), 14);
		add_action('woocommerce_after_shop_loop', array($this, 'close_loop_container'), 15);
		add_action('woocommerce_after_shop_loop', array($this, 'close_archive_container'), 20);
		add_action('woocommerce_after_shop_loop', array($this, 'loop_faq'), 30);

		/**
		 * Loop product item
		 */
		add_action('woocommerce_shop_loop_item_title', array($this, 'product_short_description'), 15);

		/**
		 * No products archive template
		 */
		add_action('woocommerce_no_products_found', array($this, 'open_archive_container'), 5);
		add_action('woocommerce_no_products_found', array($this, 'add_shop_sidebar'), 5);
		add_action('woocommerce_no_products_found', array($this, 'open_loop_container'), 5);
		add_action('woocommerce_no_products_found', array($this, 'close_loop_container'), 15);
		add_action('woocommerce_no_products_found', array($this, 'close_archive_container'), 15);
	}

	public function __get($key)
	{
		$this->{$key} = get_option('options_' . $key);

		return $this->{$key};
	}

	public function remove_archive_breadcrumbs()
	{
		if (is_shop() || is_archive()) {
			remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
		}
	}

	public function add_archive_subheader()
	{
		if (!is_product()) {
			get_template_part('woocommerce/archive/subheader');
		}
	}

	public function add_shop_sidebar_toggle_button()
	{
		if (!is_product() && $this->woo_sidebar_module_view == 'show') {
			get_template_part('woocommerce/archive/sidebar-toggle-button');
		}
	}

	public function add_shop_sidebar()
	{
		if (!is_product() && $this->woo_sidebar_module_view == 'show') {
			get_template_part('woocommerce/archive/sidebar', null,
				['sidebar_position' => $this->woo_sidebar_sidebar_position]);
		}
	}

	public function add_shop_filter()
	{
		if (!is_product() && $this->woo_filter_module_view == 'show') {
			get_template_part('woocommerce/archive/filter');
		}
	}

	public function loop_faq()
	{
		if (!is_product()) {
			get_template_part('woocommerce/archive/faq');
		}
	}

	public function register_woocommerce_sidebar()
	{
		if ($this->woo_sidebar_module_view != 'show') {
			return;
		}

		register_sidebar(array(
			'name'          => __('Woocommerce Sidebar', 'dstheme'),
			'id'            => 'woocommerce-sidebar',
			'description'   => '',
			'class'         => '',
			'before_title'  => '<span>',
			'after_title'   => '</span>',
		));
	}

	public function register_woocommerce_filter()
	{
		if ($this->woo_filter_module_view != 'show') {
			return;
		}

		register_sidebar(array(
			'name'          => __('Woocommerce Filter', 'dstheme'),
			'id'            => 'woocommerce-filter',
			'description'   => 'Area to show woocommerce filters between page subheader and products listing on archive page',
			'class'         => '',
			'before_title'  => '<span>',
			'after_title'   => '</span>',
		));
	}


	public function perpage_select()
	{
		$per_page = filter_input(INPUT_GET, 'perpage', FILTER_SANITIZE_NUMBER_INT);
		echo '<div class="woocommerce-perpage">';
		echo '<span>' . __('View', 'woocommerce') . '</span>';
		echo '<select onchange="if (this.value) window.location.href=this.value">';
		$orderby_options = array(
			'9' => '9',
			'12' => '12',
			'24' => '24',
			'-1' => 'All'
		);
		foreach ($orderby_options as $value => $label) {
			echo "<option " . selected($per_page, $value) . " value='?perpage={$value}'>{$label} " . __('products',
					'woocommerce') . "</option>";
		}
		echo '</select>';
		echo '<span>' . __('per page', 'woocommerce') . '</span>';
		echo '</div>';
	}

	public function perpage_products_query($query)
	{
		$per_page = filter_input(INPUT_GET, 'perpage', FILTER_SANITIZE_NUMBER_INT);
		if ($per_page && $query->is_main_query() && !is_admin() && (is_shop() || is_product_category() || is_product_tag() || is_post_type_archive('product'))) {
			$query->set('posts_per_page', $per_page);
		}
	}

	public function open_archive_container()
	{
		$container_class = ($this->woo_sidebar_module_view == 'show') ? '-has-sidebar' : '';
		$sidebar_postition = ($this->woo_sidebar_sidebar_position == 'left') ? '-sidebar-left' : '-sidebar-right';

		echo "<div class='woocommerce-archive-content {$container_class} {$sidebar_postition}'>";
	}

	public function product_short_description()
	{
		$show_short_description = $this->archive_product_short_description;

		if ($show_short_description == 'show') {
			global $product;

			echo '<div class="archive-short-description">';
			echo apply_filters('woocommerce_short_description', $product->short_description);
			echo '</div>';
		}
	}

	public function close_archive_container()
	{
		echo "</div>";
	}

	public function open_loop_container()
	{
		echo "<div class='woocommerce-loop'>";
	}

	public function close_loop_container()
	{
		echo "</div>";
	}

	public function open_ordering_container()
	{
		echo "<div class='woocommerce-sorting'>";
	}

	public function close_ordering_container()
	{
		echo "</div>";
	}

	public function open_bottom_ordering_container()
	{
		echo "<div class='woocommerce-sorting bottom'>";
	}

	public function close_bottom_ordering_container()
	{
		echo "</div>";
	}
}

new DS_ArchiveProduct();
