<?php
/**
 * Template part first spotlight article on home page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package independence
 */

?>
<section class="section featured-articles">
	<div class="container">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<a href="/" class="u-author"></a>
				<div class="columns">
				<div class="column is-one-quarter">
				<header>
					<p class="subtitle is-4 details">Latest Article</p>
					<?php
					the_title( '<h2 class="title is-2 p-name"><a class="u-url" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					?>
				</header>
						<div class="content is-medium p-summary">
							<p><?php the_excerpt(); ?></p>
							<p><a href="<?php the_permalink(); ?>" class="button is-medium is-primary">Read the Article</a></p>
						</div><!-- .p-summary -->
				</div><!-- .column -->
						<div class="column lede-image">
							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'latest-article-home' );
} ?>
						</div><!-- .lede-image -->
					</article>
		</div><!-- .columns -->
	</div><!-- .container -->
</section><!-- .featured-articles -->
