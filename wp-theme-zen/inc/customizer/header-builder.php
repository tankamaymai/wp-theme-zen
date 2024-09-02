<?php
function mytheme_customize_header($wp_customize)
{
    // ヘッダー設定パネル
    $wp_customize->add_panel('mytheme_header_panel', array(
        'title'    => __('ヘッダー設定', 'mytheme'),
        'priority' => 20,
    ));

    // メインヘッダーセクション
    $wp_customize->add_section('mytheme_main_header_section', array(
        'title'    => __('メインヘッダー', 'mytheme'),
        'panel'    => 'mytheme_header_panel',  // パネルに属する
        'priority' => 10,
    ));

    // ヘッダー上セクション
    $wp_customize->add_section('mytheme_header_top_section', array(
        'title'    => __('ヘッダー上', 'mytheme'),
        'panel'    => 'mytheme_header_panel',  // パネルに属する
        'priority' => 20,
    ));

    // ヘッダー下セクション
    $wp_customize->add_section('mytheme_header_bottom_section', array(
        'title'    => __('ヘッダー下', 'mytheme'),
        'panel'    => 'mytheme_header_panel',  // パネルに属する
        'priority' => 30,
    ));

    // ヘッダー上表示設定
    $wp_customize->add_setting('mytheme_header_top_visible_pc', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('mytheme_header_top_visible_tablet', array(
        'default'   => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('mytheme_header_top_visible_mobile', array(
        'default'   => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_header_top_visible_pc', array(
        'label'    => __('PCで表示', 'mytheme'),
        'section'  => 'mytheme_header_top_section',
        'type'     => 'checkbox',
    ));
    $wp_customize->add_control('mytheme_header_top_visible_tablet', array(
        'label'    => __('タブレットで表示', 'mytheme'),
        'section'  => 'mytheme_header_top_section',
        'type'     => 'checkbox',
    ));
    $wp_customize->add_control('mytheme_header_top_visible_mobile', array(
        'label'    => __('スマホで表示', 'mytheme'),
        'section'  => 'mytheme_header_top_section',
        'type'     => 'checkbox',
    ));

    // ヘッダー上ウィジェットエリアリンク
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'header_top_widgets_link', array(
        'label'    => '', // ボタンのラベルを空にする
        'section'  => 'mytheme_header_top_section',
        'settings' => array(),
        'type'     => 'hidden',
        'description' => '<a href="#" onclick="wp.customize.panel(\'widgets\').focus(); return false;">' . __('ウィジェットを編集', 'mytheme') . '</a>',
    )));

    // ヘッダー下表示設定
    $wp_customize->add_setting('mytheme_header_bottom_visible_pc', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('mytheme_header_bottom_visible_tablet', array(
        'default'   => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('mytheme_header_bottom_visible_mobile', array(
        'default'   => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_header_bottom_visible_pc', array(
        'label'    => __('PCで表示', 'mytheme'),
        'section'  => 'mytheme_header_bottom_section',
        'type'     => 'checkbox',
    ));
    $wp_customize->add_control('mytheme_header_bottom_visible_tablet', array(
        'label'    => __('タブレットで表示', 'mytheme'),
        'section'  => 'mytheme_header_bottom_section',
        'type'     => 'checkbox',
    ));
    $wp_customize->add_control('mytheme_header_bottom_visible_mobile', array(
        'label'    => __('スマホで表示', 'mytheme'),
        'section'  => 'mytheme_header_bottom_section',
        'type'     => 'checkbox',
    ));
    // ヘッダー下ウィジェットエリアリンク
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'header_bottom_widgets_link', array(
        'label'    => '', // ボタンのラベルを空にする
        'section'  => 'mytheme_header_bottom_section',
            'settings' => array(),
            'type'     => 'hidden',
        'description' => '<a href="#" onclick="wp.customize.panel(\'widgets\').focus(); return false;">' . __('ウィジェットを編集', 'mytheme') . '</a>',
    )));

    // メインヘッダーの背景色と文字色設定
    $wp_customize->add_setting('mytheme_main_header_section_background_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_main_header_section_background_color', array(
        'label'    => __('メインヘッダー背景色', 'mytheme'),
        'section'  => 'mytheme_main_header_section',
        'settings' => 'mytheme_main_header_section_background_color',
    )));
    $wp_customize->add_setting('mytheme_main_header_section_text_color', array(
        'default'   => '#ffffff',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_main_header_section_text_color', array(
        'label'    => __('メインヘッダー文字色', 'mytheme'),
        'section'  => 'mytheme_main_header_section',
        'settings' => 'mytheme_main_header_section_text_color',
    )));

    // スマホメニューボタンの色設定
    $wp_customize->add_setting('mytheme_hamburger_menu_color', array(
        'default'   => '#ffffff',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_control($wp_customize, 'mytheme_hamburger_menu_color', array(
        'label'    => __('スマホメニューのボタンの色', 'mytheme'),
        'section'  => 'mytheme_main_header_section',
        'settings' => 'mytheme_hamburger_menu_color',
    )));

    // スマホメニューの背景色設定
    $wp_customize->add_setting('mytheme_hamburger_menu_background_color', array(
        'default'   => '#ffffff',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_hamburger_menu_background_color', array(
        'label'    => __('スマホメニュー背景色', 'mytheme'),
        'section'  => 'mytheme_main_header_section',
        'settings' => 'mytheme_hamburger_menu_background_color',
    )));

    // スマホメニューの文字色設定
    $wp_customize->add_setting('mytheme_hamburger_menu_text_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_hamburger_menu_text_color', array(
        'label'    => __('スマホメニュー文字色', 'mytheme'),
        'section'  => 'mytheme_main_header_section',
        'settings' => 'mytheme_hamburger_menu_text_color',
    )));

    // ヘッダー上の背景色と文字色設定
    $wp_customize->add_setting('mytheme_header_top_section_background_color', array(
        'default'   => '#444444',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_header_top_section_background_color', array(
        'label'    => __('ヘッダー上背景色', 'mytheme'),
        'section'  => 'mytheme_header_top_section',
        'settings' => 'mytheme_header_top_section_background_color',
    )));
    $wp_customize->add_setting('mytheme_header_top_section_text_color', array(
        'default'   => '#eeeeee',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_header_top_section_text_color', array(
        'label'    => __('ヘッダー上文字色', 'mytheme'),
        'section'  => 'mytheme_header_top_section',
        'settings' => 'mytheme_header_top_section_text_color',
    )));

    // ヘッダー下の背景色と文字色設定
    $wp_customize->add_setting('mytheme_header_bottom_section_background_color', array(
        'default'   => '#555555',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_header_bottom_section_background_color', array(
        'label'    => __('ヘッダー下背景色', 'mytheme'),
        'section'  => 'mytheme_header_bottom_section',
        'settings' => 'mytheme_header_bottom_section_background_color',
    )));
    $wp_customize->add_setting('mytheme_header_bottom_section_text_color', array(
        'default'   => '#dddddd',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_header_bottom_section_text_color', array(
        'label'    => __('ヘッダー下文字色', 'mytheme'),
        'section'  => 'mytheme_header_bottom_section',
        'settings' => 'mytheme_header_bottom_section_text_color',
    )));
}

