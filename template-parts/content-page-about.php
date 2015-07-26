<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package slrlaw
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>

			<?php if ( has_post_thumbnail( get_the_ID() ) ) the_post_thumbnail( 'full' ); ?>
			<?php
			$my_excerpt = get_the_excerpt();
			if ( '' != $my_excerpt ) {
				$my_excerpt_str = explode("\n",$my_excerpt);
				$my_excerpt_row = "";
				$k = 0;
				foreach ($my_excerpt_str as $row) {
						if (0 == $k && '' != $row) {
							$output .= "<p class='excerpt_first_row'>$row</p><br>";
							$k = 1;
						}else {
							$output .= "<span>$row</span><br>";
						}

				}

				$my_excerpt = preg_replace('/([a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})/', '<a href="mailto:$1">$1</a>', $output);
			}
			echo $my_excerpt;
			?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'slrlaw' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

