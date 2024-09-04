<?php
if (function_exists('register_block_pattern')) {
    register_block_pattern(
        'mytheme/cover-section',
        array(
            'title'       => __('メインビューセクション', 'mytheme'),
            'description' => _x('画像背景に画像とテキストが横並びのヒーローセクション', 'Block pattern description', 'mytheme'),
            'content'     => '
<!-- wp:cover {"url":"https://tokoton02.xsrv.jp/images/zen01.jpg","id":123,"dimRatio":50,"overlayColor":"black","minHeight":600,"contentPosition":"center center","align":"full"} -->
<div class="wp-block-cover alignfull has-custom-content-position is-position-center-center" style="min-height:600px">
    <span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim"></span>
    <img class="wp-block-cover__image-background wp-image-123" alt="" src="https://tokoton02.xsrv.jp/images/zen01.jpg" data-object-fit="cover"/>
    <div class="wp-block-cover__inner-container">
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
        <div class="wp-block-group">
            <!-- wp:columns {"verticalAlignment":"center"} -->
            <div class="wp-block-columns are-vertically-aligned-center">
                <!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
                <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%">
                    <!-- wp:image {"id":124,"sizeSlug":"large","linkDestination":"none"} -->
                    <figure class="wp-block-image size-large"><img src="https://tokoton02.xsrv.jp/images/zen02.jpg" alt="" class="wp-image-124"/></figure>
                    <!-- /wp:image -->
                </div>
                <!-- /wp:column -->

                <!-- wp:column {"verticalAlignment":"center","width":"60%"} -->
                <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%">
                    <!-- wp:heading {"textAlign":"left","level":1,"textColor":"white","fontSize":"large"} -->
                    <h1 class="has-text-align-left has-white-color has-text-color has-large-font-size">ようこそ、私たちのサイトへ</h1>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"align":"left","textColor":"white"} -->
                    <p class="has-text-align-left has-white-color has-text-color">ここに簡単な説明文を入れてください。あなたのサービスや製品の魅力を伝えましょう。</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"vivid-cyan-blue","textColor":"white"} -->
                        <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-vivid-cyan-blue-background-color has-text-color has-background wp-element-button">詳細を見る</a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                </div>
                <!-- /wp:column -->
            </div>
            <!-- /wp:columns -->
        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:cover -->
',
            'categories'  => array('zen'),
        )
    );
}