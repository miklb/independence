<?php
/**
 * Bookmark Kind Template.
 *
 * @package independence
 *
 * TODO: fix this.
 */

?>
<?php
$mf2_post = new MF2_Post( get_the_ID() );
$cite     = $mf2_post->fetch();
$meta = new Kind_Meta( get_the_ID() );
$author   = array();
if ( isset( $cite['author'] ) ) {
	$author = Kind_View::get_hcard( $cite['author'] );
}
$url = '';
if ( isset( $cite['url'] ) ) {
	$url = $cite['url'];
}
$site_name = Kind_View::get_site_name( $cite );
$title     = Kind_View::get_cite_title( $cite );
$embed     = self::get_embed( $url );
$embed_html = self::get_embed( $meta->get_url() );
if ( '' !== $embed_html  ) {
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
					<?xml version="1.0" encoding="UTF-8"?> <svg width="20px" height="32px" viewBox="0 0 10 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <g id="Octicons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="bookmark" fill="#000000"> <path d="M9,0 L1,0 C0.27,0 0,0.27 0,1 L0,16 L5,12.91 L10,16 L10,1 C10,0.27 9.73,0 9,0 L9,0 Z M8.22,4.25 L6.36,5.61 L7.08,7.77 C7.14,7.99 7.06,8.05 6.88,7.94 L5,6.6 L3.12,7.94 C2.93,8.05 2.87,7.99 2.92,7.77 L3.64,5.61 L1.78,4.25 C1.61,4.09 1.64,4.02 1.87,4.02 L4.17,3.99 L4.87,1.83 L5.12,1.83 L5.82,3.99 L8.12,4.02 C8.35,4.02 8.39,4.1 8.21,4.25 L8.22,4.25 Z" id="Shape"></path> </g> </g> </svg>
				</span>
				<?php
		if ( ! $embed ) {
	if ( $title ) {
		echo $title;
	}
	if ( ! empty( $author ) ) {
		echo ' ' . __( 'by', 'indieweb-post-kinds' ) . ' ' . $author;
	}
	if ( $site_name ) {
		echo '<em> (' . $site_name . ')</em>';
	}
}
?>
		</div>
<cite class="h-cite response u-bookmark-of">
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
