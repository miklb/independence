<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package independence
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'independence' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'independence' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'independence' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'independence' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>
		<?php
		// using callback to change just html utput on a comment.
		// html5 comment.
		function independence_comments_callback( $comment, $args, $depth ) {
			// checks if were using a div or ol|ul for our output.
			$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $args['has_children'] ? 'parent' : '', $comment ); ?>>
			 <article class="media">
				 <figure class="media-left">
					 <p class="image is-64x64">
						<img src="<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>">
					 </p>
				 </figure>
				 <div class="media-content">
					 <div class="content">
						 <p>
							 <strong><?php printf( __( '%s <span class="says">says:</span>' ), sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) ) ); ?></strong>
							 <br>
								<?php comment_text(); ?>
							 <br>
							 <small>
								 <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
									<span class="comment-time">
											<time datetime="<?php comment_time( 'c' ); ?>">
												<?php
													/* translators: 1: comment date, 2: comment time */
													printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
											?>
											</time>
										</span>
										<?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
									</a>
								</small>
						 </p>
						 <?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
					 <?php endif; ?>
					<?php
					comment_reply_link( array_merge( $args, array(
						 'add_below' => 'div-comment',
						 'depth'     => $depth,
						 'max_depth' => $args['max_depth'],
						 'before'    => '<div class="reply">',
						 'after'     => '</div>'
					) ) );
					?>
			 </article><!-- .comment-body -->

			 <?php
}
		 ?>

		 <?php
		 	wp_list_comments( array(
		 			'style' => 'div',
		 			'callback' => 'independence_comments_callback',
		 			'avatar_size' => '75',
		 			'depth' => '3',
		 	) );
		 ?>


		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'independence' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'independence' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'independence' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'independence' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
