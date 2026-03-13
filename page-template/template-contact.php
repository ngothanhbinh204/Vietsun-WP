<?php
/**
 * Template Name: Contact Page
 *
 * Trang Liên Hệ — ánh xạ từ UI/contact.html
 * Fields quản lý qua ACF: group_contact_page.json
 */

get_header();

// --- ACF Fields ---
$banner         = get_field('contact_banner_bg');
$form_title     = get_field('contact_form_title')   ?: 'Contact';
$form_subtitle  = get_field('contact_form_subtitle');
$cf7         = get_field('contact_cf7');
$info_title     = get_field('contact_info_title')   ?: 'INFORMATION';
$info_items     = get_field('contact_info_items');
$working_hours  = get_field('contact_working_hours');
$map_embed      = get_field('contact_map_embed');
?>

<main>

    <!-- Section 1: Banner -->
    <section class="section-service-1">
        <div class="img img-ratio ratio:pt-[720_1920]">
            <?php if ( $banner ) : ?>
                <img class="lozad" src="<?php echo esc_url($banner['url']); ?>" data-src="<?php echo esc_url($banner['url']); ?>" alt="<?php echo esc_attr($banner['alt'] ?: the_title_attribute('echo=0')); ?>" />
            <?php endif; ?>
        </div>
    </section>

    <!-- Section 2: Breadcrumb -->
    <section class="global-breadcrumb">
        <div class="container-fluid">
            <?php if ( function_exists('rank_math_the_breadcrumbs') ) {
                rank_math_the_breadcrumbs();
            } else { ?>
                <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                    <p>
                        <a href="<?php echo home_url(); ?>"><?php esc_html_e('Trang chủ', 'canhcamtheme'); ?></a>
                        <span class="separator"></span>
                        <span class="last"><?php the_title(); ?></span>
                    </p>
                </nav>
            <?php } ?>
        </div>
    </section>

    <!-- Section 3: Contact Main -->
    <section class="section-contact">

        <div class="box-content">

            <!-- LEFT: Form -->
            <div class="form-content">
                <h1 class="title"><?php echo esc_html($form_title); ?></h1>

                <div class="form-contact">
                    <?php if ( $form_subtitle ) : ?>
                        <div class="sub-title prose">
                            <?php echo wp_kses_post($form_subtitle); ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    // Render Contact Form 7
                    if ( $cf7 ) {
                        echo do_shortcode($cf7);
                    }
                    ?>
                </div>
            </div>

            <!-- RIGHT: Contact Information -->
            <div class="infor">
                <h2 class="title"><?php echo esc_html($info_title); ?></h2>

                <?php if ( $info_items ) :
                    foreach ( $info_items as $item ) :
                        $icon = $item['icon'];
                        $link = $item['link'];
                        if ( !$link ) continue;
                ?>
                <div class="item-infor">
                    <div class="icon"><i class="fa-solid <?php echo esc_attr($icon); ?>"></i></div>
                    <a class="text"
                       href="<?php echo esc_url($link['url']); ?>"
                       target="<?php echo esc_attr($link['target'] ?: '_blank'); ?>"
                       rel="noopener noreferrer">
                        <?php echo esc_html($link['title']); ?>
                    </a>
                </div>
                <?php endforeach; endif; ?>

                <?php if ( $working_hours ) : ?>
                <div class="item-infor-time">
                    <div class="icon"><i class="fa-solid fa-clock"></i></div>
                    <p class="text">
                        <?php foreach ( $working_hours as $row ) : ?>
                            <span>
                                <strong><?php echo esc_html($row['day']); ?>:</strong>
                                <?php echo esc_html($row['time']); ?>
                            </span>
                        <?php endforeach; ?>
                    </p>
                </div>
                <?php endif; ?>
            </div>

        </div><!-- .box-content -->

        <!-- Map -->
        <?php if ( $map_embed ) : ?>
        <div class="box-map">
            <div class="img-ratio ratio:pt-[760_1720]">
                <iframe
                    src="<?php echo esc_url($map_embed); ?>"
                    width="600"
                    height="450"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
        <?php endif; ?>

    </section>

</main>

<?php get_footer(); ?>
