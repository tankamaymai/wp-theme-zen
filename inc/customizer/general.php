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
        'title' => __('基本カラー', 'mytheme'),
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


    // サイト全体の背景色
    $wp_customize->add_setting('mytheme_background_color', array(
        'default'   => '#ffffff',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_background_color', array(
        'label'    => __('背景色', 'mytheme'),
        'section'  => 'mytheme_customize_color_settings',
        'settings' => 'mytheme_background_color',

    )));
}
function mytheme_customize_container_settings($wp_customize)
{
    // コンテンツエリア設定セクション
    $wp_customize->add_section('mytheme_container_settings', array(
        'title' => __('コンテンツエリア', 'mytheme'),
        'panel' => 'mytheme_general_panel',
    ));

    // 全体のコンテンツエリア幅設定
    $wp_customize->add_setting('mytheme_container_width', array(
        'default' => '1200',
        'transport' => 'refresh',
        'sanitize_callback' => 'mytheme_sanitize_container_width',
    ));
    $wp_customize->add_control('mytheme_container_width', array(
        'label' => __('コンテンツエリア幅 (px または 100%)', 'mytheme'),
        'section' => 'mytheme_container_settings',
        'type' => 'select',
        'choices' => array(
            '100%' => '100%',
            '1200' => '1200px',
            '1400' => '1400px',
            '1600' => '1600px',
        ),
    ));

    // トップページのコンテンツエリア幅設定
    $wp_customize->add_setting('mytheme_front_page_container_width', array(
        'default' => '1200',
        'transport' => 'refresh',
        'sanitize_callback' => 'mytheme_sanitize_container_width',
    ));
    $wp_customize->add_control('mytheme_front_page_container_width', array(
        'label' => __('トップページのコンテンツエリア幅 (px または 100%)', 'mytheme'),
        'section' => 'mytheme_container_settings',
        'type' => 'select',
        'choices' => array(
            '100%' => '100%',
            '1200' => '1200px',
            '1400' => '1400px',
            '1600' => '1600px',
        ),
    ));

    // 全体のコンテンツエリア内側余白設定
    $wp_customize->add_setting('mytheme_container_padding', array(
        'default' => 'none',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_container_padding', array(
        'label' => __('コンテンツエリア内側余白', 'mytheme'),
        'section' => 'mytheme_container_settings',
        'type' => 'select',
        'choices' => array(
            'none' => __('なし', 'mytheme'),
            'small' => __('小', 'mytheme'),
            'medium' => __('中', 'mytheme'),
            'large' => __('大', 'mytheme'),
        ),
    ));

    // 全体のコンテンツエリア外側余白設定
    $wp_customize->add_setting('mytheme_container_margin', array(
        'default' => 'none',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_container_margin', array(
        'label' => __('コンテンツエリア外側余白', 'mytheme'),
        'section' => 'mytheme_container_settings',
        'type' => 'select',
        'choices' => array(
            'none' => __('なし', 'mytheme'),
            'small' => __('小', 'mytheme'),
            'medium' => __('中', 'mytheme'),
            'large' => __('大', 'mytheme'),
        ),
    ));

    // トップページのコンテンツエリア内側余白設定
    $wp_customize->add_setting('mytheme_front_page_container_padding', array(
        'default' => 'none',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_front_page_container_padding', array(
        'label' => __('トップページのコンテンツエリア内側余白', 'mytheme'),
        'section' => 'mytheme_container_settings',
        'type' => 'select',
        'choices' => array(
            'none' => __('なし', 'mytheme'),
            'small' => __('小', 'mytheme'),
            'medium' => __('中', 'mytheme'),
            'large' => __('大', 'mytheme'),
        ),
    ));

    // トップページのコンテンツエリア外側余白設定
    $wp_customize->add_setting('mytheme_front_page_container_margin', array(
        'default' => 'none',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_front_page_container_margin', array(
        'label' => __('トップページのコンテンツエリア外側余白', 'mytheme'),
        'section' => 'mytheme_container_settings',
        'type' => 'select',
        'choices' => array(
            'none' => __('なし', 'mytheme'),
            'small' => __('小', 'mytheme'),
            'medium' => __('中', 'mytheme'),
            'large' => __('大', 'mytheme'),
        ),
    ));

    // コンテンツエリアの背景色
    $wp_customize->add_setting('mytheme_content_area_background_color', array(
        'default'   => '#ffffff',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_content_area_background_color', array(
        'label'    => __('コンテンツエリアの背景色', 'mytheme'),
        'section'  => 'mytheme_container_settings',
    )));

    // コンテンツエリアの背景を透明にするオプション
    $wp_customize->add_setting('mytheme_content_area_background_transparent', array(
        'default'   => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_content_area_background_transparent', array(
        'label'    => __('コンテンツエリアの背景を透明にする', 'mytheme'),
        'section'  => 'mytheme_container_settings',
        'type'     => 'checkbox',
        'description' => __('コンテンツエリアに背景メディアを使用している場合、このオプションを使用して背景色を透明にできます。', 'mytheme'),
    ));
}


