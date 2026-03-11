<?php
/**
 * Template Name: About Template
 */

get_header();
?>

<main>
    <?php 
    get_template_part('template-parts/section/about/banner');
    get_template_part('template-parts/section/about/intro');
    get_template_part('template-parts/section/about/journey');
    get_template_part('template-parts/section/about/values');
    get_template_part('template-parts/section/about/team');
    get_template_part('template-parts/section/about/gallery');
    get_template_part('template-parts/section/about/sustainable');
    get_template_part('template-parts/section/about/partners');
    ?>
</main>

<?php 
get_footer();
