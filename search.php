<?php
/**
 * Search Results Template
 *
 * Chỉ hiển thị kết quả tìm kiếm cho post_type = post (bài viết).
 * Layout dùng cùng card-news giống section/news/list.php, bỏ box-news-hot.
 */

get_header();

$search_query   = get_search_query();
?>

<main>

    <!-- Section 1: Search Header -->
    <section class="section-search-header pt-20">
        <div class="container-fluid">
            <div class="wrap-heading text-center">
                <h1 class="title heading-1 uppercase"><?php esc_html_e('Search Results', 'canhcamtheme'); ?></h1>
                <p class="search-query-text body-2 mt-4">
                    <?php
                    printf(
                        esc_html__('Kết quả tìm kiếm cho: "%s"', 'canhcamtheme'),
                        '<strong class="text-primary-4">' . esc_html($search_query) . '</strong>'
                    );
                    ?>
                    &nbsp;—&nbsp;
                    <span class="text-muted">
                        <?php printf(esc_html__('%d bài viết', 'canhcamtheme'), (int) $GLOBALS['wp_query']->found_posts); ?>
                    </span>
                </p>

                <!-- Search form để search lại -->
                <div class="flex-center mt-8">
                    <form role="search" method="get" class="search-form flex gap-2 w-full max-w-xl" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" class="search-field flex-1 border border-border rounded-4 px-4 py-3" name="s"
                               value="<?php echo esc_attr($search_query); ?>"
                               placeholder="<?php esc_attr_e('Nhập từ khóa...', 'canhcamtheme'); ?>" />
                        <input type="hidden" name="post_type" value="post" />
                        <button type="submit" class="btn btn-icon">
                            <span><?php esc_html_e('Tìm kiếm', 'canhcamtheme'); ?></span>
                            <i class="fa-regular fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <section class="global-breadcrumb">
        <div class="container-fluid">
            <?php if ( function_exists('rank_math_the_breadcrumbs') ) {
                rank_math_the_breadcrumbs();
            } else { ?>
                <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                    <p>
                        <a href="<?php echo home_url(); ?>"><?php esc_html_e('Trang chủ', 'canhcamtheme'); ?></a>
                        <span class="separator"></span>
                        <span class="last"><?php esc_html_e('Tìm kiếm', 'canhcamtheme'); ?></span>
                    </p>
                </nav>
            <?php } ?>
        </div>
    </section>

    <!-- Section 2: Results — layout giống news/list.php, ẩn box-news-hot -->
    <?php 
    if ( have_posts() ) {
        get_template_part('template-parts/section/news/list', null, array('hide_hot' => true)); 
    } else { ?>
    <section class="section-news">
        <div class="wrap py-16 text-center">
            <p class="heading-3 mb-4">
                <?php printf(
                    esc_html__('Không tìm thấy bài viết nào cho từ khóa "%s".', 'canhcamtheme'),
                    esc_html($search_query)
                ); ?>
            </p>
            <p><?php esc_html_e('Hãy thử tìm kiếm với từ khóa khác.', 'canhcamtheme'); ?></p>
            <a class="btn btn-icon mt-6" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
                <span><?php esc_html_e('Xem tất cả tin tức', 'canhcamtheme'); ?></span>
                <i class="fa-regular fa-chevron-right"></i>
            </a>
        </div>
    </section>
    <?php } ?>

</main>

<?php get_footer(); ?>