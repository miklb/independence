<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package independence
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link href="https://micro.blog/miklb" rel="me" />
<meta name="description" content="
<?php
if ( is_single() ) {
	single_post_title( '', true );
} else {
	bloginfo( 'name' );
	echo ' - ';
	bloginfo( 'description' );
}
?>
" />
<link rel="alternate" type="application/atom+xml" title="Miklb&#039;s Mindless Ramblings &raquo; Feed" href="<?php bloginfo( 'atom_url' ); ?>" />
<link rel="feed" type="text/html" title="Miklb's Mindless Ramblings Blog feed" href="https://miklb.com/firehose/" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<nav class="navbar banner">
		<div class="navbar-brand">
			<a class="nav-item" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>">

			<?php
			if ( ! is_singular() ) {
				$mf2title = 'p-name';
			} else {
				$mf2title = '';
			}
			?>
			<span class="title <?php echo esc_html( $mf2title ); ?>">Miklb's Mindless Ramblings</span>
			</a>
			<div class="navbar-burger">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
		<div class="navbar-menu"><!-- hidden on mobile -->
			<div class="navbar-start">
			<!-- navbar items -->
			</div>
			<div class="navbar-end">
			<?php get_search_form(); ?>
			</div>
		</div>
	</nav>
