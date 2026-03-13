<?php
/**
 * Product Archive Template
 */

get_header();

$banner = get_field('product_archive_banner', 'option');
?>

<main>
    <!-- Banner -->
    <section class="section-service-1">
        <div class="img img-ratio ratio:pt-[720_1920]">
            <?php if ( $banner ) : ?>
                <img class="lozad" src="<?php echo esc_url($banner['url']); ?>" data-src="<?php echo esc_url($banner['url']); ?>" alt="<?php echo esc_attr($banner['alt'] ?: __('Sản phẩm', 'canhcamtheme')); ?>" />
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
                        <span class="last"><?php post_type_archive_title(); ?></span>
                    </p>
                </nav>
            <?php } ?>
        </div>
    </section>

    <?php get_template_part('template-parts/section/product/list'); ?>
</main>

<?php get_footer(); ?>
