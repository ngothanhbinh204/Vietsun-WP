<?php
$title  = get_field('service_spd_title');
$desc   = get_field('service_spd_desc');
$images = get_field('service_spd_slider');
?>
<section class="section-service-2">
    <div class="block-flex">
        <div class="box-content">
            <?php if ( $title ) : ?>
                <h1 class="heading-1 text-center text-white"><?php echo esc_html($title); ?></h1>
            <?php endif; ?>
            
            <?php if ( $desc ) : ?>
                <div class="sub-title prose text-center text-white max-w-4xl mx-auto">
                    <?php echo wp_kses_post($desc); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php if ( $images ) : ?>
    <div class="block-swiper">
        <div class="swiper-service-2 swiper-loop" data-id-swiper="service-2" data-centered="true" data-space="120" data-slides-per-view="1.5">
            <div class="swiper rem:h-[650px]">
                <div class="swiper-wrapper h-full">
                    <?php foreach ( $images as $img ) : ?>
                    <div class="swiper-slide">
                        <div class="child">
                            <div class="img img-ratio ratio:pt-[653_1160] zoom-img">
                                <img class="lozad" src="<?php echo esc_url($img['url']); ?>" data-src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
