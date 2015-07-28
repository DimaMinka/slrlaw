<?php
/**
 * Template part for displaying single posts.
 *
 * @package slrlaw
 */

?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'slrlaw' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

