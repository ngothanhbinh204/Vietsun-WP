<?php
/**
 * Template Name: About Page
 */

get_header();
?>

<main>
    <?php 
    // Section 1: Banner Basic
    get_template_part('template-parts/section/about/banner'); 

    // Section 2: About 1 (Intro)
    get_template_part('template-parts/section/about/intro'); 

    // Section 3: About 2 (Journey)
    get_template_part('template-parts/section/about/journey'); 

    // Section 4: About 3 (Values)
    get_template_part('template-parts/section/about/values'); 

    // Section 5: About 4 (Team)
    get_template_part('template-parts/section/about/team'); 

    // Section 6: About 5 (Gallery)
    get_template_part('template-parts/section/about/gallery'); 

    // Section 7: About 6 (Sustainable)
    get_template_part('template-parts/section/about/sustainable'); 

    // Section 8: Home 7 (Partners section on about page)
    get_template_part('template-parts/section/about/partners'); 
    ?>
</main>

<?php
get_footer();
