<?php

function mytheme_secure_headers()
{
    remove_action('wp_head', 'wp_generator'); // WordPressバージョンの非表示
}

add_action('init', 'mytheme_secure_headers');

function mytheme_setup()
{
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('title-tag');
    add_theme_support('custom-logo');

    // 投稿とコメントのRSSフィードリンクを<head>に追加
    add_theme_support('automatic-feed-links');

    // 投稿のサムネイルを有効化
    add_theme_support('post-thumbnails');

    // 投稿形式のサポートを追加
    add_theme_support('post-formats', array('aside', 'gallery'));

    register_nav_menus(array(
        'global_menu' => 'グローバルメニュー',
        'footer_menu' => 'フッターメニュー',
    ));
}

add_action('after_setup_theme', 'mytheme_setup');

function mytheme_enqueue_styles()
{
    // Swiper CSS
    wp_enqueue_style('swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

    // Swiper JS
    wp_enqueue_script('swiper-script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11', true);

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

    // 他のスタイルシート
    wp_enqueue_style('normalize-style', get_template_directory_uri() . '/css/normalize.css');
    wp_enqueue_style('mytheme-style', get_stylesheet_uri());
    wp_enqueue_script('mytheme-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');

function mytheme_enqueue_scripts()
{
    wp_enqueue_script('menu-toggle', get_template_directory_uri() . '/js/menu-toggle.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

function mytheme_enqueue_block_editor_assets()
{
    // カスタムブロックのJavaScript
    wp_enqueue_script(
        'mytheme-custom-blocks',
        get_template_directory_uri() . '/dist/custom-blocks.bundle.js',
        array('wp-blocks', 'wp-element', 'wp-editor'),
        filemtime(get_template_directory() . '/dist/custom-blocks.bundle.js'),
        true
    );

    // カスタムブロックのCSS
    wp_enqueue_style(
        'mytheme-custom-blocks-style',
        get_template_directory_uri() . '/blocks/editor-style.css', // 必要に応じてエディタ用のスタイルを追加
        array(),
        filemtime(get_template_directory() . '/blocks/editor-style.css')
    );
}
add_action('enqueue_block_editor_assets', 'mytheme_enqueue_block_editor_assets');

function mytheme_enqueue_frontend_assets()
{
    // フロントエンド用のスクリプトとスタイル
    wp_enqueue_script(
        'mytheme-blocks-frontend',
        get_template_directory_uri() . '/dist/blocks.bundle.js',
        array(),
        filemtime(get_template_directory() . '/dist/blocks.bundle.js'),
        true
    );

    wp_enqueue_style(
        'mytheme-blocks-frontend-style',
        get_template_directory_uri() . '/blocks/frontend-style.css', // 必要に応じてフロントエンド用のスタイルを追加
        array(),
        filemtime(get_template_directory() . '/blocks/frontend-style.css')
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_frontend_assets');


function mytheme_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('サイドバー', 'mytheme'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'mytheme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // ウィジェットエリアのラベル
    $labels = [
        'header-top-widget-area-1' => __('ヘッダー上ウィジェットエリア 左', 'mytheme'),
        'header-top-widget-area-2' => __('ヘッダー上ウィジェットエリア 中央', 'mytheme'),
        'header-top-widget-area-3' => __('ヘッダー上ウィジェットエリア 右', 'mytheme'),
        'header-bottom-widget-area-1' => __('ヘッダー下ウィジェットエリア 左', 'mytheme'),
        'header-bottom-widget-area-2' => __('ヘッダー下ウィジェットエリア 中央', 'mytheme'),
        'header-bottom-widget-area-3' => __('ヘッダー下ウィジェットエリア 右', 'mytheme'),
        'footer-widget-area-1' => __('フッターウィジェットエリア 左', 'mytheme'),
        'footer-widget-area-2' => __('フッターウィジェットエリア 中央', 'mytheme'),
        'footer-widget-area-3' => __('フッターウィジェットエリア 右', 'mytheme')
    ];

    // ウィジェットエリアの登録
    foreach ($labels as $id => $label) {
        register_sidebar(array(
            'name'          => $label,
            'id'            => $id,
            'description'   => $label,
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
    }
}

add_action('widgets_init', 'mytheme_widgets_init');

// カスタム投稿タイプ用のファイルをインクルード
require get_template_directory() . '/inc/custom-post-types.php';
require get_template_directory() . '/inc/customizer/class-customize-heading-control.php';

// カスタマイザー設定ファイルの読み込み
require get_template_directory() . '/inc/customizer/general.php';
require get_template_directory() . '/inc/customizer/header-builder.php';
require get_template_directory() . '/inc/customizer/main-visual.php';
require get_template_directory() . '/inc/customizer/breadcrumbs.php';
require get_template_directory() . '/inc/customizer/blog.php';
require get_template_directory() . '/inc/customizer/pages.php';
require get_template_directory() . '/inc/customizer/sidebar.php';
require get_template_directory() . '/inc/customizer/footer-builder.php';
require get_template_directory() . '/inc/customizer/cta-buttons.php';
require get_template_directory() . '/blocks.php';

// 選択的リフレッシュのサポートを追加
add_theme_support('customize-selective-refresh-widgets');

function mytheme_customize_register($wp_customize)
{
    // サイトタイトルの部分リフレッシュ
    $wp_customize->selective_refresh->add_partial('blogname', array(
        'selector' => '.site-title a',
        'render_callback' => function () {
            bloginfo('name');
        },
    ));

    // タグラインの部分リフレッシュ
    $wp_customize->selective_refresh->add_partial('blogdescription', array(
        'selector' => '.site-description',
        'render_callback' => function () {
            bloginfo('description');
        },
    ));

    // ウィジェットエリアのショートカット設定
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->selective_refresh->add_partial("sidebar-widgets-header-top-widget-area-$i", array(
            'selector' => "#header-top .header-widget-column-$i",
            'render_callback' => function () use ($i) {
                dynamic_sidebar('header-top-widget-area-' . $i);
            },
        ));
        $wp_customize->selective_refresh->add_partial("sidebar-widgets-header-bottom-widget-area-$i", array(
            'selector' => "#header-bottom .header-widget-column-$i",
            'render_callback' => function () use ($i) {
                dynamic_sidebar('header-bottom-widget-area-' . $i);
            },
        ));
    }
}

add_action('customize_register', 'mytheme_customize_register');

function mytheme_default_theme_mods()
{
    $defaults = array(
        'mytheme_footer_copyright' => '©2024 WP ZEN',
    );

    foreach ($defaults as $key => $value) {
        if (get_theme_mod($key, null) === null) {
            set_theme_mod($key, $value);
        }
    }
}

add_action('after_switch_theme', 'mytheme_default_theme_mods');

function mytheme_register_block_pattern_categories()
{
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category(
            'zen',
            array('label' => __('ZEN', 'mytheme'))
        );
    }
}

add_action('init', 'mytheme_register_block_pattern_categories');

function mytheme_register_block_patterns()
{
    $pattern_files = glob(get_template_directory() . '/patterns/*.php');
    foreach ($pattern_files as $file) {
        require $file;
    }
}

add_action('init', 'mytheme_register_block_patterns');

// カスタマイザーのカスタムスタイルを追加
function mytheme_customizer_styles()
{
    wp_enqueue_style('customizer-css', get_template_directory_uri() . '/css/admin-customizer.css');
}
add_action('customize_controls_enqueue_scripts', 'mytheme_customizer_styles');
