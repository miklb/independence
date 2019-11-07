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
        the_title( '<h1 Class="entry-title p-name title is-2">', '</h1>' );

        the_content();
		?>

		</div>
	</section>
	<?php // If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
?>
	</main>
</div>
<?php
get_footer();
