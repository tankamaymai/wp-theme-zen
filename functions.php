<?php
function my_custom_theme_update_check($checked_data)
{
    // 現在有効なテーマが子テーマであっても親テーマの更新をチェック
    $theme_data = wp_get_theme(get_template());  // 親テーマの情報を取得
    $theme_slug = $theme_data->get_stylesheet();
    $theme_version = $theme_data->get('Version');

    $request = wp_remote_get('https://wpzen.jp/assets/update-info.json');

    if (is_wp_error($request) || wp_remote_retrieve_response_code($request) != 200) {
        return $checked_data;
    }

    $response = json_decode(wp_remote_retrieve_body($request), true);

    if (version_compare($theme_version, $response['version'], '<')) {
        $checked_data->response[$theme_slug] = array(
            'theme'       => $theme_slug,
            'new_version' => $response['version'],
            'url'         => $response['url'],
            'package'     => $response['download_link'],
        );
    }

    return $checked_data;
}
add_filter('pre_set_site_transient_update_themes', 'my_custom_theme_update_check');


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
    // コンテンツ幅の変更
      // @content-with.js の読み込み
      wp_enqueue_script(
        'block-type',
        get_template_directory_uri() . '/dist/content-with.bundle.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-compose'),
        filemtime(get_template_directory() . '/dist/content-with.bundle.js'),
        true
    );

    // @responsive.js の読み込み
    wp_enqueue_script(
        'responsive',
        get_template_directory_uri() . '/dist/responsive.bundle.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-data', 'wp-compose'),
        filemtime(get_template_directory() . '/dist/responsive.bundle.js'),
        true
    );

    // フォントサイズ変更のツールバー機能を追加するJavaScript
    wp_enqueue_script(
        'mytheme-toolbar-text-resize',
        get_template_directory_uri() . '/dist/toolbar-text-resize.bundle.js',
        array('wp-blocks', 'wp-element', 'wp-editor'),
        filemtime(get_template_directory() . '/dist/toolbar-text-resize.bundle.js'),
        true
    );

    // 一時的に使用不可能にしている
    // カスタムマージンとパディングの機能を追加するJavaScript
    // wp_enqueue_script(
    //     'custom-block-margin-padding',
    //     get_template_directory_uri() . '/dist/custom-block-margin-padding.bundle.js',
    //     array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components'),
    //     filemtime(get_template_directory() . '/dist/custom-block-margin-padding.bundle.js'),
    //     true
    // );

    // カスタムブロックのCSS
    wp_enqueue_style(
        'mytheme-custom-blocks-style',
        get_template_directory_uri() . '/blocks/editor-style.css', // 必要に応じてエディタ用のスタイルを追加
        array(),
        filemtime(get_template_directory() . '/blocks/editor-style.css')
    );

    // Font Awesome
    wp_enqueue_style('font-awesome-editor', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

    // テーマディレクトリのURLをJavaScriptに渡す
    wp_localize_script(
        'custom-block-margin-padding',
        'myThemeData',
        array(
            'themeUrl' => get_template_directory_uri(), // テーマのURLを渡す
        )
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
function mytheme_custom_header_widget_styles()
{
    $custom_css = "
    
        #header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #header-top .header-widget-column {
            flex: 1;
        }
        #header-top .header-widget-column-1 {
            text-align: left;
        }
        #header-top .header-widget-column-2 {
            text-align: center;
        }
        #header-top .header-widget-column-3 {
            text-align: right;
        }

          #header-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #header-bottom .header-widget-column {
            flex: 1;
            
        }
        #header-bottom .header-widget-column-1 {
            text-align: left;
        }
        #header-bottom .header-widget-column-2 {
            text-align: center;
        }
        #header-bottom .header-widget-column-3 {
            text-align: right;
        }
            
    ";
    wp_add_inline_style('mytheme-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'mytheme_custom_header_widget_styles');

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
require get_template_directory() . '/inc/customizer/floating-button.php';


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


function my_theme_seo_meta_tags()
{
    if (is_single() || is_page()) {
        global $post;
        $meta_title = get_post_meta($post->ID, 'meta_title', true);
        $meta_description = get_post_meta($post->ID, 'meta_description', true);

        // タイトルタグ
        if ($meta_title) {
            echo "<title>$meta_title</title>\n";
        } else {
            // メタタイトルが設定されていない場合、デフォルトのタイトルを使用
            echo "<title>" . get_the_title($post->ID) . "</title>\n";
        }

        // メタディスクリプション
        if ($meta_description) {
            echo "<meta name='description' content='$meta_description'>\n";
        }
    }
}
add_action('wp_head', 'my_theme_seo_meta_tags');

function add_seo_meta_box()
{
    add_meta_box(
        'seo_meta_box',
        'SEO設定',
        'display_seo_meta_box',
        ['post', 'page'],  // 'post'と'page'の両方にメタボックスを追加
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_seo_meta_box');

function display_seo_meta_box($post)
{
    $meta_title = get_post_meta($post->ID, 'meta_title', true);
    $meta_description = get_post_meta($post->ID, 'meta_description', true);
    echo 'メタタイトル:<br> <input type="text" name="meta_title" value="' . esc_attr($meta_title) . '" size="100" /><br><br>';
    echo 'メタディスクリプション:<br> <textarea name="meta_description" rows="5" cols="80" style="width:100%;">' . esc_textarea($meta_description) . '</textarea>';
}


function save_seo_meta_box($post_id)
{
    if (isset($_POST['meta_title'])) {
        update_post_meta($post_id, 'meta_title', sanitize_text_field($_POST['meta_title']));
    }
    if (isset($_POST['meta_description'])) {
        update_post_meta($post_id, 'meta_description', sanitize_text_field($_POST['meta_description']));
    }
}
add_action('save_post', 'save_seo_meta_box');


function my_theme_structured_data()
{
    if (is_single()) {
        global $post;
        $structured_data = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => get_the_title(),
            'author' => [
                '@type' => 'Person',
                'name' => get_the_author()
            ],
            'datePublished' => get_the_date('c'),
            'image' => get_the_post_thumbnail_url()
        ];
        echo '<script type="application/ld+json">' . json_encode($structured_data) . '</script>';
    }
}
add_action('wp_head', 'my_theme_structured_data');


function generate_sitemap()
{
    $posts = get_posts(['numberposts' => -1, 'post_type' => 'post', 'post_status' => 'publish']);
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
    $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($posts as $post) {
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . get_permalink($post->ID) . '</loc>';
        $sitemap .= '<lastmod>' . get_the_modified_date('c', $post->ID) . '</lastmod>';
        $sitemap .= '</url>';
    }
    $sitemap .= '</urlset>';
    file_put_contents(ABSPATH . 'sitemap.xml', $sitemap);
}
add_action('publish_post', 'generate_sitemap');

function my_theme_social_meta_tags()
{
    if (is_single() || is_page()) {
        global $post;
        $meta_title = get_post_meta($post->ID, 'meta_title', true);
        $meta_description = get_post_meta($post->ID, 'meta_description', true);
        $title = $meta_title ? $meta_title : get_the_title($post->ID);
        $description = $meta_description ? $meta_description : get_the_excerpt($post->ID);
        $image = get_the_post_thumbnail_url($post->ID);

        echo "<meta property='og:title' content='$title'>\n";
        echo "<meta property='og:description' content='$description'>\n";
        echo "<meta property='og:image' content='$image'>\n";
        echo "<meta name='twitter:card' content='summary_large_image'>\n";
        echo "<meta name='twitter:title' content='$title'>\n";
        echo "<meta name='twitter:description' content='$description'>\n";
        echo "<meta name='twitter:image' content='$image'>\n";
    }
}
add_action('wp_head', 'my_theme_social_meta_tags');


function add_custom_css_js_meta_box()
{
    add_meta_box(
        'custom_css_js_meta_box', // ID
        'カスタムCSSとJS', // タイトル
        'show_custom_css_js_meta_box', // コールバック関数
        array('post', 'page'), // 投稿タイプ
        'normal', // コンテキスト
        'default' // 優先度を'high'から'default'に変更
    );
}
add_action('add_meta_boxes', 'add_custom_css_js_meta_box');

function show_custom_css_js_meta_box($post)
{
    $custom_css = get_post_meta($post->ID, '_custom_css', true);
    $custom_js = get_post_meta($post->ID, '_custom_js', true);

    wp_nonce_field('save_custom_css_js_meta_box', 'custom_css_js_nonce');
?>
    <p>
        <label for="custom_css">カスタムCSS:</label>
        <textarea id="custom_css" name="custom_css" rows="10" cols="30" style="width:100%;"><?php echo esc_textarea($custom_css); ?></textarea>
    </p>
    <p>
        <label for="custom_js">カスタムJS:</label>
        <textarea id="custom_js" name="custom_js" rows="10" cols="30" style="width:100%;"><?php echo esc_textarea($custom_js); ?></textarea>
    </p>
<?php
}

function save_custom_css_js_meta_box($post_id)
{
    if (!isset($_POST['custom_css_js_nonce']) || !wp_verify_nonce($_POST['custom_css_js_nonce'], 'save_custom_css_js_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['custom_css'])) {
        update_post_meta($post_id, '_custom_css', sanitize_text_field($_POST['custom_css']));
    }

    if (isset($_POST['custom_js'])) {
        update_post_meta($post_id, '_custom_js', sanitize_text_field($_POST['custom_js']));
    }
}
add_action('save_post', 'save_custom_css_js_meta_box');

function enqueue_custom_css_js()
{
    if (is_singular()) {
        global $post;
        $custom_css = get_post_meta($post->ID, '_custom_css', true);
        $custom_js = get_post_meta($post->ID, '_custom_js', true);

        if (!empty($custom_css)) {
            wp_add_inline_style('mytheme-style', $custom_css); // テーマのスタイルハンドルを使用
        }

        if (!empty($custom_js)) {
            wp_add_inline_script('mytheme-script', $custom_js); // テーマのスクリプトハンドルを使用
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_css_js');

// アイコンピッカーの読み込み
function mytheme_enqueue_icon_picker_scripts()
{
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
    wp_enqueue_script('icon-picker', get_template_directory_uri() . '/js/icon-picker.js', array('jquery', 'customize-controls'), '1.0', true);
    wp_enqueue_style('icon-picker', get_template_directory_uri() . '/css/icon-picker.css');
}
add_action('customize_controls_enqueue_scripts', 'mytheme_enqueue_icon_picker_scripts');



// カスタムメタボックスを追加 固定ページのタイトルの表示、非表示設定
function mytheme_add_page_title_meta_box()
{
    add_meta_box(
        'mytheme_page_title_display',
        __('ページタイトル表示設定', 'mytheme'),
        'mytheme_page_title_meta_box_callback',
        'page',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'mytheme_add_page_title_meta_box');

// メタボックスの内容
function mytheme_page_title_meta_box_callback($post)
{
    wp_nonce_field('mytheme_page_title_meta_box', 'mytheme_page_title_meta_box_nonce');
    $value = get_post_meta($post->ID, '_mytheme_show_page_title', true);
?>
    <p>
        <input type="checkbox" id="mytheme_show_page_title" name="mytheme_show_page_title" value="on" <?php checked($value, 'on'); ?> />
        <label for="mytheme_show_page_title"><?php _e('ページタイトルを表示する', 'mytheme'); ?></label>
    </p>
<?php
}

// メタボックスの値を保存
function mytheme_save_page_title_meta_box_data($post_id)
{
    if (
        !isset($_POST['mytheme_page_title_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['mytheme_page_title_meta_box_nonce'], 'mytheme_page_title_meta_box') ||
        defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ||
        !current_user_can('edit_post', $post_id)
    ) {
        return;
    }

    $show_title = isset($_POST['mytheme_show_page_title']) ? 'on' : 'off';
    update_post_meta($post_id, '_mytheme_show_page_title', $show_title);
}
add_action('save_post', 'mytheme_save_page_title_meta_box_data');

// CSSを追加してタイトルの表示・非表示を制御
function mytheme_page_title_visibility_css()
{
    if (is_page()) {
        $post_id = get_the_ID();
        $show_title = get_post_meta($post_id, '_mytheme_show_page_title', true);
        if ($show_title === 'off') {
            echo '<style>.entry-header { display: none; }</style>';
        }
    }
}
add_action('wp_head', 'mytheme_page_title_visibility_css');


// JavaScriptを使ってメタボックスをデフォルトで閉じる
function close_meta_box_by_default()
{
?>
    <script>
        jQuery(document).ready(function($) {
            $('#custom_css_js_meta_box').addClass('closed'); // メタボックスのIDを使用して閉じる
        });
    </script>
<?php
}
add_action('admin_footer', 'close_meta_box_by_default');





