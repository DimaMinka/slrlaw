<?php
/**
 * The template used for displaying homepage content in page.php
 *
 * @package slrlaw
 */

?>

<header class="entry-header">
	<?php if ( has_post_thumbnail( get_the_ID() ) ) the_post_thumbnail( 'full' ); ?>
</header>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
			remove_shortcode('gallery', 'gallery_shortcode');
			add_shortcode('gallery', 'custom_gallery');
			$galleries = get_post_galleries( get_the_ID() );
			$gallery_thumbs = '';
			$tesimonials = '';
			$sticky_posts = '';

			if($galleries) {
				foreach($galleries as $gallery) {
					$gallery_thumbs .= $gallery;
				}
				printf('
					<div class="sg">
					%s
					</div>',
					$gallery_thumbs
				);
			}
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

