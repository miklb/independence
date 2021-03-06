<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package independence
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section class="section">
			<div class="container">
		<?php
		the_title( '<h1 class="entry-title p-name title is-2">', '</h1>' );
		?>
		<div class="content is-medium content-wrapper">
		<?php while ( have_posts() ) : the_post(); ?>
		<?php
			the_content();
		?>
		<?php endwhile; // end of the loop. ?>

		</div><!-- .content-wrapper -->
	</section>
</main>
</div>
<?php
get_footer();
