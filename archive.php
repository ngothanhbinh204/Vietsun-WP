<?php
/**
 * Archive Template — All Posts (Blog page / News All)
 *
 * Được kích hoạt khi người dùng truy cập trang "Tin tức" (trang được gán là Posts page).
 * Tab "All" trong filter-dropdown sẽ trỏ đến trang này.
 */

get_header();

$page_for_posts = get_option('page_for_posts');
$bg             = get_field('news_banner_bg', $page_for_posts);
?>

<main>
    <!-- Banner -->
    <section class="section-service-1">
        <div class="img img-ratio ratio:pt-[720_1920]">
            <?php if ( $bg ) : ?>
                <img class="lozad" src="<?php echo esc_url($bg['url']); ?>" data-src="<?php echo esc_url($bg['url']); ?>" alt="<?php echo esc_attr($bg['alt'] ?: get_the_title($page_for_posts)); ?>" />
            <?php endif; ?>
        </div>
    </section>

    <!-- Breadcrumb -->
    <section class="global-breadcrumb">
        <div class="container-fluid">
            <?php if ( function_exists('rank_math_the_breadcrumbs') ) {
                rank_math_the_breadcrumbs();
            } else { ?>
                <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                    <p>
                        <a href="<?php echo home_url(); ?>"><?php esc_html_e('Trang chủ', 'canhcamtheme'); ?></a>
                        <span class="separator"></span>
                        <span class="last"><?php echo esc_html(get_the_title($page_for_posts) ?: 'Tin tức'); ?></span>
                    </p>
                </nav>
            <?php } ?>
        </div>
    </section>

    <?php get_template_part('template-parts/section/news/list'); ?>
</main>

<?php get_footer(); ?>
