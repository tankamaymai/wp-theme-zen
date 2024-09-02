<?php
if (function_exists('register_block_pattern')) {
    register_block_pattern(
        'mytheme/hero-section',
        array(
            'title'       => __('ヒーローセクション', 'mytheme'),
            'description' => _x('A hero section with a cover image and a call to action.', 'Block pattern description', 'mytheme'),
            'content'     => '
<!-- wp:cover {"url":"https://tokoton02.xsrv.jp/images/zen01.jpg","dimRatio":50,"overlayColor":"black","minHeight":600,"align":"full"} -->
<div class="wp-block-cover alignfull" style="min-height:600px">
<span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-50 has-background-dim"></span>
<img class="wp-block-cover__image-background" alt="" src="https://tokoton02.xsrv.jp/images/zen01.jpg"/>
<div class="wp-block-cover__inner-container">
<!-- wp:heading {"textAlign":"center","level":1,"textColor":"white"} -->
<h1 class="has-text-align-center has-white-color has-text-color">キャッチフレーズをここに入力</h1>
<!-- /wp:heading -->
</div>
</div>
<!-- /wp:cover -->
',
            'categories'  => array('zen'),
        )
    );
}

