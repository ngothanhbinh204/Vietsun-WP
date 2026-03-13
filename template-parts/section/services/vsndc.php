<?php
$h_title = get_field('service_vsn_title');
$h_desc  = get_field('service_vsn_desc');
$gallery = get_field('service_vsn_gallery');
$link    = get_field('service_vsn_link');
?>
<section class="section-service-5">
    <div class="block-padding">
        <div class="container-fluid">
            <div class="box-content">
                <?php if ( $h_title ) : ?>
                    <h2 class="heading-1 text-black title capitalize"><?php echo esc_html($h_title); ?></h2>
                <?php endif; ?>
                
                <?php if ( $h_desc ) : ?>
                    <div class="sub-title prose mt-4">
                        <?php echo wp_kses_post($h_desc); ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if ( $gallery ) : ?>
            <div class="box-grid mt-10">
                <?php foreach ( $gallery as $item ) : ?>
                <div class="item-grid group">
                    <a class="img img-ratio ratio:pt-[373_560] zoom-img rounded-2" href="<?php echo esc_url($item['image']['url']); ?>" data-fancybox="service-gallery">
                        <img class="lozad" src="<?php echo esc_url($item['image']['url']); ?>" data-src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['image']['alt']); ?>" />
                        <?php if ( $item['text'] ) : ?>
                            <div class="content"><span><?php echo esc_html($item['text']); ?></span></div>
                        <?php endif; ?>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <?php if ( $link ) : ?>
            <div class="button-news flex-center mt-base">
                <a class="btn btn-icon" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
                    <span><?php echo esc_html($link['title']); ?></span>
                    <i class="fa-regular fa-chevron-down"></i>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
