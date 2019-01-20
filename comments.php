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
?>
<section class="section">
	<div class="container">
		<?php
			$id = get_the_ID();

			$comments = get_comments(
				array(
					'post_id'      => $id,
					'status'       => 'approve',
					'type__not_in' => 'webmention',
				)
				);
				wp_list_comments(
					array(
					'per_page' => 10,
					'style' => 'div',
					'reverse_top_level' => true,
					'walker' => new independence_walker_comment,
					),
					$comments
				)
		?>
	</div>
</section>
<section class="section">
	<div class="container">
<?php
$commenter = wp_get_current_commenter();
$req       = get_option( 'require_name_email' );
$aria_req  = ( $req ? " aria-required='true'" : '' );
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
