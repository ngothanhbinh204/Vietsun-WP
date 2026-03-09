<?php
$slider = get_field('home_banner_slider');
if ( !empty($slider) ) :
?>
<section class="page-banner-main section-home-banner">
    <div class="swiper">
        <div class="swiper-wrapper">
            <?php foreach ( $slider as $slide ) : 
                $bg = isset($slide['bg_media']) ? $slide['bg_media'] : false; // File field array
                $title = isset($slide['title']) ? $slide['title'] : '';
            ?>
            <div class="swiper-slide">
                <div class="img-banner img-ratio xl:ratio:pt-[900_1920] md:ratio:pt-[1_1]">
                    <?php 
                    if ( $bg ) : 
                        $url = $bg['url'];
                        // Xác định định dạng xem là video hay hình ảnh
                        $ext = pathinfo($url, PATHINFO_EXTENSION);
                        if ( in_array(strtolower($ext), ['mp4', 'webm', 'ogg']) ) :
                    ?>
                        <video src="<?php echo esc_url($url); ?>" autoplay="autoplay" loop="loop" muted="muted" playsinline="playsinline"></video>
                    <?php else: ?>
                        <img class="lozad" data-src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($bg['alt'] ?: $title); ?>" />
                    <?php endif; endif; ?>
                    
                    <div class="container-fluid">
                        <div class="block-content" data-gsap-layout>
                            <div class="item-title">
                                <?php if ( $title ) : ?>
                                <h2 class="heading-1 text-white capitalize" data-gsap="split-chars"
                                    data-gsap-delay="0.6" data-gsap-duration="0.8"><?php echo esc_html($title); ?></h2>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <?php if ( count($slider) > 1 ) : ?>
        <div class="block-button">
            <div class="container-fluid" data-gsap-layout>
                <div class="wrap-button flex gap-2" data-gsap="fade-up" data-gsap-delay="0.8"
                    data-gsap-duration="1">
                    <div class="btn-swiper btn-prev btn-swiper-outline"><i class="fa-regular fa-chevron-left"></i></div>
                    <div class="btn-swiper btn-next btn-swiper-outline"><i class="fa-regular fa-chevron-right"></i></div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
