<?php
$h_title = get_field('home_prod_heading');
$h_desc  = get_field('home_prod_desc');
$slider  = get_field('home_prod_slider');

if ( $slider ) :
?>
<section class="section-home-4">
    <div class="container-fluid default-container-js" data-gsap-layout>
        <div class="product-slider-wrapper">
            <div class="product-slider-main" data-stick-to-edge="left" data-unstick-min="1100">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ( $slider as $item ) : ?>
                        <div class="swiper-slide">
                            <a class="img img-ratio ratio:pt-[1_2] lg:ratio:pt-[1_1] zoom-img" href="<?php echo esc_url($item['image']['url']); ?>" data-fancybox="product">
                                <img class="lozad" src="<?php echo esc_url($item['image']['url']); ?>" data-src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['image']['alt']); ?>" />
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="button-swiper">
                    <div class="btn-swiper btn-prev btn-swiper-primary"><i class="fa-regular fa-chevron-left"></i></div>
                    <div class="btn-swiper btn-next btn-swiper-primary"><i class="fa-regular fa-chevron-right"></i></div>
                </div>
            </div>
            
            <div class="product-slider-thumbs">
                <?php if ( $h_title ) : ?>
                <h2 class="heading-1 text-black" data-gsap="split-chars" data-gsap-delay="0.5" data-gsap-duration="0.8" data-gsap-stagger="0.1" data-gsap-ease="power2.out">
                    <?php echo esc_html($h_title); ?>
                </h2>
                <?php endif; ?>
                
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ( $slider as $item ) : ?>
                        <div class="swiper-slide">
                            <div class="box-item" setBackground="<?php echo esc_url($item['image']['url']); ?>">
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
                
                <?php if ( $h_desc ) : ?>
                <div class="sub-content prose" data-gsap="split-words" data-gsap-delay="0.7" data-gsap-duration="0.08" data-gsap-stagger="0.04" data-gsap-ease="power2.out">
                    <?php echo wp_kses_post($h_desc); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
