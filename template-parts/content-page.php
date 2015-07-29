<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package slrlaw
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content sg-entry-content">
		<?php the_content(); ?>

		<?php
			if(get_post_meta( get_the_ID(), 'sg-checkbox', true ) == 'about' ) {
				remove_shortcode('gallery', 'gallery_shortcode');
				add_shortcode('gallery', 'custom_gallery');
				$galleries = get_post_galleries(get_the_ID());
				$gallery_thumbs = '';
				$tesimonials = '';
				$sticky_posts = '';

				if ($galleries) {
					foreach ($galleries as $gallery) {
						$gallery_thumbs .= $gallery;
					}
					printf('
								<div class="sg">
								%s
								</div>',
						$gallery_thumbs
					);
				}
			}
		?>
	</div><!-- .entry-content -->

	</div><!-- .entry-content -->

</article><!-- #post-## -->

