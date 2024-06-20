<?php
function mytheme_customize_main_visual($wp_customize)
{
    // スライダー設定セクションの追加
    $wp_customize->add_section('mytheme_slider_settings', array(
        'title'    => __('スライダー設定', 'mytheme'),
        'priority' => 25,
    ));

    // スライダーの表示・非表示の設定
    $wp_customize->add_setting('mytheme_display_slider', array(
        'default'   => true,  // デフォルトではスライダーを表示
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mytheme_display_slider', array(
        'label'    => __('スライダーを表示', 'mytheme'),
        'section'  => 'mytheme_slider_settings',
        'settings' => 'mytheme_display_slider',
        'type'     => 'checkbox',  // チェックボックスとして表示
    )));

    // スライダー画像の設定
    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting("mytheme_slider_image_$i", array(
            'default'   => '',
            'transport' => 'refresh',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "mytheme_slider_image_$i", array(
            'label'    => __("スライダー画像 $i", 'mytheme'),
            'section'  => 'mytheme_slider_settings',
            'settings' => "mytheme_slider_image_$i",
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
?>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                <?php $img_url = get_theme_mod("mytheme_slider_image_$i");
                if ($img_url) : ?>
                    <div class="swiper-slide">
                        <img src="<?php echo esc_url($img_url); ?>" alt="Slide <?php echo $i; ?>">
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
        jQuery(document).ready(function($) {
            var swiper = new Swiper('.swiper-container', {
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
                    delay: 5000,
                },
            });
        });
    </script>
<?php
}
