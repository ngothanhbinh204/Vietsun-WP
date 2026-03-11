<?php
$list = get_field('about3_list');
$slogan = get_field('about3_slogan');

if ( $list ) :
?>
<section class="section-about-3">
    <div class="block-tab-bg hidden lg:block" data-toggle="tabslet-hover" data-reset-on-leave="false">
        <div class="tabs-bg-wrapper">
            <?php 
            $count = 0;
            foreach ( $list as $item ) : 
                $count++;
            ?>
            <div class="tabslet-content <?php echo ($count === 1) ? 'active' : ''; ?>" id="tab<?php echo $count; ?>">
                <div class="box-bg" <?php echo $item['bg_image'] ? 'setBackground="' . esc_url($item['bg_image']['url']) . '"' : ''; ?>></div>
            </div>
            <?php endforeach; ?>
        </div>
        <ul class="tabslet-tab">
            <?php 
            $count = 0;
            foreach ( $list as $item ) : 
                $count++;
            ?>
            <li class="<?php echo ($count === 1) ? 'active' : ''; ?>">
                <a class="item-link" href="#tab<?php echo $count; ?>">
                    <div class="item-inner">
                        <div class="content">
                            <h2 class="title"><?php echo esc_html($item['tab_title']); ?></h2>
                            <?php if ( $item['desc'] ) : ?>
                            <div class="desc prose">
                                <?php echo wp_kses_post($item['desc']); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <div class="block-swiper-mobile block w-full lg:hidden">
        <div class="swiper-column-auto auto-1-column">
            <div class="swiper">
                <div class="swiper-wrapper h-full">
                    <?php foreach ( $list as $item ) : ?>
                    <div class="swiper-slide">
                        <div class="item-inner relative h-full w-full">
                            <div class="box-bg absolute inset-0 z-0 h-full w-full bg-cover bg-center"
                                <?php echo $item['bg_image'] ? 'setBackground="' . esc_url($item['bg_image']['url']) . '"' : ''; ?>>
                                <div class="overlay absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                            </div>
                            <div class="content relative z-10 flex h-full flex-col justify-end p-base pb-10">
                                <h2 class="title heading-2 text-white mb-4"><?php echo esc_html($item['tab_title']); ?></h2>
                                <?php if ( $item['desc'] ) : ?>
                                <div class="desc text-white body-1 prose">
                                    <?php echo wp_kses_post($item['desc']); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php if ( $slogan ) : ?>
    <div class="block-text">
        <h2 class="body-6 text-primary-1"><?php echo esc_html($slogan); ?></h2>
        <div class="button-swiper-hand">
            <div class="indicator-swipe active">
                <div class="arrow btn-prev pointer-events-auto cursor-pointer"><i class="fa-duotone fa-regular fa-angle-left"></i></div>
                <img class="hand" src="<?php echo THEME_URI; ?>/img/Finger drag.svg" alt="" />
                <div class="arrow btn-next pointer-events-auto cursor-pointer"><i class="fa-duotone fa-regular fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
<?php endif; ?>
