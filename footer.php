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

		<?php if( get_theme_mod( 'sg_company' ) != '' ) echo '<div class="sg-company-data"><p>'.wpautop(get_theme_mod( 'sg_company' )).'</p></div>'; ?>
		<?php if( get_theme_mod( 'sg_copyright' ) != '' ) echo '<div class="sg-copyright"><p>'.( 'sg_copyright' ).'</p></div>'; ?>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'slrlaw' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'slrlaw' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'slrlaw' ), 'slrlaw', '<a href="http://underscores.me/" rel="designer">evgeny</a>' ); ?>
		</div><!-- .site-info -->



	</footer><!-- #colophon -->
<?php if( get_theme_mod( 'sg_contact' ) != '' ) echo '<div class="sg-contact-left">'.do_shortcode( get_theme_mod( 'sg_contact' ) ).'</div>'; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
