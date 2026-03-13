<?php
function canhcam_register_custom_post_types() {
    $labels = array(
        'name'                  => _x( 'Factories', 'Post Type General Name', 'canhcam' ),
        'singular_name'         => _x( 'Factory', 'Post Type Singular Name', 'canhcam' ),
        'menu_name'             => __( 'Factories', 'canhcam' ),
        'all_items'             => __( 'All Factories', 'canhcam' ),
        'add_new_item'          => __( 'Add New Factory', 'canhcam' ),
        'add_new'               => __( 'Add New', 'canhcam' ),
    );
    $args = array(
        'label'                 => __( 'Factory', 'canhcam' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-building',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'factory', $args );

    // Register Product CPT
    $product_labels = array(
        'name'                  => _x( 'Products', 'Post Type General Name', 'canhcam' ),
        'singular_name'         => _x( 'Product', 'Post Type Singular Name', 'canhcam' ),
        'menu_name'             => __( 'Products', 'canhcam' ),
        'all_items'             => __( 'All Products', 'canhcam' ),
        'add_new_item'          => __( 'Add New Product', 'canhcam' ),
        'add_new'               => __( 'Add New', 'canhcam' ),
    );
    $product_args = array(
        'label'                 => __( 'Product', 'canhcam' ),
        'labels'                => $product_labels,
        'supports'              => array( 'title', 'thumbnail', 'editor' ),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-cart',
        'has_archive'           => true,
        'rewrite'               => array('slug' => 'product'),
    );
    register_post_type( 'product', $product_args );

    // Register Taxonomy for Product
    $tax_labels = array(
        'name'                       => _x( 'Product Categories', 'Taxonomy General Name', 'canhcam' ),
        'singular_name'              => _x( 'Product Category', 'Taxonomy Singular Name', 'canhcam' ),
        'menu_name'                  => __( 'Categories', 'canhcam' ),
        'all_items'                  => __( 'All Categories', 'canhcam' ),
        'add_new_item'               => __( 'Add New Category', 'canhcam' ),
    );
    $tax_args = array(
        'labels'                     => $tax_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'rewrite'                    => array('slug' => 'product-category'),
    );
    register_taxonomy( 'product_cat', array( 'product' ), $tax_args );
}
add_action( 'init', 'canhcam_register_custom_post_types', 0 );
