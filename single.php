<?php
/**
 * The template for displaying all single posts.
 */

get_header();

// Setup variables
$page_for_posts = get_option('page_for_posts');
$blog_url = get_permalink($page_for_posts);
$categories = get_the_category();
$primary_cat = !empty($categories) ? $categories[0] : null;

?>
<main>
    <section class="global-breadcrumb">
        <div class="container-fluid">
            <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                <p>
                    <a href="<?php echo home_url(); ?>"><?php esc_html_e('Trang chủ', 'canhcam'); ?></a>
                    <span class="separator"></span>
                    <a href="<?php echo esc_url($blog_url); ?>"><?php echo esc_html(get_the_title($page_for_posts) ?: __('Về chúng tôi', 'canhcam')); ?></a>
                    <?php if ( $primary_cat ) : ?>
                        <span class="separator"></span>
                        <a href="<?php echo esc_url(get_category_link($primary_cat->term_id)); ?>"><?php echo esc_html($primary_cat->name); ?></a>
                    <?php endif; ?>
                    <span class="separator"></span>
                    <span class="last"><?php the_title(); ?></span>
                </p>
            </nav>
        </div>
    </section>

    <?php while ( have_posts() ) : the_post(); ?>
    <section class="section-news-detail">
        <div class="container-fluid">
            <div class="block-flex">
                <div class="item-flex-left">
                    <div class="box-top">
                        <div class="date-category">
                            <span class="date"><?php echo get_the_date('d.m.Y'); ?></span>
                            <?php if ( $primary_cat ) : ?>
                                <span class="category"><?php echo esc_html($primary_cat->name); ?></span>
                            <?php endif; ?>
                        </div>
                        <h1 class="heading-1 title"><?php the_title(); ?></h1>
                    </div>
                    
                    <div class="box-bottom">
                        <div class="prose">
                            <?php the_content(); ?>
                        </div>
                        
                        <!-- Share -->
                        <div class="item-share">
                            <div class="flex-center"><strong><?php esc_html_e('Share:', 'canhcam'); ?></strong></div>
                            <?php
                            $share_url = urlencode(get_permalink());
                            $share_title = urlencode(get_the_title());
                            ?>
                            <div class="icon">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="item-flex-right">
                    <div class="block-sticky">
                        <div class="box-new-related">
                            <h2 class="title heading-2 text-primary-1"><?php esc_html_e('Tin tức liên quan', 'canhcam'); ?></h2>
                            
                            <?php
                            // Query bài viết liên quan cùng danh mục
                            if ( $primary_cat ) {
                                $related_args = array(
                                    'cat'            => $primary_cat->term_id,
                                    'post__not_in'   => array(get_the_ID()),
                                    'posts_per_page' => 3,
                                );
                                $related_query = new WP_Query($related_args);

                                if ( $related_query->have_posts() ) {
                                    while ( $related_query->have_posts() ) {
                                        $related_query->the_post();
                                        ?>
                                        <a class="group card-news-related" href="<?php the_permalink(); ?>">
                                            <div class="image">
                                                <div class="img img-ratio ratio:pt-[150_200] zoom-img">
                                                    <img class="lozad" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="date-category">
                                                    <span class="date"><?php echo get_the_date('d.m.Y'); ?></span>
                                                    <p class="category"><?php echo esc_html($primary_cat->name); ?></p>
                                                </div>
                                                <h3 class="heading-5 title group-hover:text-primary-1"><?php the_title(); ?></h3>
                                            </div>
                                        </a>
                                        <?php
                                    }
                                } else {
                                    echo '<p>' . esc_html__('Không có tin tức liên quan.', 'canhcam') . '</p>';
                                }
                                wp_reset_postdata();
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endwhile; ?>
</main>

<?php
get_footer();
