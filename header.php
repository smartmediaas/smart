<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package smart
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php // Checking user agent to apply font aliasing for windows
if (strpos($_SERVER['HTTP_USER_AGENT'], "Windows", 0) !== FALSE) { ?>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . '/css/windows-aliasing.css'; ?>" />
<?php } ?>

<!--[if lt IE 9]>
    <?php get_template_part('corrections', 'ielt9'); ?>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="contain-to-grid fixed hide-for-medium-up">
    <nav class="top-bar" data-topbar>
        <ul class="title-area">
            <li class="name">
                <h1>
                    <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
                </h1>
            </li>
            <?php if( has_nav_menu( 'primary' ) ){ ?>
                <li class="toggle-topbar menu-icon">
                    <a href="#">
                        <?php _e('Menu', 'smart'); ?> 
                    </a>
                </li>
            <?php } ?>
        </ul>
        <section class="top-bar-section">
            <?php foundation_top_bar(); ?>
        </section>
    </nav>
</div>

<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header row" role="banner">
		<div class="site-branding columns small-12">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>

		<nav id="site-navigation" class="main-navigation columns small-12" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content row">
