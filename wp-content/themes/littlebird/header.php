<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package littlebird
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<link href='http://fonts.googleapis.com/css?family=Marck+Script' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'littlebird' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<nav id="site-navigation" class="navbar navbar-default header" role="navigation">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle header__toggle" data-toggle="collapse" data-target="#headerMenu">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		    </div>
			<div class="collapse navbar-collapse header__inner" id="headerMenu">
			<?php wp_nav_menu( array( 'theme_location' => 'primary','menu_class' => 'menu nav navbar-nav navbar-right header__menu' ) ); ?>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav><!-- #site-navigation -->

		<div class="site-branding jumbotron main">
		  <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 main__logo">
		    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/logo@2x.png" height="140" width="140" alt="<?php bloginfo( 'name' ); ?>"></a>
		  </div>
		  <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 main__title">
		    <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
		  </div>
		  <?php if ( is_home() ) { ?>
		  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 main__lead">
		    <p class="site-description"><?php bloginfo( 'description' ); ?></p>
		  </div>
		  <?php } ?>
		</div><!-- .site-branding -->

	</header><!-- #masthead -->

	<div class="container">

	<div id="content" class="site-content">
