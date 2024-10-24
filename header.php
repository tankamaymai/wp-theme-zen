<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php $media_id = get_theme_mod('mytheme_background_media'); ?>
    <?php if ($media_id): ?>
        <?php $media_type = get_post_mime_type($media_id); ?>
        <div class="background-media" <?php if (strpos($media_type, 'image') !== false): ?>style="background-image: url('<?php echo wp_get_attachment_url($media_id); ?>');" <?php endif; ?>>
            <?php if (strpos($media_type, 'video') !== false): ?>
                <video autoplay muted loop id="backgroundVideo">
                    <source src="<?php echo wp_get_attachment_url($media_id); ?>" type="<?php echo $media_type; ?>">
                </video>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- ヘッダー上 -->
    <?php
    $has_active_widgets = false;

    // ウィジェットエリアを確認
    for ($i = 1; $i <= 3; $i++) {
        if (is_active_sidebar('header-top-widget-area-' . $i)) {
            $has_active_widgets = true;
            break;
        }
    }

    // ウィジェットが登録されている場合のみ表示
    if ($has_active_widgets): ?>
        <div id="header-top" class="header-widgets"
            style="
        <?php echo get_theme_mod('mytheme_header_top_section_background_color') ? 'background-color: ' . get_theme_mod('mytheme_header_top_section_background_color') . ';' : ''; ?>
        <?php echo get_theme_mod('mytheme_header_top_section_text_color') ? 'color: ' . get_theme_mod('mytheme_header_top_section_text_color') . ';' : ''; ?>">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <div class="header-widget-column header-widget-column-<?php echo $i; ?>">
                    <?php if (is_active_sidebar('header-top-widget-area-' . $i)): ?>
                        <?php dynamic_sidebar('header-top-widget-area-' . $i); ?>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

    <!-- メインヘッダー -->
    <header id="masthead" class="site-header"
        style="
    <?php echo get_theme_mod('mytheme_main_header_section_background_color') ? 'background-color: ' . get_theme_mod('mytheme_main_header_section_background_color') . ';' : ''; ?>
    <?php echo get_theme_mod('mytheme_main_header_section_text_color') ? 'color: ' . get_theme_mod('mytheme_main_header_section_text_color') . ';' : ''; ?>">

     <div class="site-branding">
    <?php
    $logo_width = get_theme_mod('mytheme_logo_width', '200');
    if (has_custom_logo()) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        ?>


        <div class="site-logo" style="display: flex; align-items: center;">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" style="display: inline-block; width: 100%;">
                <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" style="width: 100%; height: auto; display: block; object-fit: contain;">
            </a>
        </div>
    <?php } else { ?>
        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"
                style="<?php echo get_theme_mod('mytheme_main_header_section_text_color') ? 'color: ' . get_theme_mod('mytheme_main_header_section_text_color') . ';' : ''; ?>"><?php bloginfo('name'); ?></a>
        </h1>
    <?php } ?>
    <p class="site-description"><?php bloginfo('description'); ?></p>
</div>
        <div class="site-menu">

            <!-- PC用ナビゲーション -->
            <nav class="pc-navigation" id="pc-nav">
                <?php wp_nav_menu(array(
                    'theme_location' => 'global_menu',
                    'container' => 'div', // コンテナをdivに設定
                    'container_class' => 'pc-menu-container', // コンテナのクラスを設定
                    'menu_class' => 'pc-menu',
                    'fallback_cb' => false,
                    'link_before' => '<span style="' . (get_theme_mod('mytheme_main_header_section_text_color') ? 'color: ' . get_theme_mod('mytheme_main_header_section_text_color') . ';' : '') . '">',
                    'link_after' => '</span>'
                )); ?>
            </nav>
            <div class="header-cta-buttons">
                <?php for ($i = 1; $i <= get_theme_mod('mytheme_cta_button_count', 1); $i++): ?>
                    <?php
                    $icon_only = get_theme_mod("mytheme_cta_button_icon_only_$i", false);
                    $icon = get_theme_mod("mytheme_cta_button_icon_$i", '');
                    $text = get_theme_mod("mytheme_cta_button_text_$i", '');
                    $link = get_theme_mod("mytheme_cta_button_link_$i", '');
                    ?>
                    <a href="<?php echo esc_url($link); ?>" class="cta-button cta-button-<?php echo $i; ?>">
                        <?php if ($icon): ?>
                            <span class="cta-button-icon"><i class="<?php echo esc_attr($icon); ?>"></i></span>
                        <?php endif; ?>
                        <?php if (!$icon_only): ?>
                            <span class="cta-button-text"><?php echo esc_html($text); ?></span>
                        <?php endif; ?>
                    </a>
                <?php endfor; ?>
            </div>




            <!-- スマホ用ナビゲーション -->

            <?php
            $menu_text = get_theme_mod('mytheme_hamburger_menu_text', '');
            $menu_class = !empty($menu_text) ? 'has-subtext' : '';
            ?>
            <button id="menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="menu-icon <?php echo esc_attr($menu_class); ?>"></span>
                <span class="screen-reader-text"><?php _e('メニュー', 'mytheme'); ?></span>
                <?php
                $menu_text = get_theme_mod('mytheme_hamburger_menu_text', '');
                $text_color = get_theme_mod('mytheme_hamburger_menu_subtext_color', '#ffffff');
                $font_size = get_theme_mod('mytheme_hamburger_menu_subtext_font_size', '14');

                if (!empty($menu_text)) {
                    echo '<span class="hamburger-menu-text" style="color: ' . esc_attr($text_color) . '; font-size: ' . esc_attr($font_size) . 'px;">' . esc_html($menu_text) . '</span>';
                }
                ?>
            </button>
            <nav class="mobile-navigation" id="mobile-nav">
                <?php wp_nav_menu(array(
                    'theme_location' => 'global_menu',
                    'container' => 'div',
                    'container_class' => 'mobile-menu-container',
                    'menu_class' => 'mobile-menu',
                    'fallback_cb' => false,
                    'link_before' => '<span style="' . esc_attr(get_theme_mod('mytheme_hamburger_menu_text_color', '#333333')) . '">',
                    'link_after' => '</span>'
                )); ?>
            </nav>
        </div>



    </header>

    <!-- ヘッダー下 -->
    <?php
    $has_active_widgets = false;

    // ウィジェットエリアを確認
    for ($i = 1; $i <= 3; $i++) {
        if (is_active_sidebar('header-bottom-widget-area-' . $i)) {
            $has_active_widgets = true;
            break;
        }
    }

    // ウィジェットが登録されている場合のみ表示
    if ($has_active_widgets): ?>
        <div id="header-bottom" class="header-widgets"
            style="
        <?php echo get_theme_mod('mytheme_header_bottom_section_background_color') ? 'background-color: ' . get_theme_mod('mytheme_header_bottom_section_background_color') . ';' : ''; ?>
        <?php echo get_theme_mod('mytheme_header_bottom_section_text_color') ? 'color: ' . get_theme_mod('mytheme_header_bottom_section_text_color') . ';' : ''; ?>">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <div class="header-widget-column header-widget-column-<?php echo $i; ?>">
                    <?php if (is_active_sidebar('header-bottom-widget-area-' . $i)): ?>
                        <?php dynamic_sidebar('header-bottom-widget-area-' . $i); ?>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

    <?php wp_footer(); ?>
</body>

</html>