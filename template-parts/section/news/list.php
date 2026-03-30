<?php
/**
 * News List Section Template
 * 
 * Dùng chung cho: archive.php, category.php, và search.php
 * 
 * $args['hide_hot'] (bool) - Nếu true, sẽ không hiển thị bài viết lớn box-news-hot.
 */

$hide_hot        = isset($args['hide_hot']) ? $args['hide_hot'] : false;
$page_for_posts  = get_option('page_for_posts');
$blog_url        = get_permalink($page_for_posts);
$news_page_title = is_search() ? __('SEARCH RESULTS', 'canhcamtheme') : (get_the_title($page_for_posts) ?: 'NEWS');

// Lấy tất cả categories có bài viết
$categories = get_terms(array(
    'taxonomy'   => 'category',
    'hide_empty' => true,
));

// Xác định category đang active
$current_cat_id   = 0;
$current_cat_name = is_search() ? __('Search', 'canhcamtheme') : __('All', 'canhcamtheme');
if ( is_category() ) {
    $current_cat       = get_queried_object();
    $current_cat_id    = $current_cat->term_id;
    $current_cat_name  = $current_cat->name;
}

$paged = max(1, (int) get_query_var('paged'));
?>
<section class="section-news">
    <div class="wrap">

        <?php if ( !is_search() ) : ?>
        <!-- Heading (Ẩn ở trang search vì search.php đã có title riêng) -->
        <div class="wrap-heading">
            <h2 class="title"><?php echo esc_html($news_page_title); ?></h2>
        </div>
        <?php endif; ?>

        <!-- Filter Dropdown -->
        <div class="filter-dropdown">
            <div class="filter-toggle">
                <span class="selected-text"><?php echo esc_html($current_cat_name); ?></span>
                <i class="fa-regular fa-chevron-down"></i>
            </div>
            <ul class="tabslet-tab filter-menu">
                <li class="<?php echo ($current_cat_id === 0 && !is_search()) ? 'active' : ''; ?>">
                    <a href="<?php echo esc_url($blog_url); ?>"><span><?php esc_html_e('All', 'canhcamtheme'); ?></span></a>
                </li>
                <?php foreach ( $categories as $cat ) : ?>
                <li class="<?php echo ($current_cat_id === $cat->term_id) ? 'active' : ''; ?>">
                    <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>">
                        <span><?php echo esc_html($cat->name); ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="tabslet-content active" style="display:block;">
            <?php if ( have_posts() ) : ?>

                <?php
                // Bài viết đầu tiên là "hot featured" — chỉ hiện ở trang 1 và khi không bị hide_hot
                if ( !$hide_hot && $paged === 1 ) : the_post(); ?>
                <div class="box-news-hot zoom-img-parent">
                    <div class="box-image img-zoom">
                        <a class="img-ratio ratio:pt-[620_1140]" href="<?php the_permalink(); ?>">
                            <?php
                            $featured = get_the_post_thumbnail_url(get_the_ID(), 'full');
                            if ( $featured ) : ?>
                                <img class="lozad" src="<?php echo esc_url($featured); ?>" data-src="<?php echo esc_url($featured); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                            <?php endif; ?>
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
                <div class="box-new">
                    <?php while ( have_posts() ) : the_post();
                        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                        $cats  = get_the_category();
                    ?>
                    <a class="card-news group" href="<?php the_permalink(); ?>">
                        <div class="img img-ratio ratio:pt-[296_395] zoom-img rounded-2">
                            <?php if ( $thumb ) : ?>
                                <img class="lozad" src="<?php echo esc_url($thumb); ?>" data-src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="box-content">
                            <div class="date">
                                <span><?php echo get_the_date('d/m/Y'); ?></span>
                                <?php if ( !empty($cats) ) : ?>
                                    <p><?php echo esc_html($cats[0]->name); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="title">
                                <h3><?php the_title(); ?></h3>
                            </div>
                        </div>
                    </a>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <?php
                $total_pages = $GLOBALS['wp_query']->max_num_pages;
                if ( $total_pages > 1 ) :
                    $page_links = paginate_links(array(
                        'total'     => $total_pages,
                        'current'   => $paged,
                        'type'      => 'array',
                        'prev_text' => '<i class="fa-regular fa-angle-left"></i>',
                        'next_text' => '<i class="fa-regular fa-angle-right"></i>',
                    ));
                ?>
                <div class="navigation flex-center gap-3 mt-10">
                  <?php canhcam_pagination($GLOBALS['wp_query']); ?>
                </div>
                <?php endif; ?>

            <?php else : ?>
                <p class="text-center py-10"><?php esc_html_e('Chưa có bài viết nào.', 'canhcamtheme'); ?></p>
            <?php endif; ?>
        </div>

    </div>
</section>

