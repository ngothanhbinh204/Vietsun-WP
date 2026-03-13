<?php
function log_dump($data)
{
	ob_start();
	var_dump($data);
	$dump = ob_get_clean();

	$highlighted = highlight_string("<?php\n" . $dump . "\n?>", true);

	$formatted = '<pre>' . substr($highlighted, 27, -8) . '</pre>';

	$custom_css = 'pre {position: static;
		background: #ffffff80;
		// max-height: 50vh;
		width: 100vw;
	}
	pre::-webkit-scrollbar{
	width: 1rem;}';

	$formatted_css = '<style>' . $custom_css . '</style>';
	echo ($formatted_css . $formatted);
}

function empty_content($str)
{
	return trim(str_replace('&nbsp;', '', strip_tags($str, '<img>'))) == '';
}
function cc_wpml_custom_language_dropdown() {

    if ( ! function_exists( 'icl_get_languages' ) ) {
        return;
    }

    $languages = apply_filters( 'wpml_active_languages', null, [
        'skip_missing' => 0,
        'orderby'      => 'code'
    ]);

    if ( empty( $languages ) ) {
        return;
    }

    // Map custom flag
    $flag_map = [
        'vi' => get_template_directory_uri() . '/img/VN.png',
        'en' => get_template_directory_uri() . '/img/EN.png',
    ];

    $current_lang = null;

    foreach ( $languages as $lang ) {
        if ( $lang['active'] ) {
            $current_lang = $lang;
            break;
        }
    }

    if ( ! $current_lang ) {
        return;
    }

    $current_code = $current_lang['language_code'];
    $current_flag = $flag_map[$current_code] ?? $current_lang['country_flag_url'];
?>

<div class="header-lang">
    <ul>
        <li class="wpml-ls-item">

            <a href="<?php echo esc_url( $current_lang['url'] ); ?>">
                <img src="<?php echo esc_url( $current_flag ); ?>" alt="<?php echo esc_attr( $current_code ); ?>" />
                <span class="wpml-ls-native">
                    <?php echo esc_html( strtoupper( $current_code ) ); ?>
                </span>
            </a>

            <ul>
                <?php foreach ( $languages as $lang ) :

                    if ( $lang['active'] ) continue;

                    $code = $lang['language_code'];
                    $flag = $flag_map[$code] ?? $lang['country_flag_url'];
                ?>

                <li>
                    <a href="<?php echo esc_url( $lang['url'] ); ?>">
                        <img src="<?php echo esc_url( $flag ); ?>" alt="<?php echo esc_attr( $code ); ?>" />
                        <span><?php echo esc_html( strtoupper( $code ) ); ?></span>
                    </a>
                </li>

                <?php endforeach; ?>
            </ul>

        </li>
    </ul>
</div>

<?php
}
?>