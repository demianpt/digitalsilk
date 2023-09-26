<?php
/**
 * Default theme shortcodes.
 * Can be used for "copyright" field
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'DS_ThemeShortcodes' ) ) {

    class DS_ThemeShortcodes{

        public function __construct()
        {
            add_shortcode( 'day', array( $this, 'day' ) );
            add_shortcode( 'month', array( $this, 'month' ) );
            add_shortcode( 'year', array( $this, 'year' ) );
            add_shortcode( 'copyright', array( $this, 'copyright' ) );
            add_shortcode( 'copyright_date', array( $this, 'copyright_date' ) );
        }

        /**
         * Display current month
         */
        public function month()
        {
            return date( 'm' );
        }

        /**
         * Display current day
         */
        public function day()
        {
            return date( 'd' );
        }

        /**
         * Display current year
         */
        public function year()
        {
            return date( 'Y' );
        }

        /**
         * Display copyright symbol
         */
        public function copyright()
        {
            return '&copy;';
        }

        /**
         * Display date with copyright symbol
         */
        public function copyright_date()
        {
            return date( 'Y' ) . ' &copy;';
        }

    }

    new DS_ThemeShortcodes();

}