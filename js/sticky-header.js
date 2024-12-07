jQuery(document).ready(function($) {
    var header = $('#masthead');
    var headerHeight = header.outerHeight();
    document.documentElement.style.setProperty('--header-height', headerHeight + 'px');

    var lastScroll = 0;
    var scrollThreshold = 100; // スクロール開始のしきい値

    $(window).scroll(function() {
        var currentScroll = $(this).scrollTop();

        // スクロール方向を検出
        if (currentScroll > lastScroll && currentScroll > scrollThreshold) {
            // 下スクロール
            header.addClass('sticky');
            $('body').addClass('has-sticky-header');
        } else if (currentScroll <= scrollThreshold) {
            // 上スクロールで最上部付近
            header.removeClass('sticky');
            $('body').removeClass('has-sticky-header');
        }

        lastScroll = currentScroll;
    });
});