<?php
get_header();

// ブログ記事ページのサイドバー表示設定を取得
$display_sidebar = get_theme_mod('mytheme_display_sidebar_post', true);
?>
<script>
    window.mythemeHasSidebar = <?php echo json_encode($display_sidebar); ?>;
</script>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        while (have_posts()) : the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header>

                <div class="entry-content">
                    <?php
                    the_content();
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'your-text-domain'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    // ここでメタデータ（著者、日付、カテゴリーなど）を表示する関数を呼び出す
                    ?>
                </footer>
            </article>

        <?php
            // コメントテンプレートの読み込み
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php if ($display_sidebar) : ?>
    <aside id="secondary" class="widget-area">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </aside><!-- #secondary -->
<?php endif; ?>

<?php get_footer(); ?>