<?php
$h_title = get_field('service_feat_title');
$grid    = get_field('service_feat_grid');

if ( $grid ) :
?>
<section class="section-service-4">
    <div class="block-padding">
        <div class="container-fluid">
            <?php if ( $h_title ) : ?>
                <h2 class="heading-1 text-black text-center title"><?php echo esc_html($h_title); ?></h2>
            <?php endif; ?>
            
            <div class="box-grid mt-10">
                <?php foreach ( $grid as $item ) : ?>
                <div class="item-grid">
                    <div class="icon">
                        <?php if ( $item['icon'] ) : ?>
                            <img src="<?php echo esc_url($item['icon']); ?>" alt="icon" />
                        <?php endif; ?>
                    </div>
                    <div class="content">
                        <h3 class="content-title heading-5"><?php echo esc_html($item['title']); ?></h3>
                        <?php if ( $item['desc'] ) : ?>
                        <div class="description body-1 prose">
                            <?php echo wp_kses_post($item['desc']); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
