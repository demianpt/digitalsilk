<?php
if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_629e06d9c29d2',
		'title' => 'Product Template',
		'fields' => array(
			array(
				'key' => 'field_629e07b1731eb',
				'label' => 'Description Tab',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'ds_asset_type' => '',
				'placement' => 'left',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_629e07c5731ec',
				'label' => 'Description',
				'name' => 'description',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'ds_asset_type' => '',
				'ds_default_value' => 0,
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_629e07db731ed',
						'label' => 'Image Position',
						'name' => 'image_position',
						'type' => 'button_group',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'ds_asset_type' => '',
						'choices' => array(
							'left' => 'left',
							'right' => 'right',
						),
						'allow_null' => 0,
						'default_value' => 'right',
						'layout' => 'horizontal',
						'return_format' => 'value',
					),
					array(
						'key' => 'field_629e07fd731ee',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'ds_asset_type' => '',
						'return_format' => 'array',
						'preview_size' => 'medium',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
					array(
						'key' => 'field_629e081c731ef',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
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
						'key' => 'field_629e0822731f0',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'wysiwyg',
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
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					),
				),
			),
			array(
				'key' => 'field_629e08da731f9',
				'label' => 'Faq Tab',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'ds_asset_type' => '',
				'placement' => 'left',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_62a9bb7cdc6ff',
				'label' => '',
				'name' => 'faq_heading',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_62a9bb83dc700',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => 'FAQ',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_62a9bb92dc701',
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
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
				),
			),
			array(
				'key' => 'field_624b3b669ed39',
				'label' => 'FAQ',
				'name' => 'faq',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'ds_asset_type' => '',
				'post_type' => array(
					0 => 'faq',
				),
				'taxonomy' => '',
				'allow_null' => 0,
				'multiple' => 1,
				'return_format' => 'object',
				'ui' => 1,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
				),
			),
		),
		'menu_order' => -1,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'the_content',
		),
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	));

endif;