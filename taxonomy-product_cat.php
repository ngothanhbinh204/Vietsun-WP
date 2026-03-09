<?php
/**
 * Taxonomy Product Category Template
 */

get_header();

$banner = get_field('product_archive_banner', 'option');
?>

<main>
    <?php if ( $banner ) : ?>
    <section class="section-service-1">
        <div class="img img-ratio ratio:pt-[720_1920]">
            <img class="lozad" data-src="<?php echo esc_url($banner['url']); ?>" alt="<?php echo esc_attr($banner['alt'] ?: single_term_title('', false)); ?>" />
        </div>
    </section>
    <?php endif; ?>

    <section class="global-breadcrumb">
        <div class="container-fluid">
            <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                <p>
                    <a href="<?php echo home_url(); ?>"><?php esc_html_e('Trang chủ', 'canhcam'); ?></a>
                    <span class="separator"></span>
                    <a href="<?php echo get_post_type_archive_link('product'); ?>"><?php echo post_type_archive_title('', false); ?></a>
                    <span class="separator"></span>
                    <span class="last"><?php single_term_title(); ?></span>
                </p>
            </nav>
        </div>
    </section>

    <?php get_template_part('template-parts/section/product/list'); ?>
</main>

<?php get_footer(); ?>
