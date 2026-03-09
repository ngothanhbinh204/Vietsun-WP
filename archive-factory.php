<?php
/**
 * Template Name: Factory Archive
 * 
 * You can set a Page to use this template or let WordPress use it automatically for the 'factory' CPT archive 
 * by creating archive-factory.php. We are using a Page Template pattern to allow the user to control the page.
 */

get_header();

// Setup Query for Factories
$args = array(
    'post_type' => 'factory',
    'posts_per_page' => -1, // Lấy tất cả
    'orderby' => 'menu_order',
    'order' => 'ASC',
);
$factories = new WP_Query($args);
?>

<main>
    <section class="global-breadcrumb">
        <div class="container-fluid">
            <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                <p>
                    <a href="<?php echo home_url(); ?>"><?php esc_html_e('Trang chủ', 'canhcam'); ?></a>
                    <span class="separator"></span>
                    <span class="last"><?php echo post_type_archive_title('', false) ?: 'Về chúng tôi'; ?></span>
                </p>
            </nav>
        </div>
    </section>

    <?php if ( $factories->have_posts() ) : ?>
        <div class="factory-list-wrapper">
            <?php 
            $count = 0;
            while ( $factories->have_posts() ) : $factories->the_post(); 
                $count++;
                
                // Get ACF Fields
                $desc = get_field('factory_desc');
                $map_link = get_field('factory_map_link');
                $gallery = get_field('factory_gallery');
                
                // Alternating class
                $reverse_class = ($count % 2 == 0) ? ' flex-row-reverse flex-col-reverse md:flex-row-reverse' : ' flex-row flex-col md:flex-row';
            ?>
            <section class="section-factory-1 <?php echo esc_attr($reverse_class); ?>" style="display: flex;">
                <div class="content-left text-white" style="flex: 1;">
                    <h2 class="title heading-1"><?php the_title(); ?></h2>
                    
                    <?php if ( $desc ) : ?>
                    <p class="sub-title body-1"><?php echo nl2br(esc_html($desc)); ?></p>
                    <?php endif; ?>
                    
                    <?php if ( $map_link ) : ?>
                    <a class="btn btn-primary" href="<?php echo esc_url($map_link['url']); ?>" target="<?php echo esc_attr($map_link['target'] ?: '_blank'); ?>">
                        <span><?php echo esc_html($map_link['title']); ?></span>
                    </a>
                    <?php endif; ?>
                </div>

                <div class="box-image" style="flex: 1; width: 100%; overflow: hidden;">
                    <?php if ( $gallery ) : ?>
                    <div class="swiper-column-auto auto-1-column" data-id-swiper="factory-main-<?php echo get_the_ID(); ?>">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ( $gallery as $img ) : ?>
                                <div class="swiper-slide">
                                    <div class="img-ratio ratio:pt-[760_1060]">
                                        <img class="lozad" data-src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php elseif ( has_post_thumbnail() ) : ?>
                    <div class="img-ratio ratio:pt-[760_1060]">
                        <img class="lozad" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title_attribute(); ?>" />
                    </div>
                    <?php endif; ?>
                </div>
            </section>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    <?php else : ?>
        <p class="text-center py-10">Không tìm thấy nhà máy nào.</p>
    <?php endif; ?>
</main>

<?php
get_footer();
