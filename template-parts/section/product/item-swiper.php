<?php
$subtitle = get_field('product_subtitle');
$techs    = get_field('product_techs');
$thumb    = get_the_post_thumbnail_url(null, 'large');
?>
<div class="swiper-slide">
    <div class="child">
        <div class="item">
            <a class="img img-ratio ratio:pt-[320_290] rounded-4">
                <?php if ( $thumb ) : ?>
                    <img data-src="<?php echo esc_url($thumb); ?>" class="lozad" alt="<?php echo esc_attr(get_the_title()); ?>" />
                <?php endif; ?>
                <div class="bg-text"><span><?php the_title(); ?></span></div>
                <div class="content">
                    <h3 class="title uppercase heading-6"><?php the_title(); ?></h3>
                    <?php if ( $subtitle ) : ?>
                        <span class="sub-title body-3"><?php echo esc_html($subtitle); ?></span>
                    <?php endif; ?>
                    <?php if ( $techs ) : ?>
                    <div class="desc">
                        <strong>Tech:</strong>
                        <?php foreach ( $techs as $tech ) : ?>
                            <span><?php echo esc_html($tech['name']); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </a>
        </div>
    </div>
</div>
