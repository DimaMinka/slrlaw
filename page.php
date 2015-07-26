<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package slrlaw
 */

// Metabox settings
if(get_post_meta( $post->ID, 'sg-checkbox', true ) != '') {
    $pagestyle = ' sg-'.get_post_meta( $post->ID, 'sg-checkbox', true ).'-style';
}

get_header(); ?>
    <div class="variable-content clearfix<?php echo $pagestyle; ?>">
        <?php if (!(is_home() || is_front_page())) the_title('<h1 class="sg-page-title">', '</h1>'); ?>

        <?php get_sidebar(); ?>

        <div id="primary" class="content-area sg-primary">
            <main id="main" class="site-main" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php
                        if (is_home() || is_front_page()) {
                            get_template_part( 'template-parts/content', 'home' );
                        } elseif(get_post_meta( $post->ID, 'sg-cat', true ) != '') {
                            get_template_part( 'template-parts/content', 'cat' );
                        } else {
                            get_template_part( 'template-parts/content', 'page' );
                        }
                    ?>

                <?php endwhile; // End of the loop. ?>

            </main><!-- #main -->
        </div><!-- #primary -->
	</div>

<?php get_footer(); ?>
