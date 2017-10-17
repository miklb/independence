<?php
/**
 * Search page template
 *
 * @package independence
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section class="section">
			<div class="container">
					<?php
					if ( have_posts() ) : ?>

						<header class="page-header">
							<h1 class="page-title p-name">
							Search Result for <?php
							// Search Count.
							$allsearch = new WP_Query( "s=$s&showposts=-1" );
							$key = wp_specialchars( $s, 1 );
							$count = $allsearch->post_count;
							_e( '' );
							_e( '<span class="search-terms">' );
							echo $key;
							_e( '</span>' );
							_e( '&mdash;' );
							echo $count . ' ';
							_e( 'articles' );
							wp_reset_postdata();
							?>
						 </h1>
						</header><!-- .page-header -->

						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>
			</div>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
