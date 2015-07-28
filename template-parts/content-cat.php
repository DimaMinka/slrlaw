<?php
/**
 * The template part for displaying posts by selected category.
 *
 * @package slrlaw
 */

$page_ID = get_the_ID();

$args = array (
    'cat'                    => get_post_meta( $post->ID, 'sg-cat', true ),
    'pagination'             => true,
    'posts_per_page'         => (get_post_meta( $post->ID, 'sg-checkbox', true ) == 'faq' ? '-1' : '3'),
    'order'                  => 'DESC',
    'orderby'                => 'date',
);

$cat_query = new WP_Query( $args );

if ( $cat_query->have_posts() ) {
    while ( $cat_query->have_posts() ) {
        $cat_query->the_post();

        if (get_post_meta( $page_ID, 'sg-checkbox', true ) == 'faq') {

            $cat_posts .= sprintf('
                <div class="sg-faq-post">
                    <div class="sg-faq-toggler">
                        <i class="sg-icons icon-faq1"></i>
                        <h3 class="sg-faq-title">%1$s</h3>
                    </div>
                    <div class="sg-faq-content">%2$s</div>
                </div>',
                get_the_title(),
                get_the_content()
            );

        } else {

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

    }
} wp_reset_postdata();

?>

<div class="sg-entry-content"><?php echo $cat_posts; ?></div>
