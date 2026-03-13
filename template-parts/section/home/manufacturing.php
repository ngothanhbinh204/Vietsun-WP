<?php
$h_title = get_field('home_mnf_heading');
$h_sub   = get_field('home_mnf_sub');
$l_stats = get_field('home_mnf_left_stats');
$l_img   = get_field('home_mnf_left_img');
$c_video = get_field('home_mnf_center_video');
$c_img   = get_field('home_mnf_center_img');
$r_stats = get_field('home_mnf_right_stats');
$r_img   = get_field('home_mnf_right_img');
?>
<section class="section-home-2" setBackground="<?php echo THEME_URI; ?>/img/section-home-2-bg.png">
    <div class="section-py">
        <div class="container-fluid">
            <div class="block-flex">
                <div class="box-top" data-gsap-layout>
                    <?php if ( $h_title ) : ?>
                    <h2 class="heading-1 text-white capitalize text-center" data-gsap="split-chars" data-gsap-duration="1" data-gsap-stagger="0.1" data-gsap-ease="power2.out">
                        <?php echo esc_html($h_title); ?>
                    </h2>
                    <?php endif; ?>
                    
                    <?php if ( $h_sub ) : ?>
                    <div class="sub-title prose" data-gsap="split-chars" data-gsap-delay="1" data-gsap-duration="0.08" data-gsap-stagger="0.1" data-gsap-ease="power2.out">
                        <?php echo wp_kses_post($h_sub); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="box-bottom" data-gsap-layout>
                    <div class="item-left" data-gsap="fade-right" data-gsap-duration="1.2" data-gsap-ease="power2.out">
                        <?php if ( $l_stats ) : ?>
                            <?php foreach ( $l_stats as $stat ) : ?>
                            <div class="item-box">
                                <div class="number">
                                    <div class="countup" data-countup="<?php echo (int)$stat['number']; ?>"></div><span>+</span>
                                </div>
                                <div class="content">
                                    <p><?php echo esc_html($stat['text']); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                        <?php if ( $l_img ) : ?>
                        <div class="item-img-box">
                            <div class="img img-ratio ratio:pt-[280_572] zoom-img rounded-2">
                                <img class="lozad" src="<?php echo esc_url($l_img['url']); ?>" data-src="<?php echo esc_url($l_img['url']); ?>" alt="<?php echo esc_attr($l_img['alt']); ?>" />
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="item-mid" data-gsap="fade-up" data-gsap-duration="1.1" data-gsap-ease="power2.out">
                        <?php if ( $c_video && $c_img ) : ?>
                        <a class=" img img-ratio ratio:pt-[1_1] zoom-img rounded-2" href="<?php echo esc_url($c_video); ?>" data-fancybox>
                            <img class="lozad" src="<?php echo esc_url($c_img['url']); ?>" data-src="<?php echo esc_url($c_img['url']); ?>" alt="<?php echo esc_attr($c_img['alt']); ?>" />
                            <div class="btn-play">
                                <div class="icon-play"><i class="fa-solid fa-play"></i></div>
                            </div>
                        </a>
                        <?php endif; ?>
                    </div>

                    <div class="item-right" data-gsap="fade-left" data-gsap-duration="1.2" data-gsap-ease="power2.out">
                        <?php 
                        $first_stat = $r_stats ? array_shift($r_stats) : null;
                        if ( $first_stat ) : 
                        ?>
                        <div class="item-box item-box-right-top">
                            <div class="number">
                                <div class="countup" data-countup="<?php echo (int)$first_stat['number']; ?>"></div><span>+</span>
                            </div>
                            <div class="content">
                                <p><?php echo esc_html($first_stat['text']); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ( $r_img ) : ?>
                        <div class="item-img-box">
                            <div class="img img-ratio ratio:pt-[1_1] zoom-img rounded-2">
                                <img class="lozad" src="<?php echo esc_url($r_img['url']); ?>" data-src="<?php echo esc_url($r_img['url']); ?>" alt="<?php echo esc_attr($r_img['alt']); ?>" />
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ( $r_stats ) : ?>
                            <?php foreach ( $r_stats as $stat ) : ?>
                            <div class="item-box item-box-right">
                                <div class="number">
                                    <div class="countup" data-countup="<?php echo (int)$stat['number']; ?>"></div><span>+</span>
                                </div>
                                <div class="content">
                                    <p><?php echo esc_html($stat['text']); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
