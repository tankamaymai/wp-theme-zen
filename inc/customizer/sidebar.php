<?php
function mytheme_customize_sidebar($wp_customize)
{
    $wp_customize->add_section('mytheme_sidebar_settings', array(
        'title'    => __('サイドバー設定', 'mytheme'),
        'priority' => 10
    ));
    $wp_customize->add_setting('mytheme_sidebar_background_color', array(
        'default'   => '#ffffff',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_sidebar_background_color', array(
        'label'    => __('サイドバーの背景色', 'mytheme'),
        'section'  => 'mytheme_sidebar_settings',
        'settings' => 'mytheme_sidebar_background_color',
    )));
}

add_action('customize_register', 'mytheme_customize_sidebar');

function mytheme_customize_sidebar_styles()
{
    $sidebar_bg_color = get_theme_mod('mytheme_sidebar_background_color', '#ffffff');
    $custom_css = "#sidebar { background-color: {$sidebar_bg_color}; }";
    wp_add_inline_style('mytheme-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'mytheme_customize_sidebar_styles');
