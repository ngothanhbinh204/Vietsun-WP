<?php
$h_title = get_field('service_prod_title');
$slider  = get_field('service_prod_slider');

if ( $slider ) :
?>
<section class="section-service-3">
    <div class="container default-container-js">
        <div class="service-slider-wrapper">
            <div class="service-slider-main" data-stick-to-edge="left" data-unstick-min="1100">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ( $slider as $item ) : ?>
                        <div class="swiper-slide">
                            <a class="img img-ratio ratio:pt-[1_2] lg:ratio:pt-[1_1] zoom-img" href="<?php echo esc_url($item['image']['url']); ?>" data-fancybox="service-product">
                                <img class="lozad" src="<?php echo esc_url($item['image']['url']); ?>" data-src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['image']['alt']); ?>" />
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <div class="service-slider-thumbs">
                <?php if ( $h_title ) : ?>
                    <h2 class="heading-1 text-black"><?php echo esc_html($h_title); ?></h2>
                <?php endif; ?>
                
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ( $slider as $item ) : ?>
                        <div class="swiper-slide">
                            <div class="box-item">
                                <div class="item">
                                    <div class="item-icon">
                                        <div class="icon">
                                            <?php if ( $item['icon'] ) : ?>
                                                <img src="<?php echo esc_url($item['icon']); ?>" alt="" />
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <h3><?php echo esc_html($item['title']); ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="block-hand flex justify-end md:hidden">
                    <div class="indicator-swipe active">
                        <div class="arrow btn-prev pointer-events-auto cursor-pointer"><i class="fa-duotone fa-regular fa-angle-left"></i></div>
                        <img class="hand" src="<?php echo THEME_URI; ?>/img/Finger drag.svg" alt="" />
                        <div class="arrow btn-next pointer-events-auto cursor-pointer"><i class="fa-duotone fa-regular fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
