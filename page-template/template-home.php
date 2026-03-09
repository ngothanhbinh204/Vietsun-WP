<?php
/**
 * Template Name: Home Page
 */

get_header();
?>

<main>
    <?php 
    // Section 1: Banner
    get_template_part('template-parts/section/home/banner'); 

    // Section 2: Purpose
    get_template_part('template-parts/section/home/purpose'); 

    // Section 3: Manufacturing Strength
    get_template_part('template-parts/section/home/manufacturing'); 

    // Section 4: Factories
    get_template_part('template-parts/section/home/factories'); 

    // Section 5: Products
    get_template_part('template-parts/section/home/products'); 

    // Section 6: Expanding Flex Cards
    get_template_part('template-parts/section/home/expand-cards'); 

    // Section 7: Journey Banner
    get_template_part('template-parts/section/home/journey-banner'); 

    // Section 8: Journey Slider
    get_template_part('template-parts/section/home/journey-slider'); 

    // Section 9: News & Events
    get_template_part('template-parts/section/home/news'); 
    ?>
</main>

<?php
get_footer();
