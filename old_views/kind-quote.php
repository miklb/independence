<?php
/**
 * Quote Kind Template.
 *
 * @package independence
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
			<?xml version="1.0" encoding="UTF-8"?> <svg width="28px" height="32px" viewBox="0 0 14 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <g id="Octicons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="quote" fill="#000000"> <path d="M6.16,3.50000004 C3.73,5.06000004 2.55,6.67000004 2.55,9.36000004 C2.71,9.31000004 2.85,9.31000004 2.99,9.31000004 C4.26,9.31000004 5.49,10.17 5.49,11.72 C5.49,13.33 4.46,14.33 2.99,14.33 C1.09,14.33 0,12.81 0,10.08 C0,6.28000004 1.75,3.55000004 5.02,1.66000004 L6.16,3.50000004 L6.16,3.50000004 Z M13.16,3.50000004 C10.73,5.06000004 9.55,6.67000004 9.55,9.36000004 C9.71,9.31000004 9.85,9.31000004 9.99,9.31000004 C11.26,9.31000004 12.49,10.17 12.49,11.72 C12.49,13.33 11.46,14.33 9.99,14.33 C8.1,14.33 7.01,12.81 7.01,10.08 C7.01,6.28000004 8.76,3.55000004 12.03,1.66000004 L13.17,3.50000004 L13.16,3.50000004 Z" id="Shape"></path> </g> </g> </svg>
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
<cite class="h-cite response u-quotation-of">
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
