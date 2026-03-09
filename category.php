<?php
/**
 * The template for displaying category archives.
 */

get_header();

// Banner cho trang Blog lấy từ Page for posts (dùng chung cho category)
$page_for_posts = get_option('page_for_posts');
$bg = get_field('news_banner_bg', $page_for_posts);
?>
<main>
    <?php if ( $bg ) : ?>
    <section class="section-service-1">
        <div class="img img-ratio ratio:pt-[720_1920]">
            <img class="lozad" data-src="<?php echo esc_url($bg['url']); ?>" alt="<?php echo esc_attr($bg['alt'] ?: single_cat_title('', false)); ?>" />
        </div>
    </section>
    <?php endif; ?>

    <section class="global-breadcrumb">
        <div class="container-fluid">
            <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                <p>
                    <a href="<?php echo home_url(); ?>"><?php esc_html_e('Trang chủ', 'canhcam'); ?></a>
                    <span class="separator"></span>
                    <a href="<?php echo get_permalink($page_for_posts); ?>"><?php echo get_the_title($page_for_posts) ?: __('Tin tức', 'canhcam'); ?></a>
                    <span class="separator"></span>
                    <span class="last"><?php echo single_cat_title('', false); ?></span>
                </p>
            </nav>
        </div>
    </section>

    <?php get_template_part('template-parts/section/news/list'); ?>
</main>
<?php get_footer(); ?>
