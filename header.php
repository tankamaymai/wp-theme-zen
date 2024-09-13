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
            <?php if (has_custom_logo()) {
                the_custom_logo();
            } else { ?>
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
            <div class="header-cta-buttons"
                data-count="<?php echo esc_attr(get_theme_mod('mytheme_cta_button_count', 1)); ?>">
                <?php
                $cta_button_count = get_theme_mod('mytheme_cta_button_count', 1);
                for ($i = 1; $i <= $cta_button_count; $i++):
                    $button_text = get_theme_mod("mytheme_cta_button_text_$i");
                    $button_link = get_theme_mod("mytheme_cta_button_link_$i");
                    $button_background_color = get_theme_mod("mytheme_cta_button_background_color_$i", '#ff6600');
                    $button_text_color = get_theme_mod("mytheme_cta_button_text_color_$i", '#ffffff');
                    $button_icon = get_theme_mod("mytheme_cta_button_icon_$i");

                    if ($button_text && $button_link): ?>
                        <a href="<?php echo esc_url($button_link); ?>" class="cta-button cta-button-<?php echo $i; ?>" style="
        background-color: <?php echo esc_attr($button_background_color); ?>;
        color: <?php echo esc_attr($button_text_color); ?>;">
                            <?php if ($button_icon): ?>
                                <i class="<?php echo esc_attr($button_icon); ?>" aria-hidden="true"></i>
                            <?php endif; ?>
                            <?php echo esc_html($button_text); ?>
                        </a>
                    <?php endif;
                endfor; ?>
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