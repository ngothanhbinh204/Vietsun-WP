<?php
$h_title = get_field('home_news_heading');
$h_link  = get_field('home_news_link');

// Get categories for News (assuming default 'category' or 'news_cat' taxonomies)
$categories = get_categories(array(
    'taxonomy'   => 'category', // Adjust if you use custom taxonomy
    'hide_empty' => true,
));
?>
<section class="section-home-8">
    <div class="block-bg">
        <div class="container-fluid">
            <div class="box-content smarttab-tab" data-toggle="smarttab" data-gsap-layout>
                <?php if ( $h_title ) : ?>
                <h2 class="heading-1 text-black text-center" data-gsap="split-chars" data-gsap-delay="0.5" data-gsap-duration="0.8" data-gsap-stagger="0.1" data-gsap-ease="power2.out">
                    <?php echo esc_html($h_title); ?>
                </h2>
                <?php endif; ?>
                
                <div class="filter-dropdown" data-gsap="fade-up" data-gsap-delay="0.7" data-gsap-duration="0.8" data-gsap-stagger="0.1" data-gsap-ease="power2.out">
                    <div class="filter-toggle">
                        <span class="selected-text">All</span>
                        <i class="fa-regular fa-chevron-down"></i>
                    </div>
                    <ul class="nav-tab filter-menu">
                        <li><a class="nav-link active" href="#tab-all"><span>All</span></a></li>
                        <?php foreach ( $categories as $cat ) : ?>
                        <li><a class="nav-link" href="#tab-<?php echo $cat->slug; ?>"><span><?php echo esc_html($cat->name); ?></span></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <div class="tab-content">
                    <!-- Tab All -->
                    <div class="tab-pane active" id="tab-all">
                        <?php 
                        $all_posts = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4));
                        if ( $all_posts->have_posts() ) :
                            while ( $all_posts->have_posts() ) : $all_posts->the_post();
                        ?>
                        <a class="card-news group" href="<?php the_permalink(); ?>">
                            <div class="img img-ratio ratio:pt-[296_395] zoom-img rounded-2">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <img class="lozad" src="<?php echo get_the_post_thumbnail_url(null, 'medium'); ?>" data-src="<?php echo get_the_post_thumbnail_url(null, 'medium'); ?>" alt="<?php the_title_attribute(); ?>" />
                                <?php else : ?>
                                    <img class="lozad" src="https://picsum.photos/400/300?random" data-src="https://picsum.photos/400/300?random" alt="" />
                                <?php endif; ?>
                            </div>
                            <div class="box-content">
                                <div class="date">
                                    <span><?php echo get_the_date('d/m/Y'); ?></span>
                                    <p><?php 
                                        $cats = get_the_category();
                                        echo $cats ? esc_html($cats[0]->name) : '';
                                    ?></p>
                                </div>
                                <div class="title">
                                    <h3><?php the_title(); ?></h3>
                                </div>
                            </div>
                        </a>
                        <?php endwhile; wp_reset_postdata(); endif; ?>
                    </div>
                    
                    <!-- Dynamic Category Tabs -->
                    <?php foreach ( $categories as $cat ) : ?>
                    <div class="tab-pane" id="tab-<?php echo $cat->slug; ?>">
                        <?php 
                        $cat_posts = new WP_Query(array(
                            'post_type' => 'post', 
                            'posts_per_page' => 4,
                            'category_name' => $cat->slug
                        ));
                        if ( $cat_posts->have_posts() ) :
                            while ( $cat_posts->have_posts() ) : $cat_posts->the_post();
                        ?>
                        <a class="card-news group" href="<?php the_permalink(); ?>">
                            <div class="img img-ratio ratio:pt-[296_395] zoom-img rounded-2">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <img class="lozad" src="<?php echo get_the_post_thumbnail_url(null, 'medium'); ?>" data-src="<?php echo get_the_post_thumbnail_url(null, 'medium'); ?>" alt="<?php the_title_attribute(); ?>" />
                                <?php else : ?>
                                    <img class="lozad" src="https://picsum.photos/400/300?random" data-src="https://picsum.photos/400/300?random" alt="" />
                                <?php endif; ?>
                            </div>
                            <div class="box-content">
                                <div class="date">
                                    <span><?php echo get_the_date('d/m/Y'); ?></span>
                                    <p><?php echo esc_html($cat->name); ?></p>
                                </div>
                                <div class="title">
                                    <h3><?php the_title(); ?></h3>
                                </div>
                            </div>
                        </a>
                        <?php endwhile; wp_reset_postdata(); endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <?php if ( $h_link ) : ?>
                <div class="button-news flex-center">
                    <a class="btn btn-icon" href="<?php echo esc_url($h_link['url']); ?>" target="<?php echo esc_attr($h_link['target'] ?: '_self'); ?>">
                        <span><?php echo esc_html($h_link['title']); ?></span>
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
