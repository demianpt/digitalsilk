<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_60ec66f4b18c1',
        'title' => 'Post Details',
        'fields' => array(
            array(
                'key' => 'field_60ec66fb6e9ff',
                'label' => 'Pretitle',
                'name' => 'pretitle',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'ds_asset_type' => '',
                'ds_default_value' => 0,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_60ec670a6ea00',
                'label' => 'Subtitle',
                'name' => 'subtitle',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'ds_asset_type' => '',
                'ds_default_value' => 0,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_60ec67106ea01',
                'label' => 'Description',
                'name' => 'description',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'ds_asset_type' => '',
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => 4,
                'new_lines' => 'wpautop',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'case_studies',
                ),
            ),
	        array(
		        array(
			        'param' => 'post_type',
			        'operator' => '==',
			        'value' => 'post',
		        ),
	        ),
	        array(
		        array(
			        'param' => 'post_type',
			        'operator' => '==',
			        'value' => 'events',
		        ),
	        ),
        ),
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

endif;