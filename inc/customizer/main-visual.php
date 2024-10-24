<?php
function mytheme_customize_main_visual($wp_customize)
{
    // ロゴサイズの設定
$wp_customize->add_setting('mytheme_logo_width', array(
    'default' => '200',
    'transport' => 'refresh',
    'sanitize_callback' => 'absint', // 整数値のサニタイズ
));

$wp_customize->add_control('mytheme_logo_width', array(
    'label' => __('ロゴの幅 (px)', 'mytheme'),
    'section' => 'title_tagline', // 既存の「サイト基本情報」セクションに追加
    'type' => 'number',
    'input_attrs' => array(
        'min' => 50,
        'max' => 500,
        'step' => 1,
    ),
));
    // スライダー設定セクションの追加
    $wp_customize->add_section('mytheme_slider_settings', array(
        'title' => __('スライダー設定', 'mytheme'),
        'priority' => 25,
    ));

    // スライダーの表示・非表示の設定
    $wp_customize->add_setting('mytheme_display_slider', array(
        'default' => true,  // デフォルトではスライダーを表示
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mytheme_display_slider', array(
        'label' => __('スライダーを表示', 'mytheme'),
        'section' => 'mytheme_slider_settings',
        'settings' => 'mytheme_display_slider',
        'type' => 'checkbox',  // チェックボックスとして表示
    )));
    // スライドエフェクトの設定
    $wp_customize->add_setting('mytheme_slider_effect', array(
        'default' => 'slide',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('mytheme_slider_effect', array(
        'label' => __('スライドエフェクト', 'mytheme'),
        'section' => 'mytheme_slider_settings',
        'type' => 'select',
        'choices' => array(
            'slide' => __('スライド', 'mytheme'),
            'fade' => __('フェード', 'mytheme'),
            'fade-zoom' => __('ズーム＆フェード', 'mytheme'),
            'coverflow' => __('カバーフロー', 'mytheme'),
            'cube' => __('キューブ', 'mytheme'),
        ),
    ));


    // スライダー画像の設定
    $default_images = array(
        'https://wpzen.jp/assets/images/sample01.jpg',
        'https://wpzen.jp/assets/images/sample02.jpg',
        'https://wpzen.jp/assets/images/sample03.jpg',
        'https://wpzen.jp/assets/images/sample04.jpg',
        'https://wpzen.jp/assets/images/sample05.jpg',
    );
    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting("mytheme_slider_image_$i", array(
            'default' => $default_images[$i - 1],
            'transport' => 'refresh',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "mytheme_slider_image_$i", array(
            'label' => __("スライダー画像 $i", 'mytheme'),
            'section' => 'mytheme_slider_settings',
            'settings' => "mytheme_slider_image_$i",
        )));

        // キャッチコピーの設定
        $wp_customize->add_setting("mytheme_slider_catchphrase_$i", array(
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("mytheme_slider_catchphrase_$i", array(
            'label' => __("キャッチコピー $i", 'mytheme'),
            'section' => 'mytheme_slider_settings',
            'type' => 'text',
        ));

        // ボディコピーの設定
        $wp_customize->add_setting("mytheme_slider_bodycopy_$i", array(
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("mytheme_slider_bodycopy_$i", array(
            'label' => __("ボディコピー $i", 'mytheme'),
            'section' => 'mytheme_slider_settings',
            'type' => 'textarea',
        ));

        // テキストの位置設定
        $wp_customize->add_setting("mytheme_slider_catchphrase_position_$i", array(
            'default' => 'center',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("mytheme_slider_catchphrase_position_$i", array(
            'label' => __("テキストの位置 $i", 'mytheme'),
            'section' => 'mytheme_slider_settings',
            'type' => 'select',
            'choices' => array(
                'left' => __('左', 'mytheme'),
                'center' => __('中央', 'mytheme'),
                'right' => __('右', 'mytheme'),
            ),
        ));


        // キャッチコピーの文字サイズ設定
        $wp_customize->add_setting("mytheme_slider_catchphrase_font_size_$i", array(
            'default' => 'x-large',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("mytheme_slider_catchphrase_font_size_$i", array(
            'label' => __("キャッチコピーの文字サイズ $i", 'mytheme'),
            'section' => 'mytheme_slider_settings',
            'type' => 'select',
            'choices' => array(
                'small' => __('小', 'mytheme'),
                'medium' => __('中', 'mytheme'),
                'large' => __('大', 'mytheme'),
                'x-large' => __('特大', 'mytheme'),
            ),
        ));

        // ボディコピーの文字サイズ設定
        $wp_customize->add_setting("mytheme_slider_bodycopy_font_size_$i", array(
            'default' => 'medium',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("mytheme_slider_bodycopy_font_size_$i", array(
            'label' => __("ボディコピーの文字サイズ $i", 'mytheme'),
            'section' => 'mytheme_slider_settings',
            'type' => 'select',
            'choices' => array(
                'small' => __('小', 'mytheme'),
                'medium' => __('中', 'mytheme'),
                'large' => __('大', 'mytheme'),
            ),
        ));

        // キャッチコピーの文字色設定
        $wp_customize->add_setting("mytheme_slider_catchphrase_color_$i", array(
            'default' => '#ffffff',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "mytheme_slider_catchphrase_color_$i", array(
            'label' => __("キャッチコピーの文字色 $i", 'mytheme'),
            'section' => 'mytheme_slider_settings',
            'settings' => "mytheme_slider_catchphrase_color_$i",
        )));

        // ボディコピーの文字色設定
        $wp_customize->add_setting("mytheme_slider_bodycopy_color_$i", array(
            'default' => '#ffffff',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "mytheme_slider_bodycopy_color_$i", array(
            'label' => __("ボディコピーの文字色 $i", 'mytheme'),
            'section' => 'mytheme_slider_settings',
            'settings' => "mytheme_slider_bodycopy_color_$i",
        )));

        // テキストの背景色設定
        $wp_customize->add_setting("mytheme_slider_text_background_color_$i", array(
            'default' => '#333333',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "mytheme_slider_text_background_color_$i", array(
            'label' => __("テキストの背景色 $i", 'mytheme'),
            'section' => 'mytheme_slider_settings',
            'settings' => "mytheme_slider_text_background_color_$i",
        )));
    }
}

add_action('customize_register', 'mytheme_customize_main_visual');



function mytheme_display_swiper()
{
    // カスタマイザーでスライダーの表示が無効にされている場合は、何も表示しない
    if (!get_theme_mod('mytheme_display_slider', true)) {
        return;
    }

    $default_images = array(
        'https://wpzen.jp/assets/images/sample01.jpg',
        'https://wpzen.jp/assets/images/sample02.jpg',
        'https://wpzen.jp/assets/images/sample03.jpg',
        'https://wpzen.jp/assets/images/sample04.jpg',
        'https://wpzen.jp/assets/images/sample05.jpg',
    );

    // フォントサイズのクラスを取得
    function get_font_size_class($size)
    {
        switch ($size) {
            case 'small':
                return 'font-size-small';
            case 'medium':
                return 'font-size-medium';
            case 'large':
                return 'font-size-large';
            case 'x-large':
                return 'font-size-x-large';
            default:
                return 'font-size-medium';
        }
    }


    ?>
    <div class="swiper swiper-container">
        <div class="swiper-wrapper">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <?php
                $img_url = get_theme_mod("mytheme_slider_image_$i", $default_images[$i - 1]);
                $catchphrase = get_theme_mod("mytheme_slider_catchphrase_$i", '');
                $bodycopy = get_theme_mod("mytheme_slider_bodycopy_$i", '');
                $position = get_theme_mod("mytheme_slider_catchphrase_position_$i", 'center');
                $catchphrase_font_size = get_theme_mod("mytheme_slider_catchphrase_font_size_$i", 'x-large');
                $bodycopy_font_size = get_theme_mod("mytheme_slider_bodycopy_font_size_$i", 'medium');
                $catchphrase_color = get_theme_mod("mytheme_slider_catchphrase_color_$i", '#ffffff');
                $bodycopy_color = get_theme_mod("mytheme_slider_bodycopy_color_$i", '#ffffff');
                $text_background_color = get_theme_mod("mytheme_slider_text_background_color_$i", '#333333');
                if ($img_url): ?>
                    <div class="swiper-slide">
                        <img src="<?php echo esc_url($img_url); ?>" alt="Slide <?php echo $i; ?>" loading="lazy">
                        <?php if ($catchphrase || $bodycopy): ?>
                            <div class="slider-text slider-text-<?php echo $position; ?>"
                                style="background-color: <?php echo esc_attr($text_background_color); ?>;">
                                <?php if ($catchphrase): ?>
                                    <h2 class="slider-catchphrase <?php echo get_font_size_class($catchphrase_font_size); ?>"
                                        style="color: <?php echo esc_attr($catchphrase_color); ?>;">
                                        <?php echo esc_html($catchphrase); ?>
                                    </h2>
                                <?php endif; ?>
                                <?php if ($bodycopy): ?>
                                    <p class="slider-bodycopy <?php echo get_font_size_class($bodycopy_font_size); ?>"
                                        style="color: <?php echo esc_attr($bodycopy_color); ?>;">
                                        <?php echo esc_html($bodycopy); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <script>
jQuery(document).ready(function ($) {
    var effect = '<?php echo get_theme_mod('mytheme_slider_effect', 'slide'); ?>';
    var swiperOptions = {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: effect === 'fade-zoom' ? 6500 : 5000,
        },
        effect: effect === 'fade-zoom' ? 'fade' : effect
    };

    if (effect === 'fade' || effect === 'fade-zoom') {
        swiperOptions.fadeEffect = {
            crossFade: true
        };
        swiperOptions.speed = 1500; // 1.5秒でフェード
    } else if (effect === 'coverflow') {
        swiperOptions.coverflowEffect = {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        };
        swiperOptions.speed = 1500;
    } else if (effect === 'cube') {
        swiperOptions.cubeEffect = {
            shadow: true,
            slideShadows: true,
            shadowOffset: 20,
            shadowScale: 0.94,
        };
        swiperOptions.speed = 1500;
    }

    var swiper = new Swiper('.swiper-container', swiperOptions);

    if (effect === 'fade-zoom') {
        function zoomSlide(slide) {
            var img = slide.querySelector('img');
            img.style.transition = 'transform 5s ease-out';
            img.style.transform = 'scale(1.1)';
        }

        function resetZoom(slide) {
            var img = slide.querySelector('img');
            img.style.transition = 'none';
            img.style.transform = 'scale(1)';
        }

        // 初期スライドのズーム
        zoomSlide(swiper.slides[swiper.activeIndex]);

        swiper.on('slideChangeTransitionStart', function () {
            zoomSlide(swiper.slides[swiper.activeIndex]);
        });

        swiper.on('slideChangeTransitionEnd', function () {
            resetZoom(swiper.slides[swiper.previousIndex]);
        });
    }
});
</script>
    <?php
}
