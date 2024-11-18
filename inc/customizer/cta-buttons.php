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
            0 => __('なし', 'mytheme'),
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

        // ボタンテキストサイズの設定を追加
        $wp_customize->add_setting("mytheme_cta_button_text_size_$i", array(
            'default' => '16',
            'sanitize_callback' => 'absint',
        ));

        $wp_customize->add_control("mytheme_cta_button_text_size_$i", array(
            'label' => __("CTAボタン $i のテキストサイズ (px)", 'mytheme'),
            'section' => 'mytheme_cta_buttons',
            'type' => 'number',
            'input_attrs' => array(
                'min' => 8,
                'max' => 30,
                'step' => 1,
            ),
            'active_callback' => function () use ($i) {
                return get_theme_mod('mytheme_cta_button_count', 1) >= $i;
            },
        ));
        // スマートフォン用のボタンテキストサイズの設定を追加
    $wp_customize->add_setting("mytheme_cta_button_text_size_mobile_$i", array(
        'default' => '12',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control("mytheme_cta_button_text_size_mobile_$i", array(
        'label' => __("CTAボタン $i のテキストサイズ (SP用, px)", 'mytheme'),
        'section' => 'mytheme_cta_buttons',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 8,
            'max' => 30,
        ),
        'active_callback' => function () use ($i) {
            return get_theme_mod('mytheme_cta_button_count', 1) >= $i;
        },
    ));

        // ボタンアイコンの設定
        $wp_customize->add_setting("mytheme_cta_button_icon_$i", array(
            'default' => $default_icons[$i],
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize,
            "mytheme_cta_button_icon_$i",
            array(
                'label' => __("CTAボタン $i のアイコン", 'mytheme'),
                'section' => 'mytheme_cta_buttons',
                'type' => 'text',
                'input_attrs' => array(
                    'class' => 'icon-picker',
                    'data-target' => "mytheme_cta_button_icon_$i",
                ),
                'description' => '<a href="#" class="button icon-picker-button">' . __('アイコン一覧はこちら', 'mytheme') . '</a>',
                'active_callback' => function () use ($i) {
                    return get_theme_mod('mytheme_cta_button_count', 1) >= $i;
                },
            )
        ));

        // アイコンのみ表示オプションを追加
        $wp_customize->add_setting("mytheme_cta_button_icon_only_$i", array(
            'default' => false,
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("mytheme_cta_button_icon_only_$i", array(
            'label' => __("CTAボタン $i をアイコンのみで表示", 'mytheme'),
            'section' => 'mytheme_cta_buttons',
            'type' => 'checkbox',
            'active_callback' => function () use ($i) {
                return get_theme_mod('mytheme_cta_button_count', 1) >= $i;
            },
        ));

        // ボタンの表示設定（PC、タブレット、モバイル）
        $wp_customize->add_setting("mytheme_cta_button_visible_pc_$i", array(
            'default' => true,
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("mytheme_cta_button_visible_pc_$i", array(
            'label' => __("CTAボタン $i をPCで表示", 'mytheme'),
            'section' => 'mytheme_cta_buttons',
            'type' => 'checkbox',
            'active_callback' => function () use ($i) {
                return get_theme_mod('mytheme_cta_button_count', 1) >= $i;
            },
        ));

        $wp_customize->add_setting("mytheme_cta_button_visible_tablet_$i", array(
            'default' => false,
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("mytheme_cta_button_visible_tablet_$i", array(
            'label' => __("CTAボタン $i をタブレットで表示", 'mytheme'),
            'section' => 'mytheme_cta_buttons',
            'type' => 'checkbox',
            'active_callback' => function () use ($i) {
                return get_theme_mod('mytheme_cta_button_count', 1) >= $i;
            },
        ));

        $wp_customize->add_setting("mytheme_cta_button_visible_mobile_$i", array(
            'default' => false,
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("mytheme_cta_button_visible_mobile_$i", array(
            'label' => __("CTAボタン $i をモバイルで表示", 'mytheme'),
            'section' => 'mytheme_cta_buttons',
            'type' => 'checkbox',
            'active_callback' => function () use ($i) {
                return get_theme_mod('mytheme_cta_button_count', 1) >= $i;
            },
        ));
    }
}

add_action('customize_register', 'mytheme_customize_register_cta');

function mytheme_customizer_defaults()
{
    $defaults = array(
        'mytheme_cta_button_count' => 1,
        'mytheme_cta_button_icon_1' => 'fas fa-envelope',
        'mytheme_cta_button_icon_2' => 'fas fa-phone',
        'mytheme_cta_button_icon_3' => 'fas fa-comment',
    );

    foreach ($defaults as $key => $value) {
        if (get_theme_mod($key) === false) {
            set_theme_mod($key, $value);
        }
    }
}
add_action('after_setup_theme', 'mytheme_customizer_defaults');

function mytheme_customize_cta_styles()
{
    $cta_button_count = get_theme_mod('mytheme_cta_button_count', 1);
    $button_width = 180; // 1つのボタンの基本幅
    $button_margin = 10; // ボタン間の余白
    $total_width = $cta_button_count * ($button_width + $button_margin); // 全体の幅を計算
    $custom_css = "";
 // CTAボタンの表示/非表示の制御
 $custom_css .= "
        .header-cta-buttons {
            display: " . ($cta_button_count > 0 ? 'flex' : 'none') . ";
            " . ($cta_button_count > 0 ? "
                width: {$total_width}px;
                max-width: 100%;
                justify-content: space-between;
                gap: {$button_margin}px;
            " : "") . "
        }
    ";
      // レスポンシブ対応
      $custom_css .= "
      @media (max-width: 768px) {
          .header-cta-buttons {
              width: 100%;
              justify-content: " . ($cta_button_count > 1 ? 'end' : 'end') . ";
              gap: 0px;

          }
      }
  ";
// 既存のCTAボタンのスタイル設定
    for ($i = 1; $i <= $cta_button_count; $i++) {
        $button_visible_pc = get_theme_mod("mytheme_cta_button_visible_pc_$i", true);
        $button_visible_tablet = get_theme_mod("mytheme_cta_button_visible_tablet_$i", false);
        $button_visible_mobile = get_theme_mod("mytheme_cta_button_visible_mobile_$i", false);
        $icon_only = get_theme_mod("mytheme_cta_button_icon_only_$i", false);
        $background_color = get_theme_mod("mytheme_cta_button_background_color_$i", '#ff6600');
        $text_color = get_theme_mod("mytheme_cta_button_text_color_$i", '#ffffff');
        $text_size = get_theme_mod("mytheme_cta_button_text_size_$i", '16');
        $text_size_mobile = get_theme_mod("mytheme_cta_button_text_size_mobile_$i", '12');

        $custom_css .= "
            .header-cta-buttons .cta-button.cta-button-$i {
                display: " . ($button_visible_pc ? 'flex' : 'none') . ";
                align-items: center;
                justify-content: center;
                max-width: 180px;
                width: 100%;
                background-color: $background_color;
                color: $text_color;
                font-size: {$text_size}px;
                " . ($icon_only ? 'height: 100%;' : '') . "
            }

            .header-cta-buttons .cta-button.cta-button-$i .cta-button-icon {
                display: " . ($icon_only || !empty(get_theme_mod("mytheme_cta_button_icon_$i", '')) ? 'inline-block' : 'none') . ";
                " . ($icon_only ? 'height: 100%; display: flex; align-items: center; justify-content: center;' : '') . "
            }
            .header-cta-buttons .cta-button.cta-button-$i .cta-button-text {
                display: " . ($icon_only ? 'none' : 'inline-block') . ";
                 width: 100%;
            }
            @media (max-width: 768px) {
                .header-cta-buttons .cta-button.cta-button-$i {
                    display: " . ($button_visible_tablet ? 'flex' : 'none') . ";
                    width: 100%;
                    max-width: 70px;
                    font-size: {$text_size_mobile}px;
                }
            }
            @media (max-width: 480px) {
                .header-cta-buttons .cta-button.cta-button-$i {
                    display: " . ($button_visible_mobile ? 'flex' : 'none') . ";
                    width: 100%;
                    max-width: 70px;
                     " . ($cta_button_count == 3 ? 'max-width: 70px;' : '') . "
                }
            }
        ";
    }
    // // CTAボタンが3つの場合、親要素にフレックスボックスを適用
    // if ($cta_button_count == 3) {
    //     $custom_css .= "
    //         .header-cta-buttons {
    //             display: flex;
    //             justify-content: space-between;
    //         }
    //     ";
    // }
    wp_add_inline_style('mytheme-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'mytheme_customize_cta_styles');