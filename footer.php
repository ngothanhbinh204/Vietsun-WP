</main><!-- #main -->

<?php
/**
 * Láy dữ liệu Footer từ ACF Options Page
 */
$footer_logo       = get_field('footer_logo', 'option');

// Newsletter Info
$newsletter_title  = get_field('newsletter_title', 'option');
$newsletter_desc   = get_field('newsletter_desc', 'option');

$cf7_footer        = get_field('footer_cf7', 'option');

// Info Block
$info_heading      = get_field('footer_info_heading', 'option');
$footer_infos      = get_field('footer_infos', 'option'); // Repeater

// Quick Links Block
$quick_heading     = get_field('footer_quick_links_heading', 'option');
$quick_links       = get_field('footer_quick_links', 'option'); // Repeater (link)

// Socials Block
$social_heading    = get_field('footer_social_heading', 'option');
$socials           = get_field('footer_socials', 'option'); // Repeater (icon:image, link:link)

// Copyright
$copyright_text    = get_field('footer_copyright', 'option');
?>

<footer>
    <div class="section-footer">
        <div class="container-fluid">
            
            <!-- Block Footer Top: Logo & Newsletter -->
            <div class="block-footer-top">
                <div class="box-left">
                    <?php if ( $footer_logo ) : ?>
                    <div class="item-logo">
                        <a class="img img-ratio ratio:pt-[88_97]" href="<?php echo esc_url(home_url('/')); ?>">
                            <img class="lozad" data-src="<?php echo esc_url($footer_logo['url']); ?>" alt="<?php echo esc_attr($footer_logo['alt'] ?: get_bloginfo('name')); ?>" />
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <div class="item-content">
                        <?php if ( $newsletter_title ) : ?>
                        <h2 class="heading-1 text-white capitalize"><?php echo esc_html($newsletter_title); ?></h2>
                        <?php endif; ?>
                        
                        <?php if ( $newsletter_desc ) : ?>
                        <div class="content">
                            <?php echo wp_kses_post($newsletter_desc); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="box-right">
                    <div class="item-form">
                        <?php if ( $cf7_footer ) : ?>
                            <?php echo do_shortcode($cf7_footer); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Block Footer Mid: Info, Quick Links & Socials -->
            <div class="block-footer-mid">
                
                <!-- Information -->
                <div class="box-left">
                    <?php if ( $info_heading ) : ?>
                    <h2 class="heading-4 text-primary-1 uppercase mb-5"><?php echo esc_html($info_heading); ?></h2>
                    <?php endif; ?>
                    
                    <ul>
                        <?php if ( !empty($footer_infos) ) : ?>
                            <?php foreach ( $footer_infos as $info ) : 
                                $icon = isset($info['icon']) ? $info['icon'] : '';
                                $content = isset($info['content']) ? $info['content'] : '';
                                if ( $icon && $content ) :
                            ?>
                            <li>
                                <span><i class="fa-solid fa-<?php echo esc_attr($icon); ?>"></i></span>
                                <div class="wrap-info">
                                    <?php 
                                    echo wp_kses_post($content); 
                                    ?>
                                </div>
                            </li>
                            <?php 
                                endif;
                            endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                
                <div class="box-right">
                    
                    <!-- Quick Links -->
                    <div class="item-right">
                        <?php if ( $quick_heading ) : ?>
                        <h2 class="heading-4 text-primary-1 uppercase mb-5"><?php echo esc_html($quick_heading); ?></h2>
                        <?php endif; ?>
                        
                       <?php if ( has_nav_menu( 'footer-1' ) ) {
                                        wp_nav_menu( array(
                                            'theme_location' => 'footer-1',
                                            'container'      => false,
                                            'menu_class'     => '',
                                            'items_wrap'     => '<ul>%3$s</ul>',
                                            'fallback_cb'    => false,
                                        ) );
                                    }
                                    ?>
                    </div>
                    
                    <!-- Contact With Us -->
                    <div class="item-right">
                        <?php if ( $social_heading ) : ?>
                        <h2 class="heading-4 text-primary-1 uppercase mb-5"><?php echo esc_html($social_heading); ?></h2>
                        <?php endif; ?>
                        
                        <?php if ( !empty($socials) ) : ?>
                        <ul>
                            <?php foreach ( $socials as $item ) : 
                                $icon = $item['icon'];
                                $link = $item['link'];
                                if( $icon && $link ) :
                                    $link_url    = $link['url'];
                                    $link_title  = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <li>
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?: $link_title); ?>">
                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                            </li>
                            <?php endif; endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Block Footer Bottom: Copyright -->
            <div class="block-footer-bottom">
                <?php if ( $copyright_text ) : ?>
                <div class="item-copyright">
                    <span><?php echo wp_kses_post($copyright_text); ?></span>
                </div>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>