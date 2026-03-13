<?php
$bg      = get_field('home_jrn_bg');
$h_title = get_field('home_jrn_heading');
$h_sub   = get_field('home_jrn_sub');
$link    = get_field('home_jrn_link');
?>
<section class="section-home-6">
    <div class="container-fluid">
        <div class="block-bg" <?php echo $bg ? 'setBackground="' . esc_url($bg) . '"' : ''; ?>>
            <div class="box-content">
                <div class="item-content" data-gsap-layout>
                    <?php if ( $h_title ) : ?>
                    <h2 class="text-white heading-1 text-center" data-gsap="split-chars" data-gsap-delay="0.5" data-gsap-duration="0.8" data-gsap-stagger="0.1" data-gsap-ease="power2.out">
                        <?php echo esc_html($h_title); ?>
                    </h2>
                    <?php endif; ?>
                    
                    <?php if ( $h_sub ) : ?>
                    <div class="sub-title prose" data-gsap="split-words" data-gsap-delay="0.7" data-gsap-duration="0.08" data-gsap-stagger="0.04" data-gsap-ease="power2.out">
                        <?php echo wp_kses_post($h_sub); ?>
                    </div>
                    <?php endif; ?>
                </div>
                
                <?php if ( $link ) : ?>
                <a class="btn btn-icon" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?: '_self'); ?>" data-gsap="fade-up" data-gsap-delay="0.9" data-gsap-duration="0.08" data-gsap-ease="power2.out">
                    <span><?php echo esc_html($link['title']); ?></span>
                    <i class="fa-regular fa-chevron-right"></i>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
