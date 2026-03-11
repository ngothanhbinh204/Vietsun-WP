<?php
$bg     = get_field('about5_bg');
$title  = get_field('about5_title');
$images = get_field('about5_images');
?>
<section class="section-about-5" <?php echo $bg ? 'setBackground="' . esc_url($bg['url']) . '"' : ''; ?>>
    <div class="section-py">
        <div class="block-swiper">
            <div class="container-fluid">
                <?php if ( $title ) : ?>
                <h2 class="text-center heading-1 text-white mb-base"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                
                <?php if ( $images ) : ?>
                <div class="swiper-column-auto auto-5-column" data-id-swiper="about-5">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ( $images as $img ) : ?>
                            <div class="swiper-slide">
                                <a href="<?php echo esc_url($img['url']); ?>" data-fancybox="gallery-about-5">
                                    <div class="img img-ratio ratio:pt-[440_312] zoom-img">
                                        <img class="lozad" src="<?php echo esc_url($img['url']); ?>" data-src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                                    </div>
                                </a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <?php if ( $images ) : ?>
            <div class="button-swiper">
                <div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="about-5"><i class="fa-regular fa-chevron-left"></i></div>
                <div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="about-5"><i class="fa-regular fa-chevron-right"></i></div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
