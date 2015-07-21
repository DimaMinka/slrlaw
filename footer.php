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

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu' ) ); ?>

		<div class="site-info">
			<?php if( get_theme_mod( 'sg_copyright' ) != '' ) echo '<div class="sg-copyright"><p>'.get_theme_mod( 'sg_copyright' ).'</p></div>'; ?>
			<?php if( get_theme_mod( 'sg_company' ) != '' ) echo '<div class="sg-company-data">'.wpautop(get_theme_mod( 'sg_company' )).'</div>'; ?>
		</div><!-- .site-info -->



	</footer><!-- #colophon -->
<?php if( get_theme_mod( 'sg_contact' ) != '' ) echo '<div class="sg-contact-left">'.do_shortcode( get_theme_mod( 'sg_contact' ) ).'</div>'; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
