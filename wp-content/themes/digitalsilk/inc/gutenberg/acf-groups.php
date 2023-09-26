<?php

Class ACFGutenbergBlocks{

    public function __construct()
    {
        add_filter( 'block_categories', 'acf_categories_init', 10, 2);

        add_action('acf/init', 'acf_groups_init');
    }

    public function acf_categories_init( $categories, $post )
    {
        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'ds-blocks',
                    'title' => __( 'DigitalSilk Blocks', 'dstheme' ),
                ),
            )
        );
    }

    public function acf_groups_init()
    {

        if( function_exists('acf_register_block') ) {

            acf_register_block(array(
                'name'				=> 'banner',
                'title'				=> __('Banner'),
                'description'		=> __('Banner Block'),
                'render_callback'	=> array($this,'render_callback'),
                'category'			=> 'ds-blocks',
                'icon'				=> 'groups',
                'keywords'			=> array( 'banner', 'block' ),
            ));

            acf_register_block(array(
                'name'				=> 'cta',
                'title'				=> __('CTA'),
                'description'		=> __('CTA Block'),
                'render_callback'	=> array($this,'render_callback'),
                'category'			=> 'ds-blocks',
                'icon'				=> 'groups',
                'keywords'			=> array( 'cta', 'block' ),
            ));

            acf_register_block(array(
                'name'				=> 'team',
                'title'				=> __('Team'),
                'description'		=> __('Team Block'),
                'render_callback'	=> array($this,'render_callback'),
                'category'			=> 'ds-blocks',
                'icon'				=> 'groups',
                'keywords'			=> array( 'team', 'block' ),
            ));

            acf_register_block(array(
                'name'				=> 'testimonials',
                'title'				=> __('Testimonials'),
                'description'		=> __('Testimonials Block'),
                'render_callback'	=> array($this,'render_callback'),
                'category'			=> 'ds-blocks',
                'icon'				=> 'admin-comments',
                'keywords'			=> array( 'testimonials', 'block' ),
            ));

        }
    }

    public function render_callback( $block )
    {
        $slug = str_replace('acf/', '', $block['name']);
        if( file_exists( get_theme_file_path("/templates/flexible/default/{$slug}.php") ) ) {
            include( get_theme_file_path("/templates/flexible/default/{$slug}.php") );
        }
    }
}
new ACFGutenbergBlocks();
