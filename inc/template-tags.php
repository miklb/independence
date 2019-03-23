<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package independence
 */

 /**
 * Wraps the_excerpt in p-summary
 *
 */
function mf2_s_the_excerpt( $content ) {
	if ( mf2_s_template_type()=='article' ) {
			 $wrap = '<div class="entry-summary p-summary" itemprop="description">';
	}
				else {
			 $wrap = '<div class="entry-summary p-summary p-name" itemprop="description">';
		}
		if ($content!="") {
			 return $wrap . $content . '</div>';
		}
	 return $content;
 }
 add_filter( 'the_excerpt', 'mf2_s_the_excerpt', 1 );

 /**
* Wraps the_content in e-content
*
*/
function mf2_s_the_content( $content ) {
	 if ((mf2_s_template_type()=='article')||(is_page())) {
			$wrap = '<div class="entry-content e-content"><p>';
	 }
	 else {
			$wrap = '<div class="entry-content e-content p-name"><p>';
	 }
	 if ($content!="") {
			return $wrap . $content . "\n" . '</div>' . '<!-- .entry-content -->';
	 }
	return $content;
}
add_filter( 'the_content', 'mf2_s_the_content', 1 );

/**
* retrieves the post kind or post slug and returns it
* based on whether the post kinds is enabled
* and to reduce the number of templates
* maps several post format to post kind templates
*/
function mf2_s_template_type()  {
	if (function_exists('get_post_kind') )
					{
					 /* Use kinds for specific templates
				 */
							 $name = get_post_kind_slug();
				 }
	else {
				/* Otherwise use post formats for templates
				 * For those post formats that have post kind
				 * analogues - use the closest equivalent
				 * comment out if needed
				 */
		$name = get_post_format();
								if ( false === $name ) {
										$name = 'article';
									 }
								else{
									 switch($name)
										 {
											 case 'image':
													$name = 'photo';
													break;
											 case 'aside':
													$name = 'note';
													break;
											 case 'status':
													$name = 'note';
													break;
											 case 'link':
													$name = 'bookmark';
													break;
											 case 'quote':
													$name = "quote";
													break;
											}
						 }
		 }
	return $name;
}


if ( ! function_exists( 'independence_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
	function independence_posted_on() {
		$time_string = '<time class="entry-date dt-published dt-updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
	  // TODO: compare get_the_date to get_the_modified_date if same only show hour/minute update. Should it show hour:minute to start with?
	  
			$time_string = '<time class="entry-date dt-published" datetime="%1$s">%2$s</time><time class="dt-updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_ATOM ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_ATOM ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'independence' ),
			'<a class="u-url" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'independence' ),
			'<span class="author p-author h-card vcard"><a class="url u-url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'independence_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function independence_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'independence' ) );
			if ( $categories_list && independence_categorized_blog() ) {
				printf( '<p class="content is-medium"><span class="cat-links">' . esc_html__( 'Posted in %1$s', 'independence' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '<span class="tag is-light is-medium">',', ','</span>' );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( ' Tagged %1$s', 'independence' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'independence' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( ' Edit %s', 'independence' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span></p>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function independence_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'independence_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'independence_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so independence_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so independence_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in independence_categorized_blog.
 */
function independence_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'independence_categories' );
}
add_action( 'edit_category', 'independence_category_transient_flusher' );
add_action( 'save_post',     'independence_category_transient_flusher' );

/**
 * Custom Pagination for use with Bulma
 * @see http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
 * @method independence_bulma_pagination
 * @param  string                        $pages [description]
 * @param  integer                       $range [description]
 * @return [type]                               [description]
 */
function independence_bulma_pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<nav class='pagination is-centered'>";
         if($paged > 1 && $showitems < $pages) echo "<a class='pagination-previous' rel='previous' href='".get_pagenum_link($paged - 1)."'>Previous</a>";
         echo "<ul class='pagination-list'>\n";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a class='pagination-link' rel='next' href='".get_pagenum_link(1)."'>1</a></li>";
         if($paged > 4) {
           echo "<li><span class='pagination-ellipsis'>&hellip;</span></li>";
         }
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span class='pagination-link is-current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='pagination-link' >".$i."</a></li>";
             }
         }
         echo "<li><span class='pagination-ellipsis'>&hellip;</span></li>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li> <a class='pagination-link' href='".get_pagenum_link($pages)."'>$pages</a></li>";
         echo "</ul>\n";
         if ($paged < $pages && $showitems < $pages) echo "<a class='pagination-next' href='".get_pagenum_link($paged + 1)."'>Next Page</a>";

         echo "</nav>\n";
     }
}
