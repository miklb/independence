<?php
/**
 * Quote Kind Reply.
 *
 * @package independence
 */

?>

	<?php
	$kind = get_post_kind_slug( get_the_ID() );
	$meta = new Kind_Meta( get_the_ID() );
	$author = Kind_View::get_hcard( $meta->get_author() );
	$cite = $meta->get_cite();
	$url = $meta->get_url();
	$site_name = Kind_View::get_site_name( $meta->get_cite(), $meta->get_url() );
	$title = Kind_View::get_cite_title( $meta->get_cite(), $meta->get_url() );
	$embed_html = self::get_embed( $meta->get_url() );
	if ( '' !== $embed_html   ) {
		$dom = new DOMDocument;
		$dom->loadHTML( $embed_html, LIBXML_HTML_NOIMPLIED );

		$nodelinks = $dom->getElementsByTagName( 'a' );
		$links = iterator_to_array( $nodelinks );
		$count = count( $links );
		$i = 0;

		foreach ( $links as $link ) $i++; {
			if ( $i === $count ) {
				$link->setAttribute( 'class', 'u-url' );
			}
		};
		$embed_html = $dom->saveHTML();
	}
?>
<cite class="h-cite u-in-reply-to">
<div class="kind-heading">
		<span class="icon is-medium">
			<?xml version="1.0" encoding="UTF-8"?> <svg width="28px" height="32px" viewBox="0 0 14 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Octicons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="reply" fill="#000000"> <path d="M6,3.5 C9.92,3.94 14,6.625 14,13.5 C11.688,8.438 9.25,7.5 6,7.5 L6,11 L0.5,5.5 L6,0 L6,3.5 Z" id="Shape"></path> </g> </g> </svg>
		</span>
		<a class="u-url" href="<?php echo $url; ?>">
		<span>A post on</span>


			<?php
			if ( $site_name ) {
				echo '<span class="p-publication">';
				echo $site_name;
				echo '</span>';
			}
			?>

		</a>

			<?php
			if ( $author ) {
				echo '<span class="kind-author">';
				echo 'by' . $author;
				echo '</span>';
			}
			?>

</div>
	<?php
	if ( $cite ) {
		if ( $embed_html ) {
			if ( ! get_the_title() ) {
					echo '<div class="p-content">' . $embed_html . '</div>';	} else {
					echo '<div class="p-content">' . $embed_html . '</div>';
					}
		} elseif ( array_key_exists( 'summary', $cite ) ) {
			echo sprintf( '<blockquote class="p-content">%1s</blockquote>', $cite['summary'] );
		}
	}
	// Close Response.
	?>
</cite>
<?php
