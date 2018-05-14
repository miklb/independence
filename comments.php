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

if ( !empty ( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) {
	 return;
}
	// Get the global `$wp_query` object.
$id = get_the_ID();
	// Get the semantic_linkbacks_type 'like'.
$comments = get_linkbacks( 'like', $id );
?>
<section class="section">
<div class="container">
	<h3 class="subtitle">Responding with a post on your own blog? Send me a <a href="http://indieweb.org/webmention">Webmention</a> by writing something on your website that links to this post and then enter your post URL below.</h3>
	<form method="post" id="webmention-form" action="<?php echo get_webmention_endpoint(); ?>">
	 <input id="webmention-target" type="hidden" name="target" value="<?php the_permalink(); ?>" />
	 <p class="control has-addons ">
	<input class="input is-fullwidth" name="source" type="url" placeholder="<?php _e( 'URL/Permalink of your article', 'webmention' ); ?>">
	<button class="button is-info" type="submit">
	Notify Me
	</button>
	</p>
	</form>
	
<div class="reactions">
	<h3><?php echo __( 'Hearts', 'semantic-linkbacks' ); ?></h3>
	<?php
	list_linkbacks(
		array(
			'li-class' => array( 'single-mention', 'p-reply', 'emoji-reaction' ),
		),
		Semantic_Linkbacks_Walker_Comment::$reactions
	);
	?>
</div>
<ul class="pile likes">
<li class="icon">
	<?xml version="1.0" encoding="UTF-8"?> <svg width="48px" height="64px" viewBox="0 0 12 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Octicons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="heart" fill="gray"> <path d="M11.2,3 C10.68,2.37 9.95,2.05 9,2 C8.03,2 7.31,2.42 6.8,3 C6.29,3.58 6.02,3.92 6,4 C5.98,3.92 5.72,3.58 5.2,3 C4.68,2.42 4.03,2 3,2 C2.05,2.05 1.31,2.38 0.8,3 C0.28,3.61 0.02,4.28 0,5 C0,5.52 0.09,6.52 0.67,7.67 C1.25,8.82 3.01,10.61 6,13 C8.98,10.61 10.77,8.83 11.34,7.67 C11.91,6.51 12,5.5 12,5 C11.98,4.28 11.72,3.61 11.2,2.98 L11.2,3 Z" id="Shape"></path> </g> </g> </svg>
</li>

<?php
// Comment Loop.
if ( $comments ) {
	foreach ( $comments as $comment ) {
		?>
		<li>
			<?php $author_url = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_author_url', true ); ?>
			<!-- TODO: get author name as alt for image id:1 gh:2-->
			<a href="<?php echo $author_url ?>">
			<?php $author_img = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_avatar', true ); ?>
			<figure class="image is-64x64">
				<img src="<?php echo $author_img ?>" alt="<?php echo $comment->comment_author; ?>">
			</figure>
			</a>
		</li>
<?php
	}
} else {
	echo '<li>No likes.</li>';
}
?>
</ul>


<?php
	// get the semantic_linkbacks_type 'repost'.
	$comments = get_linkbacks( 'repost', $id );
?>

<ul class="pile reposts">
<li class="icon is-large">
	<?xml version="1.0" encoding="UTF-8"?> <svg width="48px" height="64px" viewBox="0 0 12 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <g id="Octicons" stroke="none" stroke-width="1" fill="gray" fill-rule="evenodd"> <g id="sync" fill="gray"> <path d="M10.24,7.4 C10.43,8.68 10.04,10.02 9.04,11 C7.57,12.45 5.3,12.63 3.63,11.54 L4.8,10.4 L0.5,9.8 L1.1,14 L2.41,12.74 C4.77,14.48 8.11,14.31 10.25,12.2 C11.49,10.97 12.06,9.35 11.99,7.74 L10.24,7.4 L10.24,7.4 Z M2.96,5 C4.43,3.55 6.7,3.37 8.37,4.46 L7.2,5.6 L11.5,6.2 L10.9,2 L9.59,3.26 C7.23,1.52 3.89,1.69 1.74,3.8 C0.5,5.03 -0.06,6.65 0.01,8.26 L1.76,8.61 C1.57,7.33 1.96,5.98 2.96,5 L2.96,5 Z" id="Shape"></path> </g> </g> </svg>

</li>

<?php
// Comment Loop.
if ( $comments ) {
	foreach ( $comments as $comment ) {
		?>
		<li>
			<?php $author_url = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_author_url', true ); ?>

			<a href="<?php echo $author_url ?>">
			<?php $author_img = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_avatar', true ); ?>
			<figure class="image is-64x64">
				<img src="<?php echo $author_img ?>" alt="<?php echo $comment->comment_author; ?>">
			</figure>
			</li>
			</a>
<?php
	}
} else {
	echo '<li>No Reposts.</li>';
}
?>
</ul>
</div>
</section>
<section class="section">
	<div class="container">
		<?php
			$id = get_the_ID();

			$comments = get_comments(array(
					'post_id' => $id,
					'status' => 'approve',
					'type__not_in' => 'webmention',
				) );
				wp_list_comments(array(
					'per_page' => 10,
					'style' => 'div',
					'reverse_top_level' => true,
					'walker' => new independence_walker_comment,
				), $comments)
		?>
	</div>
</section>
<section class="section">
	<div class="container">
<?php
$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
$comment_args = array(
	'title_reply'  => 'Got Something To Say?',
	'title_reply_before'   => '<h3 class="subtitle">',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="field"><div class="field-label is-medium">
	<label class="label">Name</label></div>
	<p class="control">
		<input id="author" name="author" class="input is-medium" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		'" placeholder="Your name here">
	</p>
</div>',
		'email'  => '<div class="field">
	<label class="label">Email</label>
	<p class="control">
	<input id="email" name ="email" class="input is-medium" type="email" placeholder="hello@example.com" value="' . esc_attr( $commenter['comment_author_email'] ) .
		'">
	</p>
</div>',
		'url'    => '<div class="field">
	<label class="label">Url</label>
	<p class="control">
		<input id="url" name="url" class="input is-medium" type="url" placeholder="https://example.com">
	</p>
</div>',
	) ),
	'comment_field' => '<div class="field">
	<label class="label">Message</label>
	<p class="control">
		<textarea id="comment" name="comment" class="textarea" placeholder="Your thoughts…" required></textarea>
	</p>
</div>',
		'class_submit' => 'button is-primary',
);

comment_form( $comment_args );
?>
	</div>
</section>
	</div>
</section>
