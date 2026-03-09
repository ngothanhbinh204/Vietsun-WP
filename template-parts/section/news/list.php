<?php
/**
 * News List Section Template (Used in home.php and category.php)
 */

$page_for_posts = get_option('page_for_posts');
$blog_url = get_permalink($page_for_posts);

// Get all categories for filter
$categories = get_terms(array(
    'taxonomy'   => 'category',
    'hide_empty' => true,
));

$current_cat_id = 0;
$current_cat_name = __('Tất cả', 'canhcam');
if ( is_category() ) {
    $current_cat = get_queried_object();
    $current_cat_id = $current_cat->term_id;
    $current_cat_name = $current_cat->name;
}
?>
<section class="section-news">
    <!-- Note: Removed data-toggle="tabslet" since tabs are real pages now -->
    <div class="wrap">
        <div class="wrap-heading">
            <h2 class="title"><?php echo esc_html(get_the_title($page_for_posts) ?: __('TIN TỨC', 'canhcam')); ?></h2>
        </div>
        
        <!-- Filter Category Tabs -->
        <div class="filter-dropdown">
            <div class="filter-toggle">
                <span class="selected-text"><?php echo esc_html($current_cat_name); ?></span>
                <i class="fa-regular fa-chevron-down"></i>
            </div>
            <ul class="tabslet-tab filter-menu">
                <li class="<?php echo ($current_cat_id === 0) ? 'active' : ''; ?>">
                    <a href="<?php echo esc_url($blog_url); ?>"><span><?php esc_html_e('Tất cả', 'canhcam'); ?></span></a>
                </li>
                <?php foreach( $categories as $cat ) : ?>
                <li class="<?php echo ($current_cat_id === $cat->term_id) ? 'active' : ''; ?>">
                    <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><span><?php echo esc_html($cat->name); ?></span></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="tabslet-content active" style="display: block;">
            <?php if ( have_posts() ) : ?>
                <?php 
                // Xử lý bài ưu tiên (box-news-hot) chỉ xuất hiện ở page 1
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $is_first_post = ($paged == 1); 
                ?>

                <!-- First featured post -->
                <?php if ( $is_first_post ) : the_post(); ?>
                <div class="box-news-hot zoom-img-parent">
                    <div class="box-image img-zoom">
                        <a class="img-ratio ratio:pt-[620_1140]" href="<?php the_permalink(); ?>">
                            <img class="lozad" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                        </a>
                    </div>
                    <div class="box-content">
                        <div class="date-category">
                            <span class="date"><?php echo get_the_date('d.m.Y'); ?></span>
                            <?php 
                            $cats = get_the_category();
                            if ( !empty($cats) ) {
                                echo '<span class="category">' . esc_html($cats[0]->name) . '</span>';
                            }
                            ?>
                        </div>
                        <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <div class="desc prose">
                            <p><?php echo wp_trim_words(get_the_excerpt(), 40); ?></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Remaining Posts Grid -->
                <?php if ( have_posts() ) : ?>
                <div class="box-new">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <a class="card-news group" href="<?php the_permalink(); ?>">
                        <div class="img img-ratio ratio:pt-[296_395] zoom-img rounded-2">
                            <img class="lozad" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                        </div>
                        <div class="box-content">
                            <div class="date">
                                <span><?php echo get_the_date('d/m/Y'); ?></span>
                                <?php 
                                $cats = get_the_category();
                                if ( !empty($cats) ) {
                                    echo '<p>' . esc_html($cats[0]->name) . '</p>';
                                }
                                ?>
                            </div>
                            <div class="title">
                                <h3><?php the_title(); ?></h3>
                            </div>
                        </div>
                    </a>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
                
                <!-- Pagination -->
                <div class="navigation flex-center gap-3 mt-10">
                    <?php 
                    $page_links = paginate_links( array(
                        'type' => 'array',
                        'prev_text' => '<i class="fa-regular fa-angle-left"></i>',
                        'next_text' => '<i class="fa-regular fa-angle-right"></i>',
                    ) );

                    if ( !empty($page_links) ) {
                        foreach ( $page_links as $link ) {
                            // Check if current page span
                            $is_current = strpos($link, 'current') !== false;
                            $class = $is_current ? 'btn-navigation btn-count-page current' : 'btn-navigation btn-count-page';
                            
                            // Replace span with div or keep wrapper A/span
                            if ( strpos($link, 'current') !== false ) {
                                echo '<div class="' . $class . '"><span>' . strip_tags($link) . '</span></div>';
                            } else if ( strpos($link, 'prev') !== false ) {
                                echo '<div class="btn-navigation btn-prev">' . $link . '</div>';
                            } else if ( strpos($link, 'next') !== false ) {
                                echo '<div class="btn-navigation btn-next">' . $link . '</div>';
                            } else {
                                echo '<div class="' . $class . '">' . $link . '</div>';
                            }
                        }
                    }
                    ?>
                </div>

            <?php else : ?>
                <p class="text-center py-10"><?php esc_html_e('Chưa có bài viết nào.', 'canhcam'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
