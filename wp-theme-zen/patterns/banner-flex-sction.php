<?php
if (function_exists('register_block_pattern')) {
    register_block_pattern(
        'mytheme/banner-flex-section',
        array(
            'title' => __('バナーの横並びのセクション', 'mytheme'),
            'description' => _x('バナーの横並びのセクション', 'Block pattern description', 'mytheme'),
            'content' => '
<!-- wp:group {"className":"flex-section"} -->
<div class="wp-block-group flex-section">
    <div class="wp-block-group__inner-container">
        <!-- wp:heading {"textAlign":"center","level":2,"className":"flex-title"} -->
        <h2 class="has-text-align-center flex-title">Lorem ipsum dolor sit amet</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center","className":"flex-subtitle"} -->
        <p class="has-text-align-center flex-subtitle">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <!-- /wp:paragraph -->

        <!-- wp:columns {"className":"flex-columns"} -->
        <div class="wp-block-columns flex-columns">
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:cover {"url":"https://tokoton02.xsrv.jp/images/zen01.jpg","id":123,"dimRatio":50,"minHeight":300,"contentPosition":"center center","className":"flex-image"} -->
                <div class="wp-block-cover has-background-dim-50 has-background-dim flex-image" style="min-height:300px">
                    <img class="wp-block-cover__image-background wp-image-123" alt="Image 1" src="https://tokoton02.xsrv.jp/images/zen01.jpg" data-object-fit="cover"/>
                    <div class="wp-block-cover__inner-container">
                        <!-- wp:heading {"level":3,"className":"flex-name","textColor":"white"} -->
                        <h3 class="flex-name has-white-color has-text-color">Lorem ipsum dolor sit amet</h3>
                        <!-- /wp:heading -->
                        
                        <!-- wp:paragraph {"className":"flex-text","textColor":"white"} -->
                        <p class="flex-text has-white-color has-text-color">consectetur adipiscing elit</p>
                        <!-- /wp:paragraph -->
                    </div>
                </div>
                <!-- /wp:cover -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:cover {"url":"https://tokoton02.xsrv.jp/images/zen01.jpg","id":124,"dimRatio":50,"minHeight":300,"contentPosition":"center center","className":"flex-image"} -->
                <div class="wp-block-cover has-background-dim-50 has-background-dim flex-image" style="min-height:300px">
                    <img class="wp-block-cover__image-background wp-image-124" alt="Image 2" src="https://tokoton02.xsrv.jp/images/zen01.jpg" data-object-fit="cover"/>
                    <div class="wp-block-cover__inner-container">
                        <!-- wp:heading {"level":3,"className":"flex-name","textColor":"white"} -->
                        <h3 class="flex-name has-white-color has-text-color">Lorem ipsum dolor sit amet</h3>
                        <!-- /wp:heading -->
                        
                        <!-- wp:paragraph {"className":"flex-text","textColor":"white"} -->
                        <p class="flex-text has-white-color has-text-color">consectetur adipiscing elit</p>
                        <!-- /wp:paragraph -->
                    </div>
                </div>
                <!-- /wp:cover -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
</div>
<!-- /wp:group -->
',
            'categories' => array('zen'),
        )
    );
}