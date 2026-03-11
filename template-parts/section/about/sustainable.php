<?php
$bg    = get_field('about6_bg');
$title = get_field('about6_title');
$desc  = get_field('about6_desc');
$stats = get_field('about6_stats');
?>
<section class="section-about-6" <?php echo $bg ? 'setBackground="' . esc_url($bg['url']) . '"' : ''; ?>>
    <div class="container-fluid">
        <div class="section-py">
            <div class="block-grid">
                <div class="box-left">
                    <div class="item">
                        <?php if ( $title ) : ?>
                        <h2 class="heading-1 text-white"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>
                        
                        <?php if ( $desc ) : ?>
                        <div class="sub-title prose">
                            <?php echo wp_kses_post($desc); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <?php if ( $stats ) : ?>
                <div class="box-right">
                    <ul>
                        <?php foreach ( $stats as $stat ) : ?>
                        <li>
                            <span class="countup" data-countup="<?php echo esc_attr($stat['number']); ?>"></span>
                            <strong><?php echo esc_html($stat['label']); ?></strong>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
