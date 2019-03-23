<?php
/**
 * Quote Kind Reply.
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
<cite class="h-cite u-in-reply-to">
<div class="kind-heading">
		<span class="icon is-medium">
			<?xml version="1.0" encoding="UTF-8"?> <svg width="28px" height="32px" viewBox="0 0 14 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Octicons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="reply" fill="#000000"> <path d="M6,3.5 C9.92,3.94 14,6.625 14,13.5 C11.688,8.438 9.25,7.5 6,7.5 L6,11 L0.5,5.5 L6,0 L6,3.5 Z" id="Shape"></path> </g> </g> </svg>
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
