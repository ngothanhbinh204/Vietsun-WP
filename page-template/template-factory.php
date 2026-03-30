<?php
/**
 * Template Name: Factory Page
 *
 * Hiển thị danh sách các nhà máy (Factory CPT).
 * Mỗi factory có một popup chi tiết riêng với slider ảnh và thông tin liên hệ.
 */

get_header();

// Query tất cả factory, không giới hạn số lượng
$factories = new WP_Query(array(
    'post_type'      => 'factory',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
));
?>

<main>

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
                        <span class="last"><?php the_title(); ?></span>
                    </p>
                </nav>
            <?php } ?>
        </div>
    </section>

    <!-- Factory List -->
    <section class="section-factory">
        <?php
        $loop_index = 0;
        if ( $factories->have_posts() ) :
            while ( $factories->have_posts() ) : $factories->the_post();
                $loop_index++;
                $factory_id      = get_the_ID();
                $popup_id        = 'factory-popup-' . $factory_id;
                $swiper_id       = 'factory-main-' . $factory_id;
                $thumb_swiper_id = 'factory-thumb-' . $factory_id;

                // ACF Fields
                $thumbnail       = get_field('factory_thumbnail');
                $desc            = get_field('factory_desc');
                $gallery         = get_field('factory_gallery');
                $contact_details = get_field('contact_details');

                // Fallback thumbnail về featured image nếu không set ACF thumbnail
                if ( !$thumbnail && has_post_thumbnail() ) {
                    $thumb_url = get_the_post_thumbnail_url(null, 'large');
                    $thumbnail = array('url' => $thumb_url, 'alt' => get_the_title());
                }
        ?>
        <!-- block-grid: card factory -->
        <div class="block-grid">
            <div class="box-left">
                <div class="item-padding">
                    <h2 class="heading-1 text-white"><?php the_title(); ?></h2>
                    <?php if ( $desc ) : ?>
                    <div class="sub-title prose text-white">
                        <?php echo wp_kses_post($desc); ?>
                    </div>
                    <?php endif; ?>
                    <a class="btn btn-icon" href="#<?php echo esc_attr($popup_id); ?>" data-toggle="popup-form" data-popup-target="<?php echo esc_attr($popup_id); ?>">
                        <span><?php esc_html_e('View More', 'canhcamtheme'); ?></span>
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </div>
            </div>
            <div class="box-right">
                <div class="img img-ratio ratio:pt-[660_960] zoom-img">
                    <?php if ( $thumbnail ) : ?>
                        <img class="lozad" src="<?php echo esc_url($thumbnail['url']); ?>" data-src="<?php echo esc_url($thumbnail['url']); ?>" alt="<?php echo esc_attr($thumbnail['alt'] ?: get_the_title()); ?>" />
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- END block-grid -->

        <!-- Popup cho factory này -->
        <div class="popup-wrapper factory-popup" id="popup-form">
            <!-- Overlay -->
            <div class="overlay fixed inset-0 bg-black/60 z-[999] opacity-0 invisible transition-all duration-300 cursor-pointer"></div>

            <!-- Popup Content -->
            <div class="popup-content fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[1000] bg-white p-base rounded-4 shadow-2xl opacity-0 invisible scale-90 transition-all duration-300 w-[90%] xl:rem:w-[1400px] max-h-[95vh] overflow-y-auto">
                <button class="close-btn absolute text-3xl leading-none text-primary-1 hover:text-white transition-colors">&times;</button>

                <div class="block-grid grid grid-cols-1 lg:grid-cols-2 gap-base min-w-0">

                    <!-- LEFT: Gallery Slider -->
                    <div class="box-left">
                        <?php if ( $gallery ) : ?>
                        <div class="popup-product-slider flex flex-col gap-5 -lg:mt-base">

                            <!-- Main Swiper -->
                            <div class="swiper-main rounded-4 overflow-hidden">
                                <div class="swiper" data-id-swiper="<?php echo esc_attr($swiper_id); ?>">
                                    <div class="swiper-wrapper">
                                        <?php foreach ( $gallery as $img ) : ?>
                                        <div class="swiper-slide">
                                            <a class="img img-ratio ratio:pt-[1_1] lg:ratio:pt-[440_660] zoom-img rounded-0"
                                               href="<?php echo esc_url($img['url']); ?>"
                                               data-fancybox="factory-gallery-<?php echo $factory_id; ?>">
                                                <img class="lozad" src="<?php echo esc_url($img['url']); ?>" data-src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt'] ?: get_the_title()); ?>" />
                                                <div class="button-swiper">
                                                    <div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="<?php echo esc_attr($swiper_id); ?>">
                                                        <i class="fa-regular fa-chevron-left"></i>
                                                    </div>
                                                    <div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="<?php echo esc_attr($swiper_id); ?>">
                                                        <i class="fa-regular fa-chevron-right"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Thumbs Swiper -->
                            <div class="swiper-thumbs" data-thumbs-for="<?php echo esc_attr($swiper_id); ?>">
                                <div class="swiper" data-id-swiper="<?php echo esc_attr($thumb_swiper_id); ?>">
                                    <div class="swiper-wrapper">
                                        <?php foreach ( $gallery as $img ) : ?>
                                        <div class="swiper-slide cursor-pointer overflow-hidden">
                                            <div class="img img-ratio ratio:pt-[81_122] zoom-img">
                                                <img class="lozad" src="<?php echo esc_url($img['sizes']['thumbnail'] ?? $img['url']); ?>" data-src="<?php echo esc_url($img['sizes']['thumbnail'] ?? $img['url']); ?>" alt="" />
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php else : ?>
                        <!-- Fallback nếu không có gallery: hiển thị thumbnail lớn -->
                        <?php if ( $thumbnail ) : ?>
                        <div class="img img-ratio ratio:pt-[440_660] rounded-4 overflow-hidden">
                            <img class="lozad" src="<?php echo esc_url($thumbnail['url']); ?>" data-src="<?php echo esc_url($thumbnail['url']); ?>" alt="<?php the_title_attribute(); ?>" />
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <!-- RIGHT: Info + Contact -->
                    <div class="box-right">
                        <h2 class="heading-1 text-primary-4"><?php the_title(); ?></h2>

                        <?php if ( $desc ) : ?>
                        <div class="sub-title prose mt-4">
                            <?php echo wp_kses_post($desc); ?>
                        </div>
                        <?php endif; ?>

                        <?php if ( $contact_details ) : ?>
                        <div class="item mt-6">
                            <ul>
                                <?php foreach ( $contact_details as $detail ) :
                                    $icon = $detail['icon'];
                                    $link = $detail['link'];
                                    if ( !$link ) continue;
                                ?>
                                <li>
                                    <span><i class="fa-solid <?php echo esc_attr($icon); ?>"></i></span>
                                    <div class="content">
                                        <?php echo $link; ?>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>

                </div><!-- .block-grid -->
            </div><!-- .popup-content -->
        </div><!-- .popup-wrapper -->

        <?php
            endwhile;
            wp_reset_postdata();
        else :
        ?>
        <div class="container-fluid py-20 text-center">
            <p><?php esc_html_e('Chưa có nhà máy nào được thêm.', 'canhcamtheme'); ?></p>
        </div>
        <?php endif; ?>
    </section>

</main>

<?php get_footer(); ?>
