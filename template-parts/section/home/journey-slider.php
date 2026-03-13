<?php
$h_title = get_field('home_jrn_sld_heading');
$h_sub   = get_field('home_jrn_sld_sub');
$gallery = get_field('home_jrn_sld_images');
?>
<section class="section-home-7">
    <div class="block-bg">
        <div class="container-fluid">
            <div class="box-content">
                <div class="item-content" data-gsap-layout>
                    <?php if ( $h_title ) : ?>
                    <div class="title">
                        <h2 class="heading-1 text-black text-center mb-5" data-gsap="split-chars-3d" data-gsap-duration="1" data-gsap-stagger="0.1" data-gsap-ease="power2.out">
                             <?php echo esc_html($h_title); ?>
                        </h2>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ( $h_sub ) : ?>
                    <div class="sub-title prose" data-gsap="split-chars" data-gsap-delay="0.7" data-gsap-duration="0.08" data-gsap-stagger="0.04" data-gsap-ease="power2.out">
                        <?php echo wp_kses_post($h_sub); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if ( $gallery ) : ?>
            <div class="box-swiper">
                <div class="button-swiper">
                    <div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="home-7"><i class="fa-regular fa-chevron-left"></i></div>
                </div>
                <div class="swiper-column-auto auto-7-column" data-id-swiper="home-7">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ( $gallery as $img ) : ?>
                            <div class="swiper-slide">
                                <div class="img img-ratio ratio:pt-[110_220] zoom-img rounded-2">
                                    <img class="lozad" src="<?php echo esc_url($img['url']); ?>" data-src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="button-swiper">
                    <div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="home-7"><i class="fa-regular fa-chevron-right"></i></div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
