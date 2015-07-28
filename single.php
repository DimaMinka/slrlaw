<?php
/**
 * The template for displaying all single posts.
 *
 * @package slrlaw
 */

get_header(); ?>
<div class="variable-content clearfix sg-sidebar-style">
	<?php the_title( '<h1 class="sg-page-title">', '</h1>' ); ?>

	<?php get_sidebar(); ?>


	<div id="primary" class="content-area sg-primary">
		<main id="main" class="site-main" role="main">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">

						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'template-parts/content', 'single' ); ?>

						<?php endwhile; // End of the loop. ?>

			</article><!-- #post-## -->

		</main><!-- #main -->
	</div><!-- #primary -->

</div><!-- .sg-sidebar-style -->

<?php get_footer(); ?>
