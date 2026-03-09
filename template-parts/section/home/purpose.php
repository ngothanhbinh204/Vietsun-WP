<?php
$purpose = get_field('home_purpose_slider');
if ( !empty($purpose) ) :
?>
<section class="section-home-1 h-screen min-h-auto lg:min-h-[900px]">
    
    <!-- DESKTOP SLIDER -->
    <div class="box-img-wrapper">
        <?php foreach ( $purpose as $slide ) : 
            $bg = isset($slide['bg_image']) ? $slide['bg_image'] : false;
            $icon = isset($slide['icon']) ? $slide['icon'] : false;
            $title = isset($slide['title']) ? $slide['title'] : '';
            $desc = isset($slide['desc']) ? $slide['desc'] : '';
            $btn = isset($slide['button']) ? $slide['button'] : false;
        ?>
        <div class="box-img">
            <div class="image-show relative">
                <?php if ( $bg ) : ?>
                <div class="img h-screen min-h-[900px]"><img class="lozad" data-src="<?php echo esc_url($bg['url']); ?>" alt="<?php echo esc_attr($bg['alt'] ?: $title); ?>"></div>
                <?php endif; ?>
                
                <div class="wrapper">
                    <div class="hover-point" hover-point>
                        <?php if ( $icon ) : ?>
                        <div class="icon-scroll" icon-animate>
                            <div class="icon flex-center relative"><img src="<?php echo esc_url($icon); ?>" alt="icon"></div>
                            <div class="logo"></div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="content">
                            <?php if ( $title ) : ?>
                            <div class="title">
                                <h2 class="text-center heading-2 text-white"><?php echo esc_html($title); ?></h2>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( $desc ) : ?>
                            <div class="sub-title text-white text-center body-1">
                                <p><?php echo nl2br(esc_html($desc)); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ( $btn ) : ?>
                        <div class="button"><a class="btn btn-white" href="<?php echo esc_url($btn['url']); ?>" target="<?php echo esc_attr($btn['target'] ?: '_self'); ?>"><span><?php echo esc_html($btn['title']); ?></span></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <!-- MOBILE SLIDER -->
    <div class="box-img-wrapper-mobile relative">
        <div class="swiper-column-auto auto-1-column">
            <div class="swiper">
                <div class="swiper-wrapper">
                    
                    <?php foreach ( $purpose as $slide ) : 
                        $bg = isset($slide['bg_image']) ? $slide['bg_image'] : false;
                        $icon = isset($slide['icon']) ? $slide['icon'] : false;
                        $title = isset($slide['title']) ? $slide['title'] : '';
                        $desc = isset($slide['desc']) ? $slide['desc'] : '';
                        $btn = isset($slide['button']) ? $slide['button'] : false;
                    ?>
                    <div class="swiper-slide">
                        <div class="card-home-1-mobile relative h-screen min-h-[600px]">
                            <?php if ( $bg ) : ?>
                            <div class="img absolute top-0 left-0 w-full h-full z-1"><img class="w-full h-full object-cover lozad" data-src="<?php echo esc_url($bg['url']); ?>" alt="<?php echo esc_attr($bg['alt'] ?: $title); ?>">
                            </div>
                            <?php endif; ?>
                            
                            <div class="wrapper absolute top-0 left-0 w-full h-full z-2 flex-center flex-col bg-black_50 px-base gap-base">
                                <?php if ( $icon ) : ?>
                                <div class="icon flex-center rounded-full border-2 border-white rem:w-[120px] rem:h-[120px]">
                                    <img src="<?php echo esc_url($icon); ?>" alt="icon">
                                </div>
                                <?php endif; ?>
                                
                                <div class="content flex flex-col gap-base">
                                    <?php if ( $title ) : ?>
                                    <div class="title">
                                        <h2 class="text-center heading-2 text-white"><?php echo esc_html($title); ?></h2>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if ( $desc ) : ?>
                                    <div class="sub-title text-white text-center body-1">
                                        <p><?php echo nl2br(esc_html($desc)); ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if ( $btn ) : ?>
                                <div class="button"><a class="btn btn-white" href="<?php echo esc_url($btn['url']); ?>" target="<?php echo esc_attr($btn['target'] ?: '_self'); ?>"><span><?php echo esc_html($btn['title']); ?></span></a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                </div>
            </div>
        </div>
        
        <?php if ( count($purpose) > 1 ) : ?>
        <div class="box-hand">
            <div class="indicator-swipe active">
                <div class="arrow btn-prev pointer-events-auto cursor-pointer"><i
                        class="fa-duotone fa-regular fa-angle-left"></i></div>
                <img class="hand" src="<?php echo get_template_directory_uri(); ?>/UI/img/Finger drag.svg" alt="drag icon" />
                <div class="arrow btn-next pointer-events-auto cursor-pointer"><i
                        class="fa-duotone fa-regular fa-angle-right"></i></div>
            </div>
        </div>
        <?php endif; ?>
        
    </div>
</section>
<?php endif; ?>
