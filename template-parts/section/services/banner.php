<?php
$bg = get_field('service_banner_bg');
?>
<section class="section-service-1">
    <div class="img img-ratio ratio:pt-[720_1920]">
        <?php if ( $bg ) : ?>
            <img class="lozad" src="<?php echo esc_url($bg['url']); ?>" data-src="<?php echo esc_url($bg['url']); ?>" alt="<?php echo esc_attr($bg['alt']); ?>" />
        <?php else : ?>
            <img class="lozad" src="https://picsum.photos/1920/720?random" data-src="https://picsum.photos/1920/720?random" alt="" />
        <?php endif; ?>
    </div>
</section>

<section class="global-breadcrumb">
    <div class="container-fluid">
        <?php if ( function_exists('rank_math_the_breadcrumbs') ) rank_math_the_breadcrumbs(); ?>
        <!-- Nếu không dùng Rank Math thì fallback lại cấu trúc HTML tĩnh -->
        <?php if ( !function_exists('rank_math_the_breadcrumbs') ) : ?>
        <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
            <p><a href="<?php echo home_url(); ?>"><?php esc_html_e('Trang chủ', 'canhcamtheme'); ?></a><span class="separator"></span><span class="last"><?php the_title(); ?></span></p>
        </nav>
        <?php endif; ?>
    </div>
</section>