function mytheme_sanitize_container_width($input)
{
    $valid = array(
        '100%' => '100%',
        '1200' => '1200px',
        '1400' => '1400px',
        '1600' => '1600px',
    );

    if (array_key_exists($input, $valid)) {
        return $input;
    }

    return '1200';
}

function mytheme_customize_container_width()
{
    $container_width = get_theme_mod('mytheme_container_width', '1200');
    $front_page_container_width = get_theme_mod('mytheme_front_page_container_width', '1200');
    $container_padding = get_theme_mod('mytheme_container_padding', 'none');
    $container_margin = get_theme_mod('mytheme_container_margin', 'none');
    $front_page_container_padding = get_theme_mod('mytheme_front_page_container_padding', 'none');
    $front_page_container_margin = get_theme_mod('mytheme_front_page_container_margin', 'none');



    // コンテンツエリアの背景色を取得
    $content_area_background_color = get_theme_mod('mytheme_content_area_background_color', '#ffffff');
    $content_area_background_transparent = get_theme_mod('mytheme_content_area_background_transparent', false);

    // コンテンツエリアの背景透明化オプションのチェック
    if ($content_area_background_transparent) {
        $content_area_background_color = 'transparent'; // 透明にする
    }

    if ($container_width !== '100%') {
        $container_width .= 'px'; // 単位を追加
    }
    if ($front_page_container_width !== '100%') {
        $front_page_container_width .= 'px'; // 単位を追加
    }

    // 各設定に対するCSSクラス
    $padding_css = array(
        'none' => 'padding: 0;',
        'small' => 'padding: 40px 40px;',
        'medium' => 'padding: 60px 40px;',
        'large' => 'padding: 80px 40px;',
    );

    $margin_css = array(
        'none' => 'margin: 0 auto;',
        'small' => 'margin: 40px;',
        'medium' => 'margin: 60px;',
        'large' => 'margin: 80px;',
    );

    // 存在チェックとデフォルト値の設定
    $container_padding_css = isset($padding_css[$container_padding]) ? $padding_css[$container_padding] : $padding_css['medium'];
    $container_margin_css = isset($margin_css[$container_margin]) ? $margin_css[$container_margin] : $margin_css['none'];
    $front_page_container_padding_css = isset($padding_css[$front_page_container_padding]) ? $padding_css[$front_page_container_padding] : $padding_css['medium'];
    $front_page_container_margin_css = isset($margin_css[$front_page_container_margin]) ? $margin_css[$front_page_container_margin] : $margin_css['none'];

    $custom_css = "
        #primary {
            max-width: {$container_width};
            background-color: {$content_area_background_color}; /* コンテンツエリアの背景色 */
            {$container_padding_css}
            {$container_margin_css}
        }
        body.home #primary {
            max-width: {$front_page_container_width};
            background-color: {$content_area_background_color}; /* トップページのコンテンツエリアの背景色 */
            {$front_page_container_padding_css}
            {$front_page_container_margin_css}
        }

        @media (max-width: 768px) {
            #primary {
                background-color: {$content_area_background_color}; /* コンテンツエリアの背景色 */
                {$container_padding_css}
                {$container_margin_css}
            }
            body.home #primary {
                background-color: {$content_area_background_color}; /* トップページのコンテンツエリアの背景色 */
                {$front_page_container_padding_css}
                {$front_page_container_margin_css}
            }
        }

        @media (max-width: 480px) {
            #primary {
                background-color: {$content_area_background_color}; /* コンテンツエリアの背景色 */
                {$container_padding_css}
                {$container_margin_css}
            }
            body.home #primary {
                background-color: {$content_area_background_color}; /* トップページのコンテンツエリアの背景色 */
                {$front_page_container_padding_css}
                {$front_page_container_margin_css}
            }
        }
    ";

    wp_add_inline_style('mytheme-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'mytheme_customize_container_width');


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
        'title' => __('背景メディア', 'mytheme'),
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
        'description' => __('サイト全体に適用される背景画像またはビデオを設定できます。ただし動画を使用する場合、サイトが重たくなる他、SEOにも影響しますので注意が必要です。', 'mytheme'),
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
    mytheme_customize_container_settings($wp_customize); // コンテンツエリア設定
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

    // サイト全体の背景色を取得
    $background_color = get_theme_mod('mytheme_background_color', '#ffffff');


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
