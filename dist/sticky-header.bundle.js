jQuery(document).ready((function(e){var s=e("#masthead"),t=s.outerHeight();document.documentElement.style.setProperty("--header-height",t+"px");var a=0;e(window).scroll((function(){var t=e(this).scrollTop();t>a&&t>100?(s.addClass("sticky"),e("body").addClass("has-sticky-header")):t<=100&&(s.removeClass("sticky"),e("body").removeClass("has-sticky-header")),a=t}))}));
//# sourceMappingURL=sticky-header.bundle.js.map