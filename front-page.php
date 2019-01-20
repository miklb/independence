<?php
/**
 *  Home page template
 *
 * @package independence
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="section home-top">
				<div class="container h-card media">
					<figure class="media-left">
						<p class="image is-128x128 u-photo">
							<img src="https://cdn.miklb.com/content/uploads/2019/01/14223755/wsi-imageoptim-miklb_2018_profile.jpg">
						</p>
					</figure>
					<div class="media-content">
					<div class="content is-large">
						<p>
							<span class="title is-3">Howdy! I'm <a class="u-url p-name" href="https://miklb.com">Michael Bishop</a>.</span> <small>@miklb</small>
							<br>
							<span class="title is-4 p-note">Digital plumber, food maker. Proud Tampa native. Sports fan & music lover. he/him</span>
							<br>
							<span class="subtitle is-4 p-note">Welcome to my corner of the web, chronicling life in a digital world.</span>
					</div><!-- intro -->
					<nav class="level">
						<div class="level-left">
							<a href="https://twitter.com/miklb" class="u-url icon twitter level-item is-large" title="Twitter" rel="me">
								<svg width="24" height="24" viewbox="24 24 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"></path></svg>
							</a>
							<a href="https://github.com/miklb" class="u-url icon github leve-item is-large" title="GitHub" rel="me">
								<svg width="24" height="24" viewbox="0 0 512 512"><path d="M256 70.7c-102.6 0-185.9 83.2-185.9 185.9 0 82.1 53.3 151.8 127.1 176.4 9.3 1.7 12.3-4 12.3-8.9V389.4c-51.7 11.3-62.5-21.9-62.5-21.9 -8.4-21.5-20.6-27.2-20.6-27.2 -16.9-11.5 1.3-11.3 1.3-11.3 18.7 1.3 28.5 19.2 28.5 19.2 16.6 28.4 43.5 20.2 54.1 15.4 1.7-12 6.5-20.2 11.8-24.9 -41.3-4.7-84.7-20.6-84.7-91.9 0-20.3 7.3-36.9 19.2-49.9 -1.9-4.7-8.3-23.6 1.8-49.2 0 0 15.6-5 51.1 19.1 14.8-4.1 30.7-6.2 46.5-6.3 15.8 0.1 31.7 2.1 46.6 6.3 35.5-24 51.1-19.1 51.1-19.1 10.1 25.6 3.8 44.5 1.8 49.2 11.9 13 19.1 29.6 19.1 49.9 0 71.4-43.5 87.1-84.9 91.7 6.7 5.8 12.8 17.1 12.8 34.4 0 24.9 0 44.9 0 51 0 4.9 3 10.7 12.4 8.9 73.8-24.6 127-94.3 127-176.4C441.9 153.9 358.6 70.7 256 70.7z"></path></svg>
							</a>
							<a href="<?php bloginfo( 'atom_url' ); ?>" class="icon rss level-icon is-large" title="RSS"><svg width="24" height="24" viewbox="0 0 512 512"><path d="M201.8 347.2c0 20.3-16.5 36.8-36.8 36.8 -20.3 0-36.8-16.5-36.8-36.8s16.5-36.8 36.8-36.8C185.3 310.4 201.8 326.8 201.8 347.2zM128.2 204.7v54.5c68.5 0.7 124 56.3 124.7 124.7h54.5C306.7 285.3 226.9 205.4 128.2 204.7zM128.2 166.6c57.9 0.3 112.3 22.9 153.2 63.9 41 41 63.7 95.5 63.9 153.5h54.5c-0.3-149.9-121.7-271.4-271.6-271.9V166.6L128.2 166.6z"></path></svg>
							</a>
						</div><!-- .level-left -->
					</nav><!-- .level -->
				</div><!-- .media-content -->
			</div><!-- .h-card -->
			</section><!-- .home-top -->
				<?php
					// Check for transient. If none, then execute WP_Query.
				 // if ( false === ( $articles = get_transient( 'mb_article_posts' ) ) ) {
						$args = array(
							'post_type' => 'post',
							'posts_per_page' => 1,
							'tax_query' => array(
								array(
									'taxonomy' => 'kind',
									'field'    => 'slug',
									'terms'    => 'article',
									 'include_children' => false,
								),
							),
						);
						$articles = new WP_Query( $args );

						// Put the results in a transient. Expire after 12 hours.
						// set_transient( 'mb_article_posts', $articles, 12 * HOUR_IN_SECONDS );
						// }
					?>
					<?php
					if ( $articles->have_posts() ) :

						/* Start the Loop */


						while ( $articles->have_posts() ) : $articles->the_post();
							get_template_part( 'template-parts/spotlight', $articles->current_post );

						endwhile;

					else : ?>
						<?php
					endif;
					wp_reset_postdata();
					?>
					<section class="section secondary-articles">
						<div class="container">
							<div class="columns">
								<?php
								// Check for transient. If none, then execute WP_Query.
							 // if ( false === ( $articles = get_transient( 'mb_article_posts' ) ) ) {
									$args = array(
										'post_type' => 'post',
										'posts_per_page' => 2,
										'offset' => 1,
										'tax_query' => array(
											array(
												'taxonomy' => 'kind',
												'field'    => 'slug',
												'terms'    => 'article',
												 'include_children' => false,
											),
											),
											);
											$articles_alt = new WP_Query( $args );

											// Put the results in a transient. Expire after 12 hours.
											// set_transient( 'mb_article_posts', $articles, 12 * HOUR_IN_SECONDS );
											// }
								?>
								<?php
								if ( $articles_alt->have_posts() ) :
									/* Start the Loop */

									while ( $articles_alt->have_posts() ) : $articles_alt->the_post();

										get_template_part( 'template-parts/spotlight' );

									endwhile;

								else : ?>
								<?php
							endif;
							wp_reset_postdata();
							?>
							</div><!-- .columns -->
						</div><!-- .container -->
					</section>
					<section class="section home-timeline">
						<div class="timeline container">
							<header>
								<h2 class="title is-2 details">Notes</h2>
								<p class="subtitle is-4">Quick thoughts and asides</p>
							</header>
							<?php
							$args = array(
								'post_type' => 'post',
								'date_query' => array(
									array(
										'column' => 'post_date',
										'after' => '10 days ago',
									),
								),
								'posts_per_page' => -1,
								'tax_query' => array(
									array(
										'taxonomy' => 'kind',
										'field'    => 'slug',
										'terms'    => 'article',
										'operator' => 'NOT IN',
										 'include_children' => false,
									),
								),
							);
							$day = '';
							$notes = new WP_Query( $args );
							?>
							<?php
							if ( $notes->have_posts() ) :
										 /* Start the Loop */

								while ( $notes->have_posts() ) : $notes->the_post();
										?>
										<?php $kind = get_post_kind_slug( get_the_ID() ); ?>
										<article class="columns h-entry <?php echo $kind ?>">
										<?php if ( $day !== get_the_date() ) { ?>
											<header class="column is-one-quarter">
												<a href="/" class="u-author"></a>
												<p class="details"><?php echo get_the_date( '' ); ?><?php $day = get_the_date(); ?></p>
												<h4><time class="dt-published" datetime="<?php echo esc_attr( get_the_date( DATE_ATOM ) ); ?>"><?php echo get_the_date( 'H:i' ); ?></time> <a class="u-url" href="<?php the_permalink(); ?>" rel="bookmark">#</a></h4>
											</header>
											<?php	} else { ?>
												<header class="column is-one-quarter	">
													<h4><time class="dt-published" datetime="<?php echo esc_attr( get_the_date( DATE_ATOM ) ); ?>"><?php echo get_the_date( 'H:i' ); ?></time> <a class="u-url" href="<?php the_permalink(); ?>" rel="bookmark">#</a></h4>
												</header>
										<?php } ?>
										<div class="column content is-medium">
											<?php the_content(); ?>
										</div>
										</article>
									 	<?php endwhile;

									 else : ?>
									<?php
									 endif;
								 		wp_reset_postdata();
								 	?>
								</div><!-- .timeline -->
							</section><!-- .home-timeline -->
	</main>
</div><!-- .primary -->
<?php get_footer(); ?>
