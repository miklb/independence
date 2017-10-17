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
	$site_name = Kind_View::get_site_name( $meta->get_cite(), $meta->get_url() );
	$title = Kind_View::get_cite_title( $meta->get_cite(), $meta->get_url() );
	$embed_html = self::get_embed( $meta->get_url() );
	if ( $embed_html !== '' ) {
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
<div class="kind-heading">
		<span class="icon is-medium">
			<?xml version="1.0" encoding="UTF-8"?> <svg width="24px" height="32px" viewBox="0 0 12 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Octicons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="heart" fill="#000000"> <path d="M11.2,3 C10.68,2.37 9.95,2.05 9,2 C8.03,2 7.31,2.42 6.8,3 C6.29,3.58 6.02,3.92 6,4 C5.98,3.92 5.72,3.58 5.2,3 C4.68,2.42 4.03,2 3,2 C2.05,2.05 1.31,2.38 0.8,3 C0.28,3.61 0.02,4.28 0,5 C0,5.52 0.09,6.52 0.67,7.67 C1.25,8.82 3.01,10.61 6,13 C8.98,10.61 10.77,8.83 11.34,7.67 C11.91,6.51 12,5.5 12,5 C11.98,4.28 11.72,3.61 11.2,2.98 L11.2,3 Z" id="Shape"></path> </g> </g> </svg>
		</span>
		<span>A post on</span>
		<span class="p-publication">
			<?php echo $site_name ?>
		</span>
		<span class="kind-author">
			by<?php echo $author ?>
		 </span>
</div>
<cite class="h-cite response u-like-of">
	<?php
	if ( $cite ) {
		if ( $embed_html ) {
			if ( ! get_the_title() ) {
					echo '<div class="e-content p-name">' . $embed_html . '</div>';	} else {
					echo '<div class="e-content">' . $embed_html . '</div>';
					}
		} elseif ( array_key_exists( 'summary', $cite ) ) {
			echo sprintf( '<blockquote class="e-summary">%1s</blockquote>', $cite['summary'] );
		}
	}

	// Close Response.
	?>
