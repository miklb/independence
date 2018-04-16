<?php
/**
 * Template part for displaying secondary spotlight article posts on home page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package independence
 */

?>

			<div class="column">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<a href="/" class="u-author"></a>
					<figure class="led-image">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( array(540, 275) );
						} ?>
					</figure>
					<header class="major">
						<?php
			the_title( '<h2 class="title p-name"><a class="u-url" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
					</header><!-- .major -->

					<div class="content is-medium p-summary">
						<p><?php the_excerpt(); ?></p>
						<p><a href="<?php the_permalink(); ?>" class="button is-medium is-primary">Read the Article</a></p>
					</div><!-- .p-summary -->
				</article><!-- #post-## -->
			</div><!-- .column -->
<?php
