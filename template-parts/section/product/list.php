<?php
/**
 * Product List Component
 */

$current_cat_id = 0;
if ( is_tax('product_cat') ) {
    $current_term = get_queried_object();
    $current_cat_id = $current_term->term_id;
}

// Get all parent level product categories
$categories = get_terms( array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'parent'     => 0, // Chỉ lấy cấp cao nhất hoặc tuỳ chọn thích hợp
) );
?>
<section class="section-product">
    <div class="section-py">
        <div class="container-fluid">
            <!-- Removed data-toggle="tabslet" logic since we rely on actual archive links -->
            <div class="tabslet-wrapper">
                <div class="block-button">
                    <div class="box-top">
                        <h1 class="heading-1 title uppercase"><?php esc_html_e('OUR PRODUCT', 'canhcam'); ?></h1>
                        <!-- <ul class="tabslet-tab"> hiện tại không dùng tab tĩnh mà sẽ load thẳng -->
                    </div>
                    <div class="box-bottom">
                        <ul>
                            <li class="<?php echo ($current_cat_id === 0) ? 'active' : ''; ?>">
                                <a href="<?php echo get_post_type_archive_link('product'); ?>">
                                    <div class="icon"><img src="<?php echo THEME_URI; ?>/img/icon-home-4.svg" alt="All"></div>
                                    <div class="content"><p><?php esc_html_e('Tất cả', 'canhcam'); ?></p></div>
                                </a>
                            </li>

                            <?php 
                            if ( !empty($categories) && !is_wp_error($categories) ) :
                                foreach ( $categories as $cat ) : 
                                    $cat_icon = get_field('product_cat_icon', 'product_cat_' . $cat->term_id);
                                    $icon_src = $cat_icon ? esc_url($cat_icon) : THEME_URI . '/img/icon-home-4.svg';
                                    $is_active = ($current_cat_id === $cat->term_id) ? 'active' : '';
                            ?>
                            <li class="<?php echo $is_active; ?>">
                                <a href="<?php echo esc_url(get_term_link($cat)); ?>">
                                    <div class="icon"><img src="<?php echo $icon_src; ?>" alt="<?php echo esc_attr($cat->name); ?>"></div>
                                    <div class="content">
                                        <p><?php echo esc_html($cat->name); ?></p>
                                    </div>
                                </a>
                            </li>
                            <?php 
                                endforeach; 
                            endif; 
                            ?>
                        </ul>
                    </div>
                </div>
                
                <div class="block-main">
                    <div class="tabslet-content active" style="display: block;">
                        <?php if ( have_posts() ) : ?>
                            <div class="box-grid">
                                <?php 
                                while ( have_posts() ) : the_post(); 
                                    $subtitle = get_field('product_subtitle');
                                    $techs = get_field('product_techs');
                                ?>
                                <div class="item-grid group">
                                    <a class="img img-ratio ratio:pt-[1_1] zoom-img rounded-4" href="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" data-fancybox="gallery">
                                        <img class="lozad" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                                        
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
                                <?php endwhile; ?>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="navigation flex-center gap-3 mt-base">
                                <?php 
                                $page_links = paginate_links( array(
                                    'type'      => 'array',
                                    'prev_text' => '<i class="fa-regular fa-angle-left"></i>',
                                    'next_text' => '<i class="fa-regular fa-angle-right"></i>',
                                ) );

                                if ( !empty($page_links) ) {
                                    $first_link = get_pagenum_link(1);
                                    global $wp_query;
                                    $last_link = get_pagenum_link($wp_query->max_num_pages);
                                    
                                    echo '<a href="'.esc_url($first_link).'" class="btn-navigation btn-frist"><i class="fa-regular fa-angles-left"></i></a>';
                                    
                                    foreach ( $page_links as $link ) {
                                        $is_current = strpos($link, 'current') !== false;
                                        $class = $is_current ? 'btn-navigation btn-count-page current' : 'btn-navigation btn-count-page';
                                        
                                        if ( $is_current ) {
                                            echo '<div class="' . $class . '"><span>' . strip_tags($link) . '</span></div>';
                                        } else if ( strpos($link, 'prev') !== false ) {
                                            echo '<div class="btn-navigation btn-prev">' . str_replace("page-numbers", "", $link) . '</div>';
                                        } else if ( strpos($link, 'next') !== false ) {
                                            echo '<div class="btn-navigation btn-next">' . str_replace("page-numbers", "", $link) . '</div>';
                                        } else {
                                            echo '<div class="' . $class . '">' . str_replace("page-numbers", "", $link) . '</div>';
                                        }
                                    }
                                    
                                    echo '<a href="'.esc_url($last_link).'" class="btn-navigation btn-last"><i class="fa-regular fa-angles-right"></i></a>';
                                }
                                ?>
                            </div>
                        <?php else : ?>
                            <p class="text-center py-10"><?php esc_html_e('Chưa có sản phẩm nào.', 'canhcam'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
