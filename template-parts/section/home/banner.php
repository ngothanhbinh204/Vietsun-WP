<?php
$slider = get_field('home_banner_slider');

if ( $slider ) :
?>
<section class="page-banner-main section-home-banner">
    <div class="swiper">
        <div class="swiper-wrapper">
            <?php foreach ( $slider as $slide ) : 
                $type = $slide['media_type'];
                $media = $slide['bg_media'];
                $title = $slide['title'];
            ?>
            <div class="swiper-slide">
                <div class="img-banner img-ratio xl:ratio:pt-[900_1920] md:ratio:pt-[1_1]">
                    <?php if ( $type === 'video' && $media ) : ?>
                        <video src="<?php echo esc_url($media['url']); ?>" autoplay="autoplay" loop="loop" muted="muted" playsinline="playsinline"></video>
                    <?php elseif ( $media ) : ?>
                        <img class="lozad" src="<?php echo esc_url($media['url']); ?>" data-src="<?php echo esc_url($media['url']); ?>" alt="<?php echo esc_attr($media['alt'] ?: $title); ?>" />
                    <?php endif; ?>
                    
                    <div class="container-fluid">
                        <div class="block-content" data-gsap-layout>
                            <?php if ( $title ) : ?>
                            <div class="item-title">
                                <h2 class="heading-1 text-white capitalize" data-gsap="split-chars" data-gsap-delay="0.6" data-gsap-duration="0.8">
                                    <?php echo esc_html($title); ?>
                                </h2>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="block-button">
            <div class="container-fluid" data-gsap-layout>
                <div class="wrap-button flex gap-2" data-gsap="fade-up" data-gsap-delay="0.8" data-gsap-duration="1">
                    <div class="btn-swiper btn-prev btn-swiper-outline"><i class="fa-regular fa-chevron-left"></i></div>
                    <div class="btn-swiper btn-next btn-swiper-outline"><i class="fa-regular fa-chevron-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
