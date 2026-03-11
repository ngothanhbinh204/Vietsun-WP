<?php
$bg = get_field('about_banner_bg');
$title = get_field('about_banner_title');
$desc = get_field('about_banner_desc');

if ( $bg || $title || $desc ) :
?>
<section class="section-banner-basic">
    <div class="img img-ratio ratio:pt-[960_1920]">
        <?php if ( $bg ) : ?>
            <img class="lozad" data-src="<?php echo esc_url($bg['url']); ?>" alt="<?php echo esc_attr($bg['alt'] ?: $title); ?>" />
        <?php endif; ?>
        
        <div class="container-fluid">
            <div class="block-content">
                <div class="global-breadcrumb">
                    <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                        <p>
                            <a href="<?php echo home_url(); ?>"><?php esc_html_e('Trang chủ', 'canhcam'); ?></a>
                            <span class="separator"></span>
                            <span class="last"><?php echo esc_html(get_the_title()); ?></span>
                        </p>
                    </nav>
                </div>
                
                <?php if ( $title ) : ?>
                <div class="item-title">
                    <h1 class="heading-banner text-white capitalize"><?php echo esc_html($title); ?></h1>
                </div>
                <?php endif; ?>
                
                <?php if ( $desc ) : ?>
                <div class="item-content prose">
                    <?php echo wp_kses_post($desc); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
