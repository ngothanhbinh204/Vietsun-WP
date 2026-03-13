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
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// ---- Query: Tab-1 Swiper ----
$args_swiper = array(
    'post_type'      => 'product',
    'posts_per_page' => 10,
);
if ( $current_term_slug ) {
    $args_swiper['tax_query'] = array(
        array( 'taxonomy' => 'product_cat', 'field' => 'slug', 'terms' => $current_term_slug ),
    );
}
$products_swiper = new WP_Query($args_swiper);

// ---- Query: Tab-2 Grid with pagination ----
// Nếu đang ở archive/taxonomy, dùng the main query để pagination hoạt động đúng
if ( is_tax('product_cat') || is_post_type_archive('product') ) {
    $products_grid = $GLOBALS['wp_query']; // main WP_Query
    $paged         = max(1, get_query_var('paged'));
} else {
    // Static page: tự tạo query
    $args_grid = array(
        'post_type'      => 'product',
        'posts_per_page' => 12,
        'paged'          => $paged,
    );
    if ( $current_term_slug ) {
        $args_grid['tax_query'] = $args_swiper['tax_query'];
    }
    $products_grid = new WP_Query($args_grid);
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
                            <li class="active"><a href="#tab-1"><img src="<?php echo get_template_directory_uri(); ?>/img/slide-icon.svg" alt="Slide view" /></a></li>
                            <li><a href="#tab-2"><img src="<?php echo get_template_directory_uri(); ?>/img/gallery-thumbnails.svg" alt="Gallery view" /></a></li>
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

                    <!-- Tab 1: Swiper Carousel View -->
                    <div class="tabslet-content active" id="tab-1">
                        <?php if ( $products_swiper->have_posts() ) : ?>
                        <div class="box-swiper">
                            <div class="swiper-products relative">
                                <div class="swiper" data-id-swiper="products">
                                    <div class="swiper-wrapper">
                                        <?php while ( $products_swiper->have_posts() ) : $products_swiper->the_post();
                                            $subtitle = get_field('product_subtitle');
                                            $techs    = get_field('product_techs');
                                            $thumb    = get_the_post_thumbnail_url(null, 'large');
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="child">
                                                <div class="item">
                                                    <a class="img img-ratio ratio:pt-[320_290] rounded-4" href="<?php the_permalink(); ?>">
                                                        <?php if ( $thumb ) : ?>
                                                            <img class="lozad" src="<?php echo esc_url($thumb); ?>" data-src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" />
                                                        <?php endif; ?>
                                                        <div class="bg-text"><span><?php the_title(); ?></span></div>
                                                        <div class="content">
                                                            <h3 class="title uppercase heading-6"><?php the_title(); ?></h3>
                                                            <?php if ( $subtitle ) : ?>
                                                                <span class="sub-title body-3"><?php echo esc_html($subtitle); ?></span>
                                                            <?php endif; ?>
                                                            <?php if ( $techs ) : ?>
                                                            <div class="desc">
                                                                <strong>Tech:</strong>
                                                                <?php foreach ( $techs as $tech ) : ?>
                                                                    <span><?php echo esc_html($tech['name']); ?></span>
                                                                <?php endforeach; ?>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endwhile; wp_reset_postdata(); ?>
                                    </div>
                                </div>
                                <div class="button-swiper">
                                    <div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="products"><i class="fa-regular fa-chevron-left"></i></div>
                                    <div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="products"><i class="fa-regular fa-chevron-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <?php else : ?>
                        <p class="text-center py-10"><?php esc_html_e('Chưa có sản phẩm nào.', 'canhcamtheme'); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Tab 2: Grid View with Pagination -->
                    <div class="tabslet-content" id="tab-2">
                        <?php if ( $products_grid->have_posts() ) : ?>
                        <div class="box-grid">
                            <?php while ( $products_grid->have_posts() ) : $products_grid->the_post();
                                $subtitle = get_field('product_subtitle');
                                $techs    = get_field('product_techs');
                                $thumb    = get_the_post_thumbnail_url(null, 'large');
                            ?>
                            <div class="item-grid group">
                                <a class="img img-ratio ratio:pt-[1_1] zoom-img rounded-4" href="<?php the_permalink(); ?>" data-fancybox="gallery">
                                    <?php if ( $thumb ) : ?>
                                        <img class="lozad" src="<?php echo esc_url($thumb); ?>" data-src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" />
                                    <?php endif; ?>
                                    <div class="content">
                                        <h3 class="title uppercase heading-6"><?php the_title(); ?></h3>
                                        <?php if ( $subtitle ) : ?>
                                            <span class="sub-title body-3"><?php echo esc_html($subtitle); ?></span>
                                        <?php endif; ?>
                                        <?php if ( $techs ) : ?>
                                        <div class="desc">
                                            <strong>Tech:</strong>
                                            <?php foreach ( $techs as $tech ) : ?>
                                                <span><?php echo esc_html($tech['name']); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>

                        <!-- Pagination -->
                        <?php
                        $total_pages = $products_grid->max_num_pages;
                        if ( $total_pages > 1 ) :
                            $paged_now = max(1, (int) get_query_var('paged'));
                        ?>
                        <div class="navigation flex-center gap-3 mt-base">
                            <a class="btn-navigation btn-frist" href="<?php echo esc_url(get_pagenum_link(1)); ?>"><i class="fa-regular fa-angles-left"></i></a>
                            <a class="btn-navigation btn-next" href="<?php echo esc_url(get_pagenum_link(max(1, $paged_now - 1))); ?>"><i class="fa-regular fa-angle-left"></i></a>
                            <?php for ( $i = 1; $i <= $total_pages; $i++ ) :
                                $active_class = ($i === $paged_now) ? 'active' : '';
                            ?>
                            <a class="btn-navigation btn-count-page <?php echo $active_class; ?>" href="<?php echo esc_url(get_pagenum_link($i)); ?>"><span><?php echo $i; ?></span></a>
                            <?php endfor; ?>
                            <a class="btn-navigation btn-prev" href="<?php echo esc_url(get_pagenum_link(min($total_pages, $paged_now + 1))); ?>"><i class="fa-regular fa-angle-right"></i></a>
                            <a class="btn-navigation btn-last" href="<?php echo esc_url(get_pagenum_link($total_pages)); ?>"><i class="fa-regular fa-angles-right"></i></a>
                        </div>
                        <?php endif; ?>

                        <?php else : ?>
                        <p class="text-center py-10"><?php esc_html_e('Chưa có sản phẩm nào.', 'canhcamtheme'); ?></p>
                        <?php endif; ?>
                    </div>

                </div><!-- .block-main -->
            </div><!-- .tabslet-wrapper -->
        </div>
    </div>
</section>
