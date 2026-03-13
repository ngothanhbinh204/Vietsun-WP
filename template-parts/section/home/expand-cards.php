<?php
$h_title = get_field('home_exp_heading');
$cards   = get_field('home_exp_cards');

if ( $cards ) :
?>
<section class="section-home-5">
    <div class="block-bg">
        <div class="container-fluid" data-gsap-layout>
            <?php if ( $h_title ) : ?>
            <div class="wrap-heading">
                <h2 class="text-white heading-1 text-center mb-base"><?php echo esc_html($h_title); ?></h2>
            </div>
            <?php endif; ?>
            
            <div class="box-content">
                <?php foreach ( $cards as $card ) : ?>
                <div class="expand-card">
                    <?php if ( $card['image'] ) : ?>
                        <img class="bg-img" src="<?php echo esc_url($card['image']); ?>" />
                    <?php endif; ?>
                    <div class="content">
                        <div class="title-box">
                            <h3 class="heading-3 text-white capitalize title-text"><?php echo esc_html($card['title']); ?></h3>
                        </div>
                        <div class="wrap-desc">
                            <?php if ( $card['desc'] ) : ?>
                            <div class="desc prose">
                                <?php echo wp_kses_post($card['desc']); ?>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $card['link'] ) : ?>
                            <a class="btn btn-icon" href="<?php echo esc_url($card['link']['url']); ?>" target="<?php echo esc_attr($card['link']['target'] ?: '_self'); ?>">
                                <span><?php echo esc_html($card['link']['title'] ?: 'View More'); ?></span>
                                <i class="fa-regular fa-chevron-right"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="box-content-mobile">
                <div class="swiper-column-auto auto-2-column">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ( $cards as $card ) : ?>
                            <div class="swiper-slide">
                                <div class="card-home-5-mobile">
                                    <div class="img img-ratio ratio:pt-[1_1] zoom-img">
                                        <?php if ( $card['image'] ) : ?>
                                            <img class="lozad" src="<?php echo esc_url($card['image']); ?>" data-src="<?php echo esc_url($card['image']); ?>" alt="" />
                                        <?php endif; ?>
                                        <div class="content">
                                            <div class="title">
                                                <h3 class="text-white heading-2 capitalize"><?php echo esc_html($card['title']); ?></h3>
                                            </div>
                                            <?php if ( $card['desc'] ) : ?>
                                            <div class="sub-title prose">
                                                <?php echo wp_kses_post($card['desc']); ?>
                                            </div>
                                            <?php endif; ?>
                                            
                                            <?php if ( $card['link'] ) : ?>
                                            <a class="btn btn-icon" href="<?php echo esc_url($card['link']['url']); ?>" target="<?php echo esc_attr($card['link']['target'] ?: '_self'); ?>">
                                                <span><?php echo esc_html($card['link']['title'] ?: 'View More'); ?></span>
                                                <i class="fa-regular fa-chevron-right"></i>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="box-hand">
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
