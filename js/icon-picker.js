jQuery(document).ready(function($) {
    $('.icon-picker-button').on('click', function(e) {
        e.preventDefault();
        const button = $(this);
        const picker = $('<div class="icon-picker-container"></div>');
        const icons = [
            // SNS Icons
            'fab fa-instagram', 'fab fa-twitter', 'fab fa-facebook', 'fab fa-line',
            // Commonly Used Icons
            'fas fa-envelope', 'fas fa-phone', 'fas fa-comment', 'fas fa-user', 'fas fa-home', 'fas fa-cog',
            'fas fa-heart', 'fas fa-star', 'fas fa-search', 'fas fa-trash', 'fas fa-edit', 'fas fa-check',
            'fas fa-times', 'fas fa-plus', 'fas fa-minus', 'fas fa-arrow-up', 'fas fa-arrow-down',
            'fas fa-arrow-left', 'fas fa-arrow-right', 'fas fa-camera', 'fas fa-image', 'fas fa-video',
            'fas fa-music', 'fas fa-play', 'fas fa-pause', 'fas fa-stop', 'fas fa-forward', 'fas fa-backward',
            'fas fa-sync', 'fas fa-download', 'fas fa-upload', 'fas fa-shopping-cart', 'fas fa-credit-card',
            'fas fa-calendar', 'fas fa-clock', 'fas fa-map-marker-alt', 'fas fa-globe', 'fas fa-wifi',
            'fas fa-cloud', 'fas fa-sun', 'fas fa-moon', 'fas fa-car', 'fas fa-bus', 'fas fa-bicycle',
            'fas fa-walking', 'fas fa-heartbeat', 'fas fa-thermometer', 'fas fa-stethoscope', 'fas fa-book',
            'fas fa-bookmark', 'fas fa-paper-plane', 'fas fa-flag', 'fas fa-bell', 'fas fa-envelope-open',
            'fas fa-folder', 'fas fa-file', 'fas fa-print', 'fas fa-clipboard', 'fas fa-share', 'fas fa-link',
            'fas fa-lock', 'fas fa-unlock', 'fas fa-key', 'fas fa-sign-in-alt', 'fas fa-sign-out-alt',
            'fas fa-user-plus', 'fas fa-user-minus', 'fas fa-users', 'fas fa-user-circle', 'fas fa-id-card',
            'fas fa-phone-alt', 'fas fa-laptop', 'fas fa-desktop', 'fas fa-tablet', 'fas fa-mobile-alt',
            'fas fa-microphone', 'fas fa-volume-up', 'fas fa-volume-down', 'fas fa-volume-mute',
            'fas fa-headphones', 'fas fa-battery-full', 'fas fa-battery-half', 'fas fa-battery-empty',
            'fas fa-plug', 'fas fa-lightbulb', 'fas fa-tree', 'fas fa-leaf', 'fas fa-seedling',
            'fas fa-shopping-bag', 'fas fa-gift', 'fas fa-wallet', 'fas fa-piggy-bank', 'fas fa-handshake',
            'fas fa-comment-alt', 'fas fa-comments', 'fas fa-smile', 'fas fa-frown'
        ]; // アイコンリストを拡張してください

        icons.forEach(function(icon) {
            picker.append('<i class="' + icon + '" data-icon="' + icon + '"></i>');
        });

        $('body').append(picker);

        picker.on('click', 'i', function() {
            var selectedIcon = $(this).data('icon');
            var targetInput = button.closest('.customize-control').find('input[type="text"]');
            targetInput.val(selectedIcon).trigger('change');
            picker.remove();
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.icon-picker-container').length && !$(e.target).closest('.icon-picker-button').length) {
                picker.remove();
            }
        });
    });
});