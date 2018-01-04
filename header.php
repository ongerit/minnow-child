<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Minnow
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
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'minnow' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div class="site-dk-flex ">
			<div class="site-branding">
				<?php if ( function_exists( 'jetpack_the_site_logo' ) ) : ?>
					<?php jetpack_the_site_logo(); ?>
				<?php endif; ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>

			<nav class="site-dk-navigation">
				<!-- <ul>
					<li> <a href="/about">About</a></li>
					<li><a href="/faq">FAQ</a></li>
					<li class="site-dk-button"><a href="/apply">Apply Now</a></li>
				</ul> -->
			</nav>
		</div>

		<?php if ( has_nav_menu ( 'social' ) ) : ?>
			<?php wp_nav_menu( array( 'theme_location' => 'social', 'depth' => 1, 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>', 'container_class' => 'social-links', ) ); ?>
		<?php endif; ?>

		<?php if ( has_nav_menu ( 'primary' ) || is_active_sidebar( 'sidebar-1' ) ) : ?>
			<button class="menu-toggle" title="<?php esc_attr_e( 'Sidebar', 'minnow' ); ?>"><span class="screen-reader-text"><?php _e( 'Sidebar', 'minnow' ); ?></span></button>
		<?php endif; ?>
		<div class="slide-menu">
			<?php if ( has_nav_menu ( 'primary' ) ) : ?>
				<h2 class="widget-title"><?php _e( 'Menu', 'minnow' ); ?></h2>
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav><!-- #site-navigation -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-1' ) ) {
				get_sidebar();
			} ?>

		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
