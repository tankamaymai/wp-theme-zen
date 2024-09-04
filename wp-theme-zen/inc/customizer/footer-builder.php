<?php
function mytheme_customize_footer($wp_customize)
{
    // フッター設定セクションの追加
    $wp_customize->add_section('mytheme_footer_settings', array(
        'title'    => __('フッター設定', 'mytheme'),
        'priority' => 30
    ));

    // フッターの背景色設定
    $wp_customize->add_setting('mytheme_footer_background_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_footer_background_color', array(
        'label'    => __('フッターの背景色', 'mytheme'),
        'section'  => 'mytheme_footer_settings',
        'settings' => 'mytheme_footer_background_color',
    )));

    // フッターの文字色設定
    $wp_customize->add_setting('mytheme_footer_text_color', array(
        'default'   => '#ffffff',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_footer_text_color', array(
        'label'    => __('フッターの文字色', 'mytheme'),
        'section'  => 'mytheme_footer_settings',
        'settings' => 'mytheme_footer_text_color',
    )));

    // フッターウィジェットエリアの背景色設定
    $wp_customize->add_setting('mytheme_footer_widget_background_color', array(
        'default'   => '#eeeeee',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_footer_widget_background_color', array(
        'label'    => __('フッターウィジェットエリアの背景色', 'mytheme'),
        'section'  => 'mytheme_footer_settings',
        'settings' => 'mytheme_footer_widget_background_color',
    )));

    // フッターウィジェットエリアの文字色設定
    $wp_customize->add_setting('mytheme_footer_widget_text_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_footer_widget_text_color', array(
        'label'    => __('フッターウィジェットエリアの文字色', 'mytheme'),
        'section'  => 'mytheme_footer_settings',
        'settings' => 'mytheme_footer_widget_text_color',
    )));

    // フッターウィジェットエリアリンク
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'footer_widgets_link', array(
        'label'    => '', // ボタンのラベルを空にする
        'section'  => 'mytheme_footer_settings',
        'settings' => array(),
        'type'     => 'hidden',
        'description' => '<a href="#" onclick="wp.customize.panel(\'widgets\').focus(); return false;">' . __('フッターウィジェットエリアを編集', 'mytheme') . '</a>',
    )));

    // フッターコピーライトテキスト設定
    $wp_customize->add_setting('mytheme_footer_copyright', array(
        'default'   => '©2024 WP ZEN',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_footer_copyright', array(
        'label'    => __('コピーライトテキスト', 'mytheme'),
        'section'  => 'mytheme_footer_settings',
        'type'     => 'text',
    ));
}

add_action('customize_register', 'mytheme_customize_footer');

function mytheme_footer_styles()
{
    $footer_bg_color = get_theme_mod('mytheme_footer_background_color', '#333333');
    $footer_text_color = get_theme_mod('mytheme_footer_text_color', '#ffffff');
    $footer_widget_bg_color = get_theme_mod('mytheme_footer_widget_background_color', '#333333');
    $footer_widget_text_color = get_theme_mod('mytheme_footer_widget_text_color', '#ffffff');

    $custom_css = "
        .footer-widgets {
            background-color: {$footer_widget_bg_color};
            color: {$footer_widget_text_color};
        }
        .footer-widgets a {
            color: {$footer_widget_text_color};
        }

        .site-info {
            background-color: {$footer_bg_color};
            color: {$footer_text_color};
        }
        .site-info a {
            color: {$footer_text_color};
        }
    ";
    wp_add_inline_style('mytheme-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'mytheme_footer_styles');
