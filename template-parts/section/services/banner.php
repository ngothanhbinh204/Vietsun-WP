<?php
$bg = get_field('service_banner_bg');
if ( $bg ) :
?>
<section class="section-service-1">
    <div class="img img-ratio ratio:pt-[720_1920]">
        <img class="lozad" data-src="<?php echo esc_url($bg['url']); ?>" alt="<?php echo esc_attr($bg['alt'] ?: get_the_title()); ?>" />
    </div>
</section>

<section class="global-breadcrumb">
    <div class="container-fluid">
        <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
            <p>
                <a href="<?php echo home_url(); ?>"><?php esc_html_e('Trang chủ', 'canhcam'); ?></a>
                <span class="separator"></span>
                <span class="last"><?php echo esc_html(get_the_title()); ?></span>
            </p>
        </nav>
    </div>
</section>
<?php endif; ?>
