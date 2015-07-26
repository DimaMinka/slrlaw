<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package slrlaw
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!--[if lt IE 8>
<p class="browsehappy">Update your browser <a href="http://browsehappy.com/">please</a></p>
<![endif]-->
<div id="page" class="hfeed site wrapper">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'slrlaw' ); ?></a>
	<div class="main-content">
		<header id="masthead" class="site-header sg-header" role="banner">

			<div class="site-branding">
				<?php if(get_theme_mod( 'sg_logo' ) != '') : ?>
					<a id="sg-logo" class="sg-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php echo get_theme_mod('sg_logo', ''); ?>" alt="<?php echo get_theme_mod('sg_logo_alt', ''); ?>" />
					</a>
				<?php else : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php endif;?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'slrlaw' ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'navigation-list' ) ); ?>
			</nav><!-- #site-navigation -->

			<!-- Banner-->
			<!--div class="sg-header-thumb"><?php if ( has_post_thumbnail( get_the_ID() ) ) the_post_thumbnail( 'full' ); ?></div-->

		</header><!-- #masthead -->

		<div id="content" class="site-content container">
