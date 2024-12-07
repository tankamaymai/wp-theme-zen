<?php
function mytheme_customize_header($wp_customize)
{
    // ヘッダー設定パネル
    $wp_customize->add_panel('mytheme_header_panel', array(
        'title' => __('ヘッダー設定', 'mytheme'),
        'priority' => 20,
    ));

    // メインヘッダーセクション
    $wp_customize->add_section('mytheme_main_header_section', array(
        'title' => __('メインヘッダー', 'mytheme'),
        'panel' => 'mytheme_header_panel',  // パネルに属する
        'priority' => 10,
    ));

    // ヘッダー上セクション
    $wp_customize->add_section('mytheme_header_top_section', array(
        'title' => __('ヘッダー上', 'mytheme'),
        'panel' => 'mytheme_header_panel',  // パネルに属する
        'priority' => 20,
    ));

    // ヘッダー下セクション
    $wp_customize->add_section('mytheme_header_bottom_section', array(
        'title' => __('ヘッダー下', 'mytheme'),
        'panel' => 'mytheme_header_panel',  // パネルに属する
        'priority' => 30,
    ));

    // ヘッダー上表示設定
    $wp_customize->add_setting('mytheme_header_top_visible_pc', array(
        'default' => true,
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('mytheme_header_top_visible_tablet', array(
        'default' => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('mytheme_header_top_visible_mobile', array(
        'default' => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_header_top_visible_pc', array(
        'label' => __('PCで表示', 'mytheme'),
        'section' => 'mytheme_header_top_section',
        'type' => 'checkbox',
    ));
    $wp_customize->add_control('mytheme_header_top_visible_tablet', array(
        'label' => __('タブレットで表示', 'mytheme'),
        'section' => 'mytheme_header_top_section',
        'type' => 'checkbox',
    ));
    $wp_customize->add_control('mytheme_header_top_visible_mobile', array(
        'label' => __('スマホで表示', 'mytheme'),
        'section' => 'mytheme_header_top_section',
        'type' => 'checkbox',
    ));

    // ヘッダー上ウィジェットエリアリンク
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'header_top_widgets_link', array(
        'label' => '', // ボタンのラベルを空にする
        'section' => 'mytheme_header_top_section',
        'settings' => array(),
        'type' => 'hidden',
        'description' => '<a href="#" onclick="wp.customize.panel(\'widgets\').focus(); return false;">' . __('ウィジェットを編集', 'mytheme') . '</a>',
    )));

    // ヘッダー下表示設定
    $wp_customize->add_setting('mytheme_header_bottom_visible_pc', array(
        'default' => true,
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('mytheme_header_bottom_visible_tablet', array(
        'default' => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('mytheme_header_bottom_visible_mobile', array(
        'default' => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_header_bottom_visible_pc', array(
        'label' => __('PCで表示', 'mytheme'),
        'section' => 'mytheme_header_bottom_section',
        'type' => 'checkbox',
    ));
    $wp_customize->add_control('mytheme_header_bottom_visible_tablet', array(
        'label' => __('タブレットで表示', 'mytheme'),
        'section' => 'mytheme_header_bottom_section',
        'type' => 'checkbox',
    ));
    $wp_customize->add_control('mytheme_header_bottom_visible_mobile', array(
        'label' => __('スマホで表示', 'mytheme'),
        'section' => 'mytheme_header_bottom_section',
        'type' => 'checkbox',
    ));
    // ヘッダー下ウィジェットエリアリンク
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'header_bottom_widgets_link', array(
        'label' => '', // ボタンのラベルを空にする
        'section' => 'mytheme_header_bottom_section',
        'settings' => array(),
        'type' => 'hidden',
        'description' => '<a href="#" onclick="wp.customize.panel(\'widgets\').focus(); return false;">' . __('ウィジェットを編集', 'mytheme') . '</a>',
    )));

    // メインヘッダーの背景色と文字色設定
    $wp_customize->add_setting('mytheme_main_header_section_background_color', array(
        'default' => '#333333',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_main_header_section_background_color', array(
        'label' => __('メインヘッダー背景色', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'settings' => 'mytheme_main_header_section_background_color',
    )));
    // ここから新しく設置するメインヘッダーの透明化設定
    $wp_customize->add_setting('mytheme_main_header_transparent', array(
        'default' => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_main_header_transparent', array(
        'label' => __('メインヘッダーを透明にする', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('mytheme_main_header_section_text_color', array(
        'default' => '#ffffff',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_main_header_section_text_color', array(
        'label' => __('メインヘッダー文字色', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'settings' => 'mytheme_main_header_section_text_color',
    )));

    // 追従ヘッダーpcの設定を追加
    $wp_customize->add_setting('mytheme_sticky_header_enabled_pc', array(
        'default' => true,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('mytheme_sticky_header_enabled_pc', array(
        'label' => __('追従ヘッダー(PC)を有効にする', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'type' => 'checkbox',
    ));
    // スマートフォン用追従ヘッダー設定
    $wp_customize->add_setting('mytheme_sticky_header_enabled_sp', array(
        'default' => false,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('mytheme_sticky_header_enabled_sp', array(
        'label' => __('追従ヘッダー(スマートフォン)を有効にする', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'type' => 'checkbox',
    ));
    // 追従ヘッダーの背景色設定

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_sticky_header_background_color', array(
        'label' => __('追従ヘッダーの背景色', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'settings' => 'mytheme_sticky_header_background_color',
    )));

    // メインヘッダーセクションに透過設定を追加
    $wp_customize->add_setting('mytheme_header_transparency', array(
        'default' => false,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('mytheme_header_transparency', array(
        'label' => __('追従ヘッダーを透過させる', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('mytheme_header_transparency_opacity', array(
        'default' => '0.8',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('mytheme_header_transparency_opacity', array(
        'label' => __('透過度（0.1から1.0）', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 0.1,
            'max' => 1.0,
            'step' => 0.1,
        ),
    ));

    // スマホメニューボタンの色設定
    $wp_customize->add_setting('mytheme_hamburger_menu_color', array(
        'default' => '#ffffff',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_control($wp_customize, 'mytheme_hamburger_menu_color', array(
        'label' => __('スマホメニューのボタンの色', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'settings' => 'mytheme_hamburger_menu_color',
    )));
    // スマホメニューボタンの下のテキスト設定
    $wp_customize->add_setting('mytheme_hamburger_menu_text', array(
        'default' => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_hamburger_menu_text', array(
        'label' => __('スマホメニューボタンの下のテキスト', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'type' => 'text',
        'description' => __('5文字以内推奨', 'mytheme'),
    ));

    // スマホメニューボタンの下のテキストの色設定
    $wp_customize->add_setting('mytheme_hamburger_menu_subtext_color', array(
        'default' => '#ffffff',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_hamburger_menu_subtext_color', array(
        'label' => __('スマホメニューボタンの下のテキストの色', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'settings' => 'mytheme_hamburger_menu_subtext_color',
    )));

    // スマホメニューボタンの下のテキストのフォントサイズ設定
    $wp_customize->add_setting('mytheme_hamburger_menu_subtext_font_size', array(
        'default' => '14',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_hamburger_menu_subtext_font_size', array(
        'label' => __('スマホメニューボタンの下のテキストのフォントサイズ（px）', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 10,
            'max' => 30,
            'step' => 1,
        ),
    ));

    // スマホメニューの背景色設定
    $wp_customize->add_setting('mytheme_hamburger_menu_background_color', array(
        'default' => '#ffffff',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_hamburger_menu_background_color', array(
        'label' => __('スマホメニュー背景色', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'settings' => 'mytheme_hamburger_menu_background_color',
    )));

    // スマホメニューの文字色設定
    $wp_customize->add_setting('mytheme_hamburger_menu_text_color', array(
        'default' => '#333333',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_hamburger_menu_text_color', array(
        'label' => __('スマホメニュー文字色', 'mytheme'),
        'section' => 'mytheme_main_header_section',
        'settings' => 'mytheme_hamburger_menu_text_color',
    )));


    add_action('wp_enqueue_scripts', 'mytheme_sticky_header_scripts');
    // ヘッダー上の背景色と文字色設定
    $wp_customize->add_setting('mytheme_header_top_section_background_color', array(
        'default' => '#444444',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_header_top_section_background_color', array(
        'label' => __('ヘッダー上背景色', 'mytheme'),
        'section' => 'mytheme_header_top_section',
        'settings' => 'mytheme_header_top_section_background_color',
    )));
    $wp_customize->add_setting('mytheme_header_top_section_text_color', array(
        'default' => '#eeeeee',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_header_top_section_text_color', array(
        'label' => __('ヘッダー上文字色', 'mytheme'),
        'section' => 'mytheme_header_top_section',
        'settings' => 'mytheme_header_top_section_text_color',
    )));

    // ヘッダー下の背景色と文字色設定
    $wp_customize->add_setting('mytheme_header_bottom_section_background_color', array(
        'default' => '#555555',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_header_bottom_section_background_color', array(
        'label' => __('ヘッダー下背景色', 'mytheme'),
        'section' => 'mytheme_header_bottom_section',
        'settings' => 'mytheme_header_bottom_section_background_color',
    )));
    $wp_customize->add_setting('mytheme_header_bottom_section_text_color', array(
        'default' => '#dddddd',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_header_bottom_section_text_color', array(
        'label' => __('ヘッダー下文字色', 'mytheme'),
        'section' => 'mytheme_header_bottom_section',
        'settings' => 'mytheme_header_bottom_section_text_color',
    )));
}

add_action('customize_register', 'mytheme_customize_header');

function mytheme_customize_header_styles()
{
    // ヘッダーの背景色と文字色設定の取得
    $main_header_bg_color = get_theme_mod('mytheme_main_header_section_background_color', '#333333');
    $main_header_text_color = get_theme_mod('mytheme_main_header_section_text_color', '#ffffff');
    $header_top_bg_color = get_theme_mod('mytheme_header_top_section_background_color', '#444444');
    $header_top_text_color = get_theme_mod('mytheme_header_top_section_text_color', '#eeeeee');
    $header_bottom_bg_color = get_theme_mod('mytheme_header_bottom_section_background_color', '#555555');
    $header_bottom_text_color = get_theme_mod('mytheme_header_bottom_section_text_color', '#dddddd');
    $hamburger_menu_color = get_theme_mod('mytheme_hamburger_menu_color', '#ffffff');
    $hamburger_menu_background_color = get_theme_mod('mytheme_hamburger_menu_background_color', '#ffffff');
    $hamburger_menu_text_color = get_theme_mod('mytheme_hamburger_menu_text_color', '#333333');
    // 透過設定の取得
    $header_transparency = get_theme_mod('mytheme_header_transparency', false);
    $header_opacity = get_theme_mod('mytheme_header_transparency_opacity', '0.8');
    // HEXカラーコードをRGBAに変換する関数
    function hex2rgba($color, $opacity = false)
    {
        $default = 'rgb(0,0,0)';

        if (empty($color))
            return $default;

        if ($color[0] == '#') {
            $color = substr($color, 1);
        }

        if (strlen($color) == 6) {
            $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif (strlen($color) == 3) {
            $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return $default;
        }

        $rgb = array_map('hexdec', $hex);

        if ($opacity !== false) {
            return 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
        }

        return 'rgb(' . implode(",", $rgb) . ')';
    }
    $header_top_visible_pc = get_theme_mod('mytheme_header_top_visible_pc', true);
    $header_top_visible_tablet = get_theme_mod('mytheme_header_top_visible_tablet', false);
    $header_top_visible_mobile = get_theme_mod('mytheme_header_top_visible_mobile', false);
    $header_bottom_visible_pc = get_theme_mod('mytheme_header_bottom_visible_pc', true);
    $header_bottom_visible_tablet = get_theme_mod('mytheme_header_bottom_visible_tablet', false);
    $header_bottom_visible_mobile = get_theme_mod('mytheme_header_bottom_visible_mobile', false);
    $hamburger_menu_text = get_theme_mod('mytheme_hamburger_menu_text', '');
    $hamburger_menu_class = !empty($hamburger_menu_text) ? 'has-subtext' : '';

    $custom_css = "
        #masthead {
        background-color: {$main_header_bg_color};
            color: {$main_header_text_color};
        }
        #masthead.pc-navigation a {
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
   

        /* スマホメニューボタンの下のテキスト */
        .hamburger-menu-text {
    margin-top: 5px;
    display: inline-block;
    position: absolute;
    left: 50%;
    top: 70%;
    transform: translate(-50%, -50%);
    width: 100%;
    text-align: center;
        }

        .has-subtext.menu-icon {
            display: block;
            width: 27px;
            height: 3px;
            position: relative;
            top: -11px;
        }
            .has-subtext.menu-icon::before{
            width: 27px;
            top: -10px;
        }
        .has-subtext.menu-icon::after{
            width: 27px;
            top: 10px;
        }
    ";
    // 透過設定が有効な場合のCSS追加
    if ($header_transparency) {
        $transparency_css = "
            #masthead.sticky {
                background-color: " . hex2rgba($main_header_bg_color, $header_opacity) . ";
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }
            #header-top.sticky {
                background-color: " . hex2rgba($header_top_bg_color, $header_opacity) . ";
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }
            #header-bottom.sticky {
                background-color: " . hex2rgba($header_bottom_bg_color, $header_opacity) . ";
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }
        ";
        $custom_css .= $transparency_css;
    }
    // 新しく追加するメインヘッダーの透明設定
    $main_header_transparent = get_theme_mod('mytheme_main_header_transparent', false);

    // 新しく追加するメインヘッダーの透明設定
    $main_header_transparent = get_theme_mod('mytheme_main_header_transparent', false);

    if ($main_header_transparent) {
        $main_transparency_css = "
               #masthead {
                   background-color: transparent;
                   position: fixed;
                   width: 100%;
                   top: 0;
                   left: 0;
                   z-index: 1000;
               }
               .background-media {
                   margin-top: " . get_header_height() . "px;
               }
               #masthead.pc-navigation a {
                   color: {$main_header_text_color};
               }
           ";
        $custom_css .= $main_transparency_css;
    }

    wp_add_inline_style('mytheme-style', $custom_css);


}
function get_header_height() {
    // ヘッダーの高さを設定（例: 80px）
    return 80;
}

add_action('wp_enqueue_scripts', 'mytheme_customize_header_styles');

