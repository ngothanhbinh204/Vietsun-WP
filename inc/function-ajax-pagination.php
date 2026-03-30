<?php
/**
 * Generic AJAX Pagination for CanhCam Theme
 * Reusable for any post type loop by providing data attributes to the wrapper container.
 */

// 1. AJAX Handler
function canhcam_ajax_pagination_handler() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'post';
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 10;
    $template_part = isset($_POST['template_part']) ? sanitize_text_field($_POST['template_part']) : '';
    $empty_msg = isset($_POST['empty_msg']) ? sanitize_text_field($_POST['empty_msg']) : 'Không có dữ liệu.';
    
    $taxonomy = isset($_POST['taxonomy']) ? sanitize_text_field($_POST['taxonomy']) : '';
    $term = isset($_POST['term']) ? sanitize_text_field($_POST['term']) : '';

    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'post_status' => 'publish'
    );
    
    if ($taxonomy && $term) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => $term
            )
        );
    }
    
    $query = new WP_Query($args);
    
    ob_start();
    if ($query->have_posts()) {
        $count = ($paged - 1) * $posts_per_page + 1;
        while ($query->have_posts()) {
            $query->the_post();
            set_query_var('current_ajax_count', $count);
            if ($template_part) {
                // If template part is provided, load it
                get_template_part($template_part);
            }
            $count++;
        }
    } else {
        // Fallback or empty message
        echo '<tr><td colspan="5" class="text-center py-4">' . esc_html($empty_msg) . '</td></tr>';
    }
    $html = ob_get_clean();
    
    ob_start();
    if (function_exists('canhcam_pagination') && $query->max_num_pages > 1) {
        canhcam_pagination($query, array('is_ajax' => true));
    }
    $pagination = ob_get_clean();
    
    wp_send_json_success(array(
        'html' => $html,
        'pagination' => $pagination,
        'max_pages' => $query->max_num_pages
    ));
}
add_action('wp_ajax_canhcam_ajax_pagination', 'canhcam_ajax_pagination_handler');
add_action('wp_ajax_nopriv_canhcam_ajax_pagination', 'canhcam_ajax_pagination_handler');

// 2. JS Script for Frontend (Enqueued File)
function canhcam_ajax_enqueue_scripts() {
    wp_enqueue_script(
        'canhcam-ajax-frontend', 
        get_template_directory_uri() . '/scripts/frontend.js', 
        array(), 
        filemtime(get_template_directory() . '/scripts/frontend.js'), 
        true
    );
    
    // Đẩy biến ajax_url từ server side xuống để JS có thể đọc được
    wp_localize_script('canhcam-ajax-frontend', 'canhcam_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'canhcam_ajax_enqueue_scripts');
