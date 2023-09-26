<?php

/**
 * Rebuild Woocommerce templates with standard actions
 */
foreach (glob(get_template_directory() . '/inc/woocommerce/templates/*.php') as $filename) {
	include_once $filename;
}
