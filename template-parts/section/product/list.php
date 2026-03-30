<?php
/**
 * Shared Product List Section
 * 
 * Dùng chung cho: template-products.php, archive-product.php, taxonomy-product_cat.php
 * 
 * Context vars (set trước khi gọi get_template_part):
 *   $current_term   (object|null)  — term hiện tại nếu đang ở taxonomy page
 *   $is_archive     (bool)         — true nếu đang ở archive-product.php
 */

// ---- ACF Options ----
$page_title = get_field('product_archive_title', 'option') ?: 'OUR PRODUCT';
$desc       = get_field('product_archive_desc', 'option');
$stats      = get_field('product_archive_stats', 'option');

// ---- Taxonomy: lấy tất cả danh mục sản phẩm ----
$product_cats = get_terms(array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
));

// ---- Active term: xác định category đang được filter ----
$current_term_slug = '';
if ( is_tax('product_cat') ) {
    $current_term_obj   = get_queried_object();
    $current_term_slug  = $current_term_obj ? $current_term_obj->slug : '';
}

// ---- Paging ----
$paged = max(1, get_query_var('paged'));
$posts_per_page = 16;

// ---- Query: Common args ----
$common_args = array(
    'post_type'      => 'product',
    'posts_per_page' => $posts_per_page,
    'paged'          => $paged,
);
if ( $current_term_slug ) {
    $common_args['tax_query'] = array(
        array( 'taxonomy' => 'product_cat', 'field' => 'slug', 'terms' => $current_term_slug ),
    );
}

// ---- Query: Tab-1 Swiper ----
$products_swiper = new WP_Query($common_args);

// ---- Query: Tab-2 Grid ----
// Nếu đang hệ thống archive, ta có thể dùng main query cho grid để tối ưu, 
// nhưng để đồng nhất số lượng posts_per_page và paged trên cả 2 view, ta dùng chung 1 object query hoặc sync config.
$products_grid = $products_swiper; 

// ---- Tab State ----
// Ưu tiên lấy layout từ URL (?layout=grid hoặc layout=swiper)
$layout_param = isset($_GET['layout']) ? sanitize_text_field($_GET['layout']) : '';
if ( $layout_param === 'grid' ) {
    $active_tab = 2;
} elseif ( $layout_param === 'swiper' ) {
    $active_tab = 1;
} else {
    // Nếu không có param, ưu tiên Grid nếu paged > 1
    $active_tab = ($paged > 1) ? 2 : 1;
}
?>

