<?php
$slider = get_field('home_purpose_slider');

if ( $slider ) :
?>
<section class="section-home-1 h-screen min-h-auto lg:min-h-[900px]">
    <div class="box-img-wrapper">
        <?php foreach ( $slider as $item ) : ?>
        <div class="box-img">
            <div class="image-show relative">
                <div class="img h-screen min-h-[900px]">
                    <?php if ( $item['bg_image'] ) : ?>
                        <img class="lozad" src="<?php echo esc_url($item['bg_image']['url']); ?>" data-src="<?php echo esc_url($item['bg_image']['url']); ?>" alt="<?php echo esc_attr($item['bg_image']['alt']); ?>" />
                    <?php endif; ?>
                </div>
                <div class="wrapper">
                    <div class="hover-point" hover-point>
                        <div class="icon-scroll" icon-animate>
                            <div class="icon flex-center relative">
                                <?php if ( $item['icon'] ) : ?>
                                    <img src="<?php echo esc_url($item['icon']); ?>" alt="icon" />
                                <?php endif; ?>
                            </div>
                            <div class="logo"></div>
                        </div>
                        <div class="content">
                            <div class="title">
                                <h2 class="text-center heading-2 text-white"><?php echo esc_html($item['title']); ?></h2>
                            </div>
                            <?php if ( $item['desc'] ) : ?>
                            <div class="sub-title text-white text-center body-1 prose">
                                <?php echo wp_kses_post($item['desc']); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php if ( $item['button'] ) : ?>
                        <div class="button">
                            <a class="btn btn-white" href="<?php echo esc_url($item['button']['url']); ?>" target="<?php echo esc_attr($item['button']['target'] ?: '_self'); ?>">
                                <span><?php echo esc_html($item['button']['title']); ?></span>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="box-img-wrapper-mobile relative">
        <div class="swiper-column-auto auto-1-column">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach ( $slider as $item ) : ?>
                    <div class="swiper-slide">
                        <div class="card-home-1-mobile relative h-screen min-h-[600px]">
                            <div class="img absolute top-0 left-0 w-full h-full z-1">
                                <?php if ( $item['bg_image'] ) : ?>
                                    <img class="w-full h-full object-cover lozad" src="<?php echo esc_url($item['bg_image']['url']); ?>" data-src="<?php echo esc_url($item['bg_image']['url']); ?>" alt="alt">
                                <?php endif; ?>
                            </div>
                            <div class="wrapper absolute top-0 left-0 w-full h-full z-2 flex-center flex-col bg-black_50 px-base gap-base">
                                <div class="icon flex-center rounded-full border-2 border-white rem:w-[120px] rem:h-[120px]">
                                    <?php if ( $item['icon'] ) : ?>
                                        <img src="<?php echo esc_url($item['icon']); ?>" alt="icon" />
                                    <?php endif; ?>
                                </div>
                                <div class="content flex flex-col gap-base">
                                    <div class="title">
                                        <h2 class="text-center heading-2 text-white"><?php echo esc_html($item['title']); ?></h2>
                                    </div>
                                    <?php if ( $item['desc'] ) : ?>
                                    <div class="sub-title text-white text-center body-1 prose">
                                        <?php echo wp_kses_post($item['desc']); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php if ( $item['button'] ) : ?>
                                <div class="button">
                                    <a class="btn btn-white" href="<?php echo esc_url($item['button']['url']); ?>" target="<?php echo esc_attr($item['button']['target'] ?: '_self'); ?>">
                                        <span><?php echo esc_html($item['button']['title']); ?></span>
                                    </a>
                                </div>
                                <?php endif; ?>
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
</section>
<?php endif; ?>
