<?php
$img     = get_field('about1_img');
$content = get_field('about1_content');
$slider  = get_field('about1_slider');
?>
<section class="section-about-1">
    <div class="block-padding">
        <div class="container-fluid">
            <div class="box-content">
                <div class="item-left">
                    <?php if ( $img ) : ?>
                    <div class="img img-ratio ratio:pt-[281_311] zoom-img">
                        <img class="lozad" data-src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                    </div>
                    <?php endif; ?>
                </div>
                <div class="item-right">
                    <div class="prose">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </div>
            </div>
            
            <?php if ( $slider ) : ?>
            <div class="box-embla">
                <div class="embla">
                    <div class="embla__viewport">
                        <div class="embla__container">
                            <?php foreach ( $slider as $slide ) : ?>
                            <div class="embla__slide">
                                <div class="img img-ratio ratio:pt-[400_600] zoom-img">
                                    <img class="lozad" data-src="<?php echo esc_url($slide['url']); ?>" alt="<?php echo esc_attr($slide['alt']); ?>" />
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