add_action('customize_register', 'mytheme_customize_header');

function mytheme_customize_header_styles()
{
    $main_header_bg_color = get_theme_mod('mytheme_main_header_section_background_color', '#333333');
    $main_header_text_color = get_theme_mod('mytheme_main_header_section_text_color', '#ffffff');
    $header_top_bg_color = get_theme_mod('mytheme_header_top_section_background_color', '#444444');
    $header_top_text_color = get_theme_mod('mytheme_header_top_section_text_color', '#eeeeee');
    $header_bottom_bg_color = get_theme_mod('mytheme_header_bottom_section_background_color', '#555555');
    $header_bottom_text_color = get_theme_mod('mytheme_header_bottom_section_text_color', '#dddddd');
    $hamburger_menu_color = get_theme_mod('mytheme_hamburger_menu_color', '#ffffff');
    $hamburger_menu_background_color = get_theme_mod('mytheme_hamburger_menu_background_color', '#ffffff');
    $hamburger_menu_text_color = get_theme_mod('mytheme_hamburger_menu_text_color', '#333333');

    $header_top_visible_pc = get_theme_mod('mytheme_header_top_visible_pc', true);
    $header_top_visible_tablet = get_theme_mod('mytheme_header_top_visible_tablet', false);
    $header_top_visible_mobile = get_theme_mod('mytheme_header_top_visible_mobile', false);
    $header_bottom_visible_pc = get_theme_mod('mytheme_header_bottom_visible_pc', true);
    $header_bottom_visible_tablet = get_theme_mod('mytheme_header_bottom_visible_tablet', false);
    $header_bottom_visible_mobile = get_theme_mod('mytheme_header_bottom_visible_mobile', false);

    $custom_css = "
        #masthead {
            background-color: {$main_header_bg_color};
            color: {$main_header_text_color};
        }
        #masthead a {
            color: {$main_header_text_color};
        }
        #header-top {
            background-color: {$header_top_bg_color};
            color: {$header_top_text_color};
        }
        #header-top a {
            color: {$header_top_text_color};
        }
        #header-bottom {
            background-color: {$header_bottom_bg_color};
            color: {$header_bottom_text_color};
        }
        #header-bottom a {
            color: {$header_bottom_text_color};
        }

        .menu-toggle .menu-icon, .menu-toggle .menu-icon::before, .menu-toggle .menu-icon::after {
            background-color: {$hamburger_menu_color};
        }

        .mobile-navigation {
            background-color: {$hamburger_menu_background_color};
        }
        .mobile-navigation .mobile-menu a {
            color: {$hamburger_menu_text_color} !important;
        }

        /* ヘッダー上表示設定 */
        #header-top {
            display: " . ($header_top_visible_pc ? 'flex' : 'none') . ";
        }
        @media (max-width: 1024px) {
            #header-top {
                display: " . ($header_top_visible_tablet ? 'flex' : 'none') . ";
            }
        }
        @media (max-width: 768px) {
            #header-top {
                display: " . ($header_top_visible_mobile ? 'flex' : 'none') . ";
            }
        }

        /* ヘッダー下表示設定 */
        #header-bottom {
            display: " . ($header_bottom_visible_pc ? 'flex' : 'none') . ";
        }
        @media (max-width: 1024px) {
            #header-bottom {
                display: " . ($header_bottom_visible_tablet ? 'flex' : 'none') . ";
            }
        }
        @media (max-width: 768px) {
            #header-bottom {
                display: " . ($header_bottom_visible_mobile ? 'flex' : 'none') . ";
            }
        }
    ";

    wp_add_inline_style('mytheme-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'mytheme_customize_header_styles');
