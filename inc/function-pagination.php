<?php

/**
 * WordPress Bootstrap Pagination
 *
 * <?php echo wp_bootstrap_pagination(array('custom_query' => $the_query)) ?>
 *
 * Thêm tham số sau vào WP_Query
 * $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
 * 'paged' => $paged
 */
function wp_bootstrap_pagination($args = array())
{

	$defaults = array(
		'range' => 4,
		'custom_query' => FALSE,
		'previous_string' => __('Trước', 'text-domain'),
		'next_string' => __('Sau', 'text-domain'),
		'before_output' => '<div class="post-nav">
	<ul class="pager">',
		'after_output' => '</ul>
</div>'
	);

	$args = wp_parse_args(
		$args,
		apply_filters('wp_bootstrap_pagination_defaults', $defaults)
	);

	$args['range'] = (int) $args['range'] - 1;
	if (!$args['custom_query'])
		$args['custom_query'] = @$GLOBALS['wp_query'];
	$count = (int) $args['custom_query']->max_num_pages;
	$page = intval(get_query_var('paged'));
	$ceil = ceil($args['range'] / 2);

	if ($count <= 1) return FALSE;
	if (!$page) $page = 1;
	if ($count > $args['range']) {
		if ($page <= $args['range']) {
			$min = 1;
			$max = $args['range'] + 1;
		} elseif ($page >= ($count - $ceil)) {
			$min = $count - $args['range'];
			$max = $count;
		} elseif ($page >= $args['range'] && $page < ($count - $ceil)) {
			$min = $page - $ceil;
			$max = $page + $ceil;
		}
	} else {
		$min = 1;
		$max = $count;
	}
	$echo = '';
	$previous = intval($page) - 1;
	$previous = esc_attr(get_pagenum_link($previous));
	$firstpage = esc_attr(get_pagenum_link(1));
	if ($firstpage && (1 != $page)) $echo .= '<li class="previous hidden"><a href="' . $firstpage . '">' . __('Đầu tiên', 'text-domain') . '</a></li>';
	if ($previous && (1 != $page)) $echo .= '<li class="hidden"><a href="' . $previous . '" title="' . __('Trước', 'text-domain') . '">' . $args['previous_string'] . '</a></li>';
	if (!empty($min) && !empty($max)) {
		for ($i = $min; $i <= $max; $i++) {
			if ($page == $i) {
				$echo .= '<li class="active"><span class="active">' . str_pad((int)$i, 2, '0', STR_PAD_LEFT) . '</span></li>';
			} else {
				$echo .= sprintf('<li><a href="%s">%002d</a></li>', esc_attr(get_pagenum_link($i)), $i);
			}
		}
	}
	$next = intval($page) + 1;
	$next = esc_attr(get_pagenum_link($next));
	if ($next && ($count != $page)) $echo .= '<li class="hidden"><a href="' . $next . '" title="' . __('Kế tiếp', 'text-domain') . '">' . $args['next_string'] . '</a></li>';
	$lastpage = esc_attr(get_pagenum_link($count));
	if ($lastpage) {
		$echo .= '<li class="next hidden"><a href="' . $lastpage . '">' . __('Cuối cùng', 'text-domain') . '</a></li>';
	}
	if (isset($echo)) echo $args['before_output'] . $echo . $args['after_output'];
}

/**
 * canhcam Custom Pagination
 * 
 * Output HTML structure:
 * <div class="navigation flex-center gap-3 mt-10">
 *     <a class="btn-navigation btn-frist" href="#"><i class="fa-regular fa-angles-left"></i></a>
 *     ...
 * </div>
 * 
 * Usage: <?php canhcam_pagination(); ?> or <?php canhcam_pagination($custom_query); ?>
 * 
 * @param WP_Query|null $custom_query Optional custom WP_Query object
 * @param array $args Optional arguments
 */
