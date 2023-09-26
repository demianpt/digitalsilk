<?php
/**
 * Removes possibility to deactivate plugins in admin panel
 */

if ( ! class_exists( 'DS_DefaultPlugins' ) ) {

    class DS_DefaultPlugins
    {
        /**
         * Array of plugins which user will can't to disable
         *
         * @var array plugin_dir/plugin_main_class.php
         */
        public $important_plugins = array(
            'advanced-custom-fields-pro/acf.php',
            //'woocommerce/woocommerce.php',
        );

        /**
         * Default_Plugins constructor.
         */
        public function __construct()
        {
            add_filter('plugin_action_links', array($this, 'disable_plugin_deactivation'), 10, 2);
        }

        /**
         * Adds class 'musthave_js' to required plugins
         *
         * @param $actions
         * @param $plugin_file
         *
         * @return mixed
         */
        public function disable_plugin_deactivation($actions, $plugin_file)
        {
            unset($actions['edit']);

            if (in_array($plugin_file, $this->important_plugins)) {
                unset($actions['deactivate']);
                $actions['info'] = '<b class="musthave_js">' . __('Required for site', 'default') . '</b>';
            }

            return $actions;
        }

    }

    new DS_DefaultPlugins();

}