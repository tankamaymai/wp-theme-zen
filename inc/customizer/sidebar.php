<?php
function mytheme_customize_sidebar($wp_customize)
{
    // サイドバー表示設定セクション
    $wp_customize->add_section('mytheme_sidebar_settings', array(
        'title'    => __('サイドバー設定', 'mytheme'),
        'priority' => 10
    ));

    // サイドバー背景色設定
    $wp_customize->add_setting('mytheme_sidebar_background_color', array(
        'default'   => '#ffffff',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_sidebar_background_color', array(
        'label'    => __('サイドバーの背景色', 'mytheme'),
        'section'  => 'mytheme_sidebar_settings',
        'settings' => 'mytheme_sidebar_background_color',
    )));

    // トップページサイドバー表示設定
    $wp_customize->add_setting('mytheme_display_sidebar_front_page', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_display_sidebar_front_page', array(
        'type'     => 'checkbox',
        'section'  => 'mytheme_sidebar_settings',
        'label'    => __('トップページでサイドバーを表示する', 'mytheme'),
        // 'description' => __('トップページでサイドバーを表示するかどうかを設定します。', 'mytheme'),
    ));

    // 固定ページサイドバー表示設定
    $wp_customize->add_setting('mytheme_display_sidebar_page', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_display_sidebar_page', array(
        'type'     => 'checkbox',
        'section'  => 'mytheme_sidebar_settings',
        'label'    => __('固定ページでサイドバーを表示する', 'mytheme'),
        'description' => __('トップページ以外の固定ページでサイドバーを表示するかどうかを設定します。', 'mytheme'),
    ));

    // ブログ記事ページサイドバー表示設定
    $wp_customize->add_setting('mytheme_display_sidebar_post', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_display_sidebar_post', array(
        'type'     => 'checkbox',
        'section'  => 'mytheme_sidebar_settings',
        'label'    => __('ブログページでサイドバーを表示する', 'mytheme'),
        // 'description' => __('ブログページでサイドバーを表示するかどうかを設定します。', 'mytheme'),
    ));
}

add_action('customize_register', 'mytheme_customize_sidebar');

function mytheme_customize_sidebar_styles()
{
    $sidebar_bg_color = get_theme_mod('mytheme_sidebar_background_color', '#ffffff');
    $custom_css = "#secondary { background-color: {$sidebar_bg_color}; }";
    wp_add_inline_style('mytheme-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'mytheme_customize_sidebar_styles');
