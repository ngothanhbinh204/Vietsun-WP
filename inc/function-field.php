<?php
// Custom field class for page
function add_field_custom_class_body()
{
	acf_add_local_field_group(array(
		'key' => 'class_body',
		'title' => 'Body: Add Class',
		'fields' => array(),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
		),
	));
	acf_add_local_field(array(
		'key' => 'add_class_body',
		'label' => 'Add class body',
		'name' => 'Add class body',
		'type' => 'text',
		'parent' => 'class_body',
	));
}
add_action('acf/init', 'add_field_custom_class_body');

//

function add_field_select_banner()
{
	acf_add_local_field_group(array(
		'key' => 'select_banner',
		'title' => 'Banner: Select Page',
		'fields' => array(),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
			// Thêm taxonomy ở dưới
			// array(
			// 	array(
			// 		'param' => 'taxonomy',
			// 		'operator' => '==',
			// 		'value' => 'danh-muc-san-pham'
			// 	)
			// )
		),
	));
	acf_add_local_field(array(
		'key' => 'banner_select_page',
		'label' => 'Chọn banner hiển thị',
		'name' => 'Chọn banner hiển thị',
		'type' => 'post_object',
		'post_type' => 'banner',
		'multiple' => 1,
		'parent' => 'select_banner',
	));
}
add_action('acf/init', 'add_field_select_banner');

function add_theme_config_options()
{
	// Add the field group
	acf_add_local_field_group(array(
		'key' => 'group_theme_config',
		'title' => 'Theme Configuration',
		'fields' => array(
			array(
				'key' => 'tab_config',
				'label' => 'Config',
				'name' => 'tab_config',
				'type' => 'tab',
				'placement' => 'top',
			),
			array(
				'key' => 'field_config_head',
				'label' => 'Config Head',
				'name' => 'config_head',
				'type' => 'textarea',
				'instructions' => 'Add custom code for header (CSS, meta tags, etc)',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 4,
				'new_lines' => '',
			),
			array(
				'key' => 'field_config_body',
				'label' => 'Config Body',
				'name' => 'config_body',
				'type' => 'textarea',
				'instructions' => 'Add custom code for body (JS, tracking code, etc)',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 4,
				'new_lines' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'theme-settings',
				),
			),
		),
		'menu_order' => 999,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
	));
}
add_action('acf/init', 'add_theme_config_options');

// Khởi tạo Options Page cho Theme Settings (Gộp chung)
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Theme Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-settings', // Tất cả các field options gom chung vào slug này
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'icon_url'      => 'dashicons-admin-settings',
    ));
}

// Ensure ACF loads local JSON correctly from our directory
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    // remove original path
    unset($paths[0]);
    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}