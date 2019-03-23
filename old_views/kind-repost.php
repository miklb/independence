<?php
/**
 * Quote Kind Repost.
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
			<?xml version="1.0" encoding="UTF-8"?> <svg width="24px" height="32px" viewBox="0 0 12 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <g id="Octicons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="sync" fill="#000000"> <path d="M10.24,7.4 C10.43,8.68 10.04,10.02 9.04,11 C7.57,12.45 5.3,12.63 3.63,11.54 L4.8,10.4 L0.5,9.8 L1.1,14 L2.41,12.74 C4.77,14.48 8.11,14.31 10.25,12.2 C11.49,10.97 12.06,9.35 11.99,7.74 L10.24,7.4 L10.24,7.4 Z M2.96,5 C4.43,3.55 6.7,3.37 8.37,4.46 L7.2,5.6 L11.5,6.2 L10.9,2 L9.59,3.26 C7.23,1.52 3.89,1.69 1.74,3.8 C0.5,5.03 -0.06,6.65 0.01,8.26 L1.76,8.61 C1.57,7.33 1.96,5.98 2.96,5 L2.96,5 Z" id="Shape"></path> </g> </g> </svg>
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
<cite class="h-cite response u-repost-of">
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
