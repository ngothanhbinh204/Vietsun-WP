<?php
$h_title = get_field('home_fact_heading');
$slider  = get_field('home_fact_slider');

if ( $slider ) :
?>
<section class="section-home-3">
    <div class="block-bg">
        <div class="container-fluid" data-gsap-layout>
            <?php if ( $h_title ) : ?>
            <div class="wrap-heading">
                <h2 class="text-white heading-1 text-center mb-base" data-gsap="split-chars" data-gsap-delay="0.5" data-gsap-duration="0.8" data-gsap-stagger="0.1" data-gsap-ease="power2.out">
                    <?php echo esc_html($h_title); ?>
                </h2>
            </div>
            <?php endif; ?>
            
            <div class="box-slide">
                <div class="swiper-column-auto auto-5-column" data-id-swiper="factory">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ( $slider as $post_obj ) :
                                $p_id = $post_obj->ID;
                                $f_title = get_the_title($p_id);
                                $f_desc = get_field('factory_desc', $p_id);
                                $f_thumbnail = get_field('factory_thumbnail', $p_id);
                                
                                if ( !$f_thumbnail && has_post_thumbnail($p_id) ) {
                                    $thumb_url = get_the_post_thumbnail_url($p_id, 'large');
                                    $f_thumbnail = array('url' => $thumb_url, 'alt' => $f_title);
                                }
                                $f_link = get_permalink($p_id);
                            ?>
                            <div class="swiper-slide">
                                <div class="card-img">
                                    <div class="item-image">
                                        <div class="img-ratio ratio:pt-[573_430]">
                                            <?php if ( $f_thumbnail ) : ?>
                                                <img class="lozad" src="<?php echo esc_url($f_thumbnail['url']); ?>" data-src="<?php echo esc_url($f_thumbnail['url']); ?>" alt="<?php echo esc_attr($f_thumbnail['alt'] ?: $f_title); ?>" />
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="overlay"></div>
                                    <div class="item-content">
                                        <h3 class="title"><?php echo esc_html($f_title); ?></h3>
                                        <?php if ( $f_desc ) : ?>
                                        <div class="desc prose">
                                            <?php echo wp_kses_post($f_desc); ?>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <div class="flex-center">
                                            <a class="btn btn-white" href="<?php echo esc_url($f_link); ?>">
                                                <span><?php esc_html_e('View More', 'canhcamtheme'); ?></span>
                                                <i class="fa-regular fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-swiper">
            <div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="factory"><i class="fa-regular fa-chevron-left"></i></div>
            <div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="factory"><i class="fa-regular fa-chevron-right"></i></div>
        </div>
    </div>
</section>
<?php endif; ?>
