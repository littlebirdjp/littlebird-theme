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
<?php wp_head(); ?>
<link href='http://fonts.googleapis.com/css?family=Marck+Script' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>
<meta property="og:type" content="blog">
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
<meta property="twitter:description" content="<?php bloginfo( 'description' ); ?>">
<?php if ( is_single() ) { ?>
<meta property="og:title" content="<?php the_title(); ?>">
<meta name="twitter:title" content="<?php the_title(); ?>">
<meta property="og:url" content="<?php the_permalink(); ?>">
<meta name="twitter:url" content="<?php the_permalink(); ?>">
<?php if(has_post_thumbnail()) { ?>
<meta property="og:image" content="<?php get_featured_image_url(); ?>">
<meta property="twitter:image" content="<?php get_featured_image_url(); ?>">
<?php } else { ?>
<meta property="og:image" content="<?php bloginfo('template_url'); ?>/img/ogimage.png">
<meta property="twitter:image" content="<?php bloginfo('template_url'); ?>/img/ogimage.png">
<?php } ?>
<?php } else { ?>
<meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
<meta name="twitter:title" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
<meta name="twitter:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
<meta property="og:image" content="<?php bloginfo('template_url'); ?>/img/ogimage.png">
<meta property="twitter:image" content="<?php bloginfo('template_url'); ?>/img/ogimage.png">
<?php } ?>
<meta property="fb:admins" content="youthkee">
<meta property="fb:app_id" content="">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@youthkee">
<meta name="twitter:domain" content="littlebird.mobi">
<link rel="shortcut icon" href="/favicon.ico">
<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="/favicon-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="/favicon-160x160.png" sizes="160x160">
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/mstile-144x144.png">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50835-7', 'auto');
  ga('send', 'pageview');
</script>
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'ja'}
</script>
</head>
<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&appId=&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
