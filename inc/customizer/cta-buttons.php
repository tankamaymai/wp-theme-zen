<?php

function mytheme_customize_register_cta($wp_customize)
{
    // セクションを追加
    $wp_customize->add_section('mytheme_cta_buttons', array(
        'title' => __('CTAボタン', 'mytheme'),
        'description' => __('ヘッダーに最大3つのCTAボタンを追加します。', 'mytheme'),
        'priority' => 30,
    ));

    // CTAボタンの個数
    $wp_customize->add_setting('mytheme_cta_button_count', array(
        'default' => 1,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('mytheme_cta_button_count', array(
        'label' => __('CTAボタンの数', 'mytheme'),
        'section' => 'mytheme_cta_buttons',
        'type' => 'select',
        'choices' => array(
            1 => __('1', 'mytheme'),
            2 => __('2', 'mytheme'),
            3 => __('3', 'mytheme'),
        ),
    ));

    // デフォルトアイコンの配列
    $default_icons = array(
        1 => 'fas fa-envelope',
        2 => 'fas fa-phone',
        3 => 'fas fa-comment',
    );

    for ($i = 1; $i <= 3; $i++) {
        // 見出しを追加
        $wp_customize->add_setting("mytheme_cta_button_heading_$i", array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(new Customize_Heading_Control(
            $wp_customize,
            "mytheme_cta_button_heading_$i",
            array(
                'label' => __("CTAボタン $i 設定", 'mytheme'),
                'section' => 'mytheme_cta_buttons',
                'active_callback' => function () use ($i) {
                    return get_theme_mod('mytheme_cta_button_count', 1) >= $i;
                }
            )
        ));

        // ボタンテキストの設定
        $wp_customize->add_setting("mytheme_cta_button_text_$i", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control("mytheme_cta_button_text_$i", array(
            'label' => __("CTAボタン $i のテキスト", 'mytheme'),
            'section' => 'mytheme_cta_buttons',
            'type' => 'text',
            'active_callback' => function () use ($i) {
                return get_theme_mod('mytheme_cta_button_count', 1) >= $i;
            },
        ));

        // ボタンリンクの設定
        $wp_customize->add_setting("mytheme_cta_button_link_$i", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control("mytheme_cta_button_link_$i", array(
            'label' => __("CTAボタン $i のリンク", 'mytheme'),
            'section' => 'mytheme_cta_buttons',
            'type' => 'url',
            'active_callback' => function () use ($i) {
                return get_theme_mod('mytheme_cta_button_count', 1) >= $i;
            },
        ));

        // ボタン背景色の設定
        $wp_customize->add_setting("mytheme_cta_button_background_color_$i", array(
            'default' => '#ff6600',
            'sanitize_callback' => 'sanitize_hex_color',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            "mytheme_cta_button_background_color_$i",
            array(
                'label' => __("CTAボタン $i の背景色", 'mytheme'),
                'section' => 'mytheme_cta_buttons',
                'active_callback' => function () use ($i) {
                    return get_theme_mod('mytheme_cta_button_count', 1) >= $i;
                },
            )
        ));

        // ボタン文字色の設定
        $wp_customize->add_setting("mytheme_cta_button_text_color_$i", array(
            'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            "mytheme_cta_button_text_color_$i",
            array(
                'label' => __("CTAボタン $i の文字色", 'mytheme'),
                'section' => 'mytheme_cta_buttons',
                'active_callback' => function () use ($i) {
                    return get_theme_mod('mytheme_cta_button_count', 1) >= $i;
                },
            )
        ));

        // ボタンアイコンの設定
        $wp_customize->add_setting("mytheme_cta_button_icon_$i", array(
            'default' => $default_icons[$i],
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control("mytheme_cta_button_icon_$i", array(
            'label' => __("CTAボタン $i のアイコン (Font Awesomeクラス名)", 'mytheme'),
            'section' => 'mytheme_cta_buttons',
            'type' => 'text',
            'description' => __('例: fas fa-envelope', 'mytheme'),
            'active_callback' => function () use ($i) {
                return get_theme_mod('mytheme_cta_button_count', 1) >= $i;
            },
        ));
    }
}

add_action('customize_register', 'mytheme_customize_register_cta');
