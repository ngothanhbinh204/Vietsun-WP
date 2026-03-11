<?php
$title = get_field('about4_title');
$total = get_field('about4_total');
$label = get_field('about4_label');
$desc  = get_field('about4_desc');
$hubs  = get_field('about4_hubs');

if ( $hubs ) :
?>
<section class="section-about-4">
    <div class="block-padding">
        <div class="tabslet-wrapper" data-toggle="tabslet">
            <div class="container-fluid">
                <div class="box-flex">
                    <div class="item-top">
                        <?php if ( $title ) : ?>
                        <h2 class="heading-1 text-primary-4"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>
                        
                        <div class="filter-dropdown" data-toggle="tabslet-filter">
                            <div class="filter-toggle">
                                <span class="selected-text"><?php echo esc_html($hubs[0]['hub_name']); ?></span>
                                <i class="fa-regular fa-chevron-down"></i>
                            </div>
                            <ul class="tabslet-tab filter-menu">
                                <?php 
                                $count = 0;
                                foreach ( $hubs as $hub ) : 
                                    $count++;
                                ?>
                                <li class="<?php echo ($count === 1) ? 'active' : ''; ?>">
                                    <a href="#tab-hub-<?php echo $count; ?>"><span><?php echo esc_html($hub['hub_name']); ?></span></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="item-bottom">
                        <?php if ( $total ) : ?>
                        <div class="item-bottom-left"><strong><?php echo esc_html($total); ?></strong><span><?php echo esc_html($label); ?></span></div>
                        <?php endif; ?>
                        
                        <?php if ( $desc ) : ?>
                        <div class="item-bottom-right prose">
                            <?php echo wp_kses_post($desc); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="tab-swiper">
                <?php 
                $count = 0;
                foreach ( $hubs as $hub ) : 
                    $count++;
                ?>
                <div class="tabslet-content <?php echo ($count === 1) ? 'active' : ''; ?>" id="tab-hub-<?php echo $count; ?>">
                    <div class="box-swiper">
                        <div class="container-fluid">
                            <div class="swiper-about-4">
                                <div class="swiper" data-id-swiper="about-4-<?php echo $count; ?>">
                                    <div class="swiper-wrapper">
                                        <?php if ( $hub['members'] ) : ?>
                                            <?php foreach ( $hub['members'] as $member ) : ?>
                                            <div class="swiper-slide">
                                                <div class="child">
                                                    <div class="card-member">
                                                        <div class="item">
                                                            <div class="img img-ratio ratio:pt-[480_410] zoom-img relative">
                                                                <?php if ( $member['avatar'] ) : ?>
                                                                    <img class="lozad" data-src="<?php echo esc_url($member['avatar']['url']); ?>" alt="<?php echo esc_attr($member['avatar']['alt']); ?>" />
                                                                <?php endif; ?>
                                                                <div class="content">
                                                                    <div class="content-item prose">
                                                                        <?php echo wp_kses_post($member['desc']); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="info">
                                                            <div class="name"><strong><?php echo esc_html($member['name']); ?></strong></div>
                                                            <div class="position">
                                                                <p><?php echo esc_html($member['position']); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <div class="button-swiper">
                    <div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="about-4"><i class="fa-regular fa-chevron-left"></i></div>
                    <div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="about-4"><i class="fa-regular fa-chevron-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
