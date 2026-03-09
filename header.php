<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Fonts Connect (Should ideally be in enqueue, keeping as is for safety if not handled) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
/**
 * Lấy dữ liệu từ ACF Options Page
 */
$cta_phone   = get_field('cta_phone', 'option');
$cta_url     = get_field('cta_url', 'option');
$header_logo = get_field('header_logo', 'option');
?>

<!-- Tool Fixed CTA -->
<div class="tool-fixed-cta">
    <div class="btn button-to-top">
        <div class="btn-icon">
            <div class="icon"></div>
        </div>
    </div>
    
    <?php if ( $cta_phone && $cta_url ) : ?>
    <a class="btn btn-content bg-linear-primary" href="<?php echo esc_url($cta_url); ?>">
        <div class="btn-icon">
            <div class="icon"><i class="fa-light fa-phone"></i></div>
        </div>
        <div class="content"><?php echo esc_html($cta_phone); ?></div>
    </a>
    <?php endif; ?>
</div>

<header>
    <div class="section-header">
        <div class="container-fluid">
            <div class="block-header">
                
                <!-- Logo -->
                <div class="box-left">
                    <div class="item-logo">
                        <?php if ( $header_logo ) : ?>
                        <div class="header-logo">
                            <a class="img img-ratio ratio:pt-[60_146]" href="<?php echo esc_url(home_url('/')); ?>">
                                <img class="lozad" data-src="<?php echo esc_url($header_logo['url']); ?>" alt="<?php echo esc_attr($header_logo['alt'] ?: get_bloginfo('name')); ?>" />
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Menu + Search + Mobile elements -->
                <div class="box-right">
                    
                    <!-- Desktop Menu -->
                    <div class="item-menu">
                        <div class="header-menu">
                            <?php 
                            if ( has_nav_menu( 'header-menu' ) ) {
                                wp_nav_menu( array(
                                    'theme_location' => 'header-menu',
                                    'container'      => false,
                                    'menu_class'     => '',
                                    'items_wrap'     => '<ul>%3$s</ul>',
                                    'fallback_cb'    => false,
                                ) );
                            }
                            ?>
                        </div>
                    </div>
                    
                    <!-- Search & Language -->
                    <div class="item-search-lang">
                        <div class="header-search">
                            <img src="<?php echo get_template_directory_uri(); ?>/UI/img/seach.svg" alt="<?php esc_attr_e('Search', 'canhcamtheme'); ?>">
                        </div>
                        <div class="header-lang">
                            <!-- Hiển thị dummy lang picker, thực tế sẽ sử dụng hook của WPML hoặc Polylang -->
                            <ul>
                                <li class="wpml-ls-item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/UI/img/VN.png" alt="VN" /><span class="wpml-ls-native">VN</span></a>
                                    <ul>
                                        <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/UI/img/EN.png" alt="EN" /><span>EN</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Mobile Hamburger & Navbar -->
                    <div class="hamburger-mobile">
                        <div class="header-hamburger">
                            <div class="wrap"><span></span><span></span><span></span></div>
                            <div id="pulseMe">
                                <div class="bar left"></div>
                                <div class="bar top"></div>
                                <div class="bar right"></div>
                                <div class="bar bottom"></div>
                            </div>
                        </div>
                        <div class="navbar-mobile 2xl:hidden p-0">
                            <div class="menu-overlay"></div>
                            <div class="mobi-bg md:w-1/2 h-full bg-white z-50 p-5 relative">
                                <div class="header-search-form-mobile">
                                    <form action="<?php echo esc_url(home_url('/')); ?>" method="GET" class="flex w-full">
                                        <input name="s" class="focus:outline-primary-1/20" type="text" placeholder="<?php esc_attr_e('Search...', 'canhcamtheme'); ?>" value="<?php echo get_search_query(); ?>">
                                        <button type="submit"></button>
                                    </form>
                                </div>
                                <div class="menu-list">
                                    <?php 
                                    if ( has_nav_menu( 'mobile' ) ) {
                                        wp_nav_menu( array(
                                            'theme_location' => 'mobile',
                                            'container'      => false,
                                            'menu_class'     => '',
                                            'items_wrap'     => '<ul>%3$s</ul>',
                                            'fallback_cb'    => false,
                                        ) );
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Desktop Search Form Popup -->
<div class="header-search-form">
    <div class="close flex-center w-12 h-12 bg-primary-1 rounded-full text-white absolute top-0 right-0 m-3 cursor-pointer hover:bg-primary-7">
        <i class="fa-light fa-xmark"></i>
    </div>
    <div class="container w-full">
        <div class="wrap-form-search-product">
            <form action="<?php echo esc_url(home_url('/')); ?>" method="GET" class="productsearchbox">
                <input type="text" name="s" placeholder="<?php esc_attr_e('Tìm kiếm ...', 'canhcamtheme'); ?>" value="<?php echo get_search_query(); ?>">
                <button type="submit"></button>
            </form>
        </div>
    </div>
</div>

<main id="main" class="site-main">