<section class="section-product">
    <div class="section-py">
        <div class="container-fluid">
            <div class="tabslet-wrapper" data-toggle="tabslet">

                <!-- Sidebar: Display Mode + Category + Stats -->
                <div class="block-button">

                    <!-- box-top: tiêu đề + tab icon -->
                    <div class="box-top">
                        <h2 class="heading-1 title uppercase"><?php echo esc_html($page_title); ?></h2>
                        <ul class="tabslet-tab">
                            <li class="<?php echo ($active_tab === 1) ? 'active' : ''; ?>"><a href="#tab-1"><img src="<?php echo get_template_directory_uri(); ?>/img/slide-icon.svg" alt="Slide view" /></a></li>
                            <li class="<?php echo ($active_tab === 2) ? 'active' : ''; ?>"><a href="#tab-2"><img src="<?php echo get_template_directory_uri(); ?>/img/gallery-thumbnails.svg" alt="Gallery view" /></a></li>
                        </ul>
                    </div>

                    <!-- box-mid: danh sách category -->
                    <?php if ( !is_wp_error($product_cats) && $product_cats ) : ?>
                    <div class="box-mid">
                        <ul>
                            <?php foreach ( $product_cats as $cat ) :
                                $icon    = get_field('product_cat_icon', 'product_cat_' . $cat->term_id);
                                $cat_url = get_term_link($cat);
                                $active  = ($current_term_slug === $cat->slug) ? 'active' : '';
                            ?>
                            <li>
                                <a class="<?php echo $active; ?>" href="<?php echo esc_url($cat_url); ?>">
                                    <div class="icon">
                                        <?php if ( $icon ) : ?>
                                            <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($cat->name); ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="content">
                                        <p><?php echo esc_html($cat->name); ?></p>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- box-bottom: mô tả + số liệu -->
                    <div class="box-bottom">
                        <?php if ( $desc ) : ?>
                        <div class="content prose">
                            <?php echo wp_kses_post($desc); ?>
                        </div>
                        <?php endif; ?>

                        <?php if ( $stats ) : ?>
                        <div class="number">
                            <?php foreach ( $stats as $stat ) : ?>
                            <div class="item-number">
                                <span><?php echo esc_html($stat['number']); ?></span>
                                <strong><?php echo esc_html($stat['label']); ?></strong>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                </div><!-- .block-button -->

                <!-- Main Content Area -->
                <div class="block-main">

                    <!-- Tab 1: Swiper Carousel View with Pagination -->
                    <?php
                        $data_tax = 'product_cat';
                        $data_term = $current_term_slug;
                        $data_posts_per_page = 16;
                    ?>
                    <div class="tabslet-content <?php echo ($active_tab === 1) ? 'active' : ''; ?> canhcam-ajax-wrapper" id="tab-1" data-post-type="product" data-posts-per-page="<?php echo esc_attr($data_posts_per_page); ?>" data-template-part="template-parts/section/product/item-swiper" <?php if ($data_term) echo 'data-taxonomy="'.esc_attr($data_tax).'" data-term="'.esc_attr($data_term).'"'; ?>>
                        <?php if ( $products_swiper->have_posts() ) : ?>
                        <div class="box-swiper">
                            <div class="swiper-products relative">
                                <div class="swiper" data-id-swiper="products">
                                    <div class="swiper-wrapper ajax-list-container">
                                        <?php while ( $products_swiper->have_posts() ) : $products_swiper->the_post();
                                            get_template_part('template-parts/section/product/item-swiper');
                                        endwhile; wp_reset_postdata(); ?>
                                    </div>
                                </div>
                                <div class="button-swiper">
                                    <div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="products"><i class="fa-regular fa-chevron-left"></i></div>
                                    <div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="products"><i class="fa-regular fa-chevron-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <?php
                        $total_swiper_pages = $products_swiper->max_num_pages;
                        if ( $total_swiper_pages > 1 ) :
                        ?>
                        <div class="ajax-pagination-container">
                            <?php canhcam_pagination($products_swiper); ?>
                        </div>
                        <?php endif; ?>

                        <?php else : ?>
                        <div class="ajax-list-container">
                            <p class="text-center py-10"><?php esc_html_e('No products found', 'canhcamtheme'); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Tab 2: Grid View with Pagination -->
                    <?php
                        // Cấu hình Ajax
                        $data_tax = 'product_cat';
                        $data_term = $current_term_slug;
                        $data_posts_per_page = 16;
                    ?>
                    <div class="tabslet-content <?php echo ($active_tab === 2) ? 'active' : ''; ?> canhcam-ajax-wrapper" id="tab-2" data-post-type="product" data-posts-per-page="<?php echo esc_attr($data_posts_per_page); ?>" data-template-part="template-parts/section/product/item-grid" <?php if ($data_term) echo 'data-taxonomy="'.esc_attr($data_tax).'" data-term="'.esc_attr($data_term).'"'; ?>>
                        <?php 
                        $products_grid->rewind_posts();
                        if ( $products_grid->have_posts() ) : 
                        ?>
                        <div class="box-grid ajax-list-container">
                            <?php while ( $products_grid->have_posts() ) : $products_grid->the_post();
                                get_template_part('template-parts/section/product/item-grid');
                            endwhile; wp_reset_postdata(); ?>
                        </div>

                        <!-- Pagination -->
                        <?php
                        $total_pages = $products_grid->max_num_pages;
                        if ( $total_pages > 1 ) :
                        ?>
                        <div class="ajax-pagination-container">
                            <?php canhcam_pagination($products_grid); ?>
                        </div>
                        <?php endif; ?>

                        <?php else : ?>
                        <div class="ajax-list-container">
                            <p class="text-center py-10"><?php esc_html_e('Chưa có sản phẩm nào.', 'canhcamtheme'); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>

                </div><!-- .block-main -->
            </div><!-- .tabslet-wrapper -->
        </div>
    </div>
</section>
