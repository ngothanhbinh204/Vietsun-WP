<?php
/**
 * Template Name: Services Page
 */

get_header();
?>

<main>
    <?php 
    // Section 1: Banner & Breadcrumb
    get_template_part('template-parts/section/services/banner');

    // Section 2: SPD Our Development Center
    get_template_part('template-parts/section/services/spd');

    // Section 3: Our Product Slider
    get_template_part('template-parts/section/services/product');

    // Section 4: Product Features Grid
    get_template_part('template-parts/section/services/features');

    // Section 5: VSN DC Development Cycle
    get_template_part('template-parts/section/services/vsndc');
    ?>
</main>

<?php
get_footer();