function canhcam_pagination($custom_query = null, $args = array()) {
    // Default arguments
    $defaults = array(
        'range'           => 5,        // Number of page links to show
        'wrapper_class'   => 'navigation flex-center gap-3 mt-10',
        'is_ajax'         => false,    // Set true to use javascript:void(0) and rely on data-page
    );
    
    $args = wp_parse_args($args, $defaults);
    
    // Get the query object
    if ($custom_query === null) {
        global $wp_query;
        $custom_query = $wp_query;
    }
    
    // Get total pages
    $total_pages = (int) $custom_query->max_num_pages;
    
    // Don't show pagination if only 1 page
    if ($total_pages <= 1) {
        return;
    }
    
    // Get current page
    if ( $custom_query->get('paged') > 0 ) {
        $current_page = $custom_query->get('paged');
    } elseif ( get_query_var('paged') ) {
        $current_page = get_query_var('paged');
    } elseif ( get_query_var('page') ) {
        $current_page = get_query_var('page');
    } else {
        $current_page = 1;
    }
    
    // Calculate range
    $range = (int) $args['range'];
    $half_range = floor($range / 2);
    
    // Calculate start and end page numbers
    $start_page = max(1, $current_page - $half_range);
    $end_page = min($total_pages, $current_page + $half_range);
    
    // Adjust if we're near the beginning or end
    if ($current_page <= $half_range) {
        $end_page = min($total_pages, $range);
    }
    if ($current_page > $total_pages - $half_range) {
        $start_page = max(1, $total_pages - $range + 1);
    }
    
    // Helper to get link
    $get_link = function($page) use ($args) {
        if ($args['is_ajax']) return 'javascript:void(0);';
        
        $link = get_pagenum_link($page);
        if (isset($_GET['layout'])) {
            $link = add_query_arg('layout', sanitize_text_field($_GET['layout']), $link);
        }
        return esc_url($link);
    };

    // Helper to get data attribute
    $get_data = function($page) use ($args) {
        return $args['is_ajax'] ? ' data-page="' . $page . '"' : '';
    };

    // Start output
    $output = '<div class="' . esc_attr($args['wrapper_class']) . '">';
    
    // First page link
    if ($current_page > 1) {
        $output .= '<a class="btn-navigation btn-frist" href="' . $get_link(1) . '"' . $get_data(1) . '>';
        $output .= '<i class="fa-regular fa-angles-left"></i>';
        $output .= '</a>';
    }
    
    // Page number links
    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $current_page) {
            $output .= '<div class="btn-navigation btn-count-page active"><span' . $get_data($i) . '>' . $i . '</span></div>';
        } else {
            $output .= '<a class="btn-navigation btn-count-page" href="' . $get_link($i) . '"' . $get_data($i) . '>';
            $output .= '<span>' . $i . '</span>';
            $output .= '</a>';
        }
    }
    
    // Last page link
    if ($current_page < $total_pages) {
        $output .= '<a class="btn-navigation btn-last" href="' . $get_link($total_pages) . '"' . $get_data($total_pages) . '>';
        $output .= '<i class="fa-regular fa-angles-right"></i>';
        $output .= '</a>';
    }
    
    $output .= '</div>';
    
    echo $output;
}

/**
 * Simple canhcam Pagination (no prev/next, no dots)
 * 
 * Output exactly like the HTML structure provided:
 * <div class="navigation flex-center gap-3 mt-10">
 *     <a class="btn-navigation btn-frist" href="#"><i class="fa-regular fa-angles-left"></i></a>
 *     ...
 * </div>
 * 
 * @param WP_Query|null $custom_query Optional custom WP_Query object
 */
function canhcam_pagination_simple($custom_query = null) {
    // Get the query object
    if ($custom_query === null) {
        global $wp_query;
        $custom_query = $wp_query;
    }
    
    // Get total pages
    $total_pages = (int) $custom_query->max_num_pages;
    
    // Don't show pagination if only 1 page
    if ($total_pages <= 1) {
        return;
    }
    
    // Get current page
    $current_page = max(1, get_query_var('paged'));
    
    // Start output
    $output = '<div class="navigation flex-center gap-3 mt-10">';
    
    // First page link
    if ($current_page > 1) {
        $output .= '<a class="btn-navigation btn-frist" href="' . esc_url(get_pagenum_link(1)) . '"><i class="fa-regular fa-angles-left"></i></a>';
    }
    
    // Page number links
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            $output .= '<div class="btn-navigation btn-count-page active"><span>' . $i . '</span></div>';
        } else {
            $output .= '<a class="btn-navigation btn-count-page" href="' . esc_url(get_pagenum_link($i)) . '"><span>' . $i . '</span></a>';
        }
    }
    
    // Last page link
    if ($current_page < $total_pages) {
        $output .= '<a class="btn-navigation btn-last" href="' . esc_url(get_pagenum_link($total_pages)) . '"><i class="fa-regular fa-angles-right"></i></a>';
    }
    
    $output .= '</div>';
    
    echo $output;
}
