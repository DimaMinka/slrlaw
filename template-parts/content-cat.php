<?php
/**
 * The template part for displaying posts by selected category.
 *
 * @package slrlaw
 */

$args = array (
    'cat'                    => get_post_meta( $post->ID, 'sg-cat', true ),
    'pagination'             => true,
    'posts_per_page'         => '3',
    'order'                  => 'DESC',
    'orderby'                => 'date',
);

$cat_query = new WP_Query( $args );

if ( $cat_query->have_posts() ) {
    while ( $cat_query->have_posts() ) {
        $cat_query->the_post();

        $cat_posts .= sprintf('
            <article class="sg-blog-post">
                <div class="sg-post-content clearfix">
                    <div class="sg-right-wrap">
                        <div class="sg-right-thumb">
                            <a href="%1$s" class="sg-post-link">%2$s</a>
                        </div>
                    </div>
                    <div class="sg-left-wrap">
                        <h3 class="sg-post-title">%3$s</h3>
                        %4$s
                        <div class="sg-more-wrap"><a href="%1$s" class="sg-more-link"><span class="hide-text">%5$s</span></a></div>
                    </div>
                </div>
            </article>',
            get_permalink(),
            get_the_post_thumbnail(get_the_ID(), 'sidebar-thumb', array('class' => 'sg-post-img')),
            get_the_title(),
            wpautop(get_the_excerpt()),
            __('Read more...')
        );

    }
} wp_reset_postdata();

?>

<div class="sg-entry-content"><?php echo $cat_posts; ?></div>

<nav class="navigation posts-navigation" role="navigation">
    <h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'slrlaw' ); ?></h2>
    <div class="nav-links">

        <?php if ( get_next_posts_link() ) : ?>
            <div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts', 'slrlaw' ) ); ?></div>
        <?php endif; ?>

        <?php if ( get_previous_posts_link() ) : ?>
            <div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'slrlaw' ) ); ?></div>
        <?php endif; ?>

    </div><!-- .nav-links -->
</nav><!-- .navigation -->
