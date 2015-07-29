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

<div class="sg-side-search">
    <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
        <label>
            <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
            <input type="search" class="sg-search-field" value="<?php echo get_search_query() ?>" name="s" />
        </label>
        <input type="submit" class="sg-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
    </form>
</div>
<?php if( get_theme_mod( 'sg_contact' ) != '' ) :
    $contact_title = explode('title=', get_theme_mod( 'sg_contact' ));
    $contact_title = explode('"', $contact_title[1]);
    ?>
    <div class="sg-side-contact">
        <h4 class="sg-side-title"><?php echo $contact_title[1]; ?></h4>
        <?php echo '<div class="sg-contact-left">'.do_shortcode( get_theme_mod( 'sg_contact' ) ).'</div>'; ?>
    </div><!-- .main-content -->
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
