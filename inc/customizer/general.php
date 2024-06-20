<?php
// 全般設定用の関数
function mytheme_customize_general_panel($wp_customize)
{
    $wp_customize->add_panel('mytheme_general_panel', array(
        'title' => __('全般設定', 'mytheme'),
        'description' => __('全般的なテーマ設定を行います。', 'mytheme'),
        'priority' => 10,
    ));
}

// フォント設定用の関数
function mytheme_customize_fonts_section($wp_customize)
{
    $wp_customize->add_section('mytheme_fonts', array(
        'title' => __('フォント', 'mytheme'),
        'panel' => 'mytheme_general_panel',
    ));
    $wp_customize->add_setting('mytheme_body_font', array(
        'default' => 'default',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_body_font', array(
        'type' => 'select',
        'label' => __('本文フォント', 'mytheme'),
        'section' => 'mytheme_fonts',
        'choices' => array(
            'default' => 'デフォルト',
            'sans-serif' => 'Sans Serif',
            'serif' => 'Serif',
        ),
    ));
}

function mytheme_customize_color_settings($wp_customize)
{
    // 色設定セクション
    $wp_customize->add_section('mytheme_customize_color_settings', array(
        'title' => __('カラー', 'mytheme'),
        'panel' => 'mytheme_general_panel',
    ));

    // サイト全体のテキストカラー
    $wp_customize->add_setting('mytheme_text_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_text_color', array(
        'label'    => __('テキスト', 'mytheme'),
        'section'  => 'mytheme_customize_color_settings',
        'settings' => 'mytheme_text_color',
    )));

    // 見出しカラー
    $wp_customize->add_setting('mytheme_heading_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_heading_color', array(
        'label'    => __('見出し', 'mytheme'),
        'section'  => 'mytheme_customize_color_settings',
        'settings' => 'mytheme_heading_color',
    )));

    // 背景色
    $wp_customize->add_setting('mytheme_background_color', array(
        'default'   => '#eeeeee',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_background_color', array(
        'label'    => __('背景色', 'mytheme'),
        'section'  => 'mytheme_customize_color_settings',
        'settings' => 'mytheme_background_color',
    )));

    // リンクカラー
    $wp_customize->add_setting('mytheme_link_color', array(
        'default'   => '#0000FF',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label'    => __('リンク', 'mytheme'),
        'section'  => 'mytheme_customize_color_settings',
        'settings' => 'mytheme_link_color',
    )));
}

function mytheme_customize_container_settings($wp_customize)
{
    // コンテナ設定セクション
    $wp_customize->add_section('mytheme_container_settings', array(
        'title' => __('コンテナ', 'mytheme'),
        'panel' => 'mytheme_general_panel',
    ));
    $wp_customize->add_setting('mytheme_container_width', array(
        'default' => '1200px',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_container_width', array(
        'label' => __('コンテナ幅', 'mytheme'),
        'section' => 'mytheme_container_settings',
        'type' => 'text',
    ));
}

function mytheme_customize_button_settings($wp_customize)
{
    // ボタン設定セクション
    $wp_customize->add_section('mytheme_button_settings', array(
        'title' => __('ボタン', 'mytheme'),
        'panel' => 'mytheme_general_panel',
    ));

    // ボタンの背景色設定
    $wp_customize->add_setting('mytheme_button_background_color', array(
        'default' => '#0073aa',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_button_background_color', array(
        'label' => __('ボタンの背景色', 'mytheme'),
        'section' => 'mytheme_button_settings',
    )));

    // ボタンのテキスト色設定
    $wp_customize->add_setting('mytheme_button_text_color', array(
        'default'   => '#ffffff',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_button_text_color', array(
        'label'    => __('ボタンのテキスト色', 'mytheme'),
        'section'  => 'mytheme_button_settings',
        'settings' => 'mytheme_button_text_color',
    )));
}


function mytheme_customize_top_scroll_settings($wp_customize)
{
    // トップスクロールボタン設定セクション
    $wp_customize->add_section('mytheme_top_scroll_settings', array(
        'title' => __('トップスクロールボタン', 'mytheme'),
        'panel' => 'mytheme_general_panel',
    ));
    $wp_customize->add_setting('mytheme_top_scroll_button', array(
        'default' => true,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_top_scroll_button', array(
        'label' => __('トップスクロールボタンを表示', 'mytheme'),
        'section' => 'mytheme_top_scroll_settings',
        'type' => 'checkbox',
    ));
}

function mytheme_customize_background_section($wp_customize)
{
    // 背景設定セクション
    $wp_customize->add_section('mytheme_background_settings', array(
        'title' => __('背景メディア（非推奨）', 'mytheme'),
        'panel' => 'mytheme_general_panel',
        'priority' => 300,
    ));

    // 背景メディア設定
    $wp_customize->add_setting('mytheme_background_media', array(
        'default' => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'mytheme_background_media_control', array(
        'label' => __('背景画像または動画', 'mytheme'),
        'description' => __('サイト全体に適用される背景画像またはビデオを設定できます。ただしサイトが重たくなることで表示速度が遅くなります。SEOにも影響しますのでおすすめ致しません。', 'mytheme'),
        'section' => 'mytheme_background_settings',
        'settings' => 'mytheme_background_media',
        'mime_type' => 'video,image'  // ビデオと画像ファイルのみを選択
    )));
}



// カスタマイザーに関数を追加するアクション
add_action('customize_register', function ($wp_customize) {
    mytheme_customize_general_panel($wp_customize);  // パネルの設定
    mytheme_customize_fonts_section($wp_customize);  // フォントの設定
    mytheme_customize_color_settings($wp_customize); // 色設定
    mytheme_customize_container_settings($wp_customize); // コンテナ設定
    mytheme_customize_button_settings($wp_customize); // ボタン設定
    mytheme_customize_top_scroll_settings($wp_customize); // トップスクロールボタン設定
    mytheme_customize_background_section($wp_customize); // 背景設定
});

function mytheme_general_styles()
{
    // カスタムカラーの取得
    $text_color = get_theme_mod('mytheme_text_color', '#333333');
    $heading_color = get_theme_mod('mytheme_heading_color', '#333333');
    $background_color = get_theme_mod('mytheme_background_color', '#eeeeee');
    $link_color = get_theme_mod('mytheme_link_color', '#0000FF');
    $button_bg_color = get_theme_mod('mytheme_button_background_color', '#0073aa');
    $button_text_color = get_theme_mod('mytheme_button_text_color', '#ffffff');

    // カスタム CSS の適用
    $custom_css = "
        body {
            color: {$text_color};
            background-color: {$background_color};
        }
        a {
            color: {$link_color};
        }
        button, input[type='submit'], input[type='button'] {
            background-color: {$button_bg_color};
            color: {$button_text_color};
        }
        h1, h2, h3, h4, h5, h6 {
            color: {$heading_color};
        }
    ";

    wp_add_inline_style('mytheme-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'mytheme_general_styles');
