<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package slrlaw
 */

?>

</div><!-- #content -->
<?php if( get_theme_mod( 'sg_contact' ) != '' ) echo '<div class="sg-contact-left">'.do_shortcode( get_theme_mod( 'sg_contact' ) ).'</div>'; ?>
</div><!-- .main-content -->
</div><!-- #page -->

<footer id="colophon" class="sg-footer site-footer" role="contentinfo">
	<div class="sg-foot clearfix">
		<nav class="sg-footer-nav">
			<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'menu_class' => 'navigation-list-foot' ) ); ?>
		</nav>

		<?php if( get_theme_mod( 'sg_copyright' ) != '' ) echo '<div class="sg-copyright"><p>'.get_theme_mod( 'sg_copyright' ).'</p></div>'; ?>
		<?php if( get_theme_mod( 'sg_company' ) != '' ) echo '<address class="sg-address">'.wpautop(get_theme_mod( 'sg_company' )).'</address>'; ?>

	</div>

</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
