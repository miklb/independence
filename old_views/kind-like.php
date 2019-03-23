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
	$meta     = new Kind_Meta( get_the_ID() );
	$author   = array();
	if ( isset( $cite['author'] ) ) {
			$author = Kind_View::get_hcard( $cite['author'] );
	}
	$url = '';
	if ( isset( $cite['url'] ) ) {
			$url = $cite['url'];
	}
	$domain     = independence_extract_domain_name( $url );
	$site_name  = Kind_View::get_site_name( $cite );
	$title      = Kind_View::get_cite_title( $cite );
	$embed      = self::get_embed( $url );
	$embed_html = self::get_embed( $meta->get_url() );
	if ( '' !== $embed_html ) {
			$dom = new DOMDocument();
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
<cite class="h-cite response u-like-of">
<div class="kind-heading">
		<span class="icon is-medium">
			<?php
			if ( 'github.com' === $domain ) {
			?>
			<svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 14 16"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74z"/></svg>
			<?php
			} else {
			?>
			<svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16"><path fill-rule="evenodd" d="M11.2 3c-.52-.63-1.25-.95-2.2-1-.97 0-1.69.42-2.2 1-.51.58-.78.92-.8 1-.02-.08-.28-.42-.8-1-.52-.58-1.17-1-2.2-1-.95.05-1.69.38-2.2 1-.52.61-.78 1.28-.8 2 0 .52.09 1.52.67 2.67C1.25 8.82 3.01 10.61 6 13c2.98-2.39 4.77-4.17 5.34-5.33C11.91 6.51 12 5.5 12 5c-.02-.72-.28-1.39-.8-2.02V3z"/></svg>
			<?php
			}
			?>
			
		</span>
		<?php
		if ( ! $embed ) {
			if ( $title ) {
				echo wp_kses_post( $title );
			}
			if ( ! empty( $author ) ) {
				echo ' ' . wp_kses_post( 'by', 'indieweb-post-kinds' ) . ' ' . esc_html( $author );
			}
			if ( $site_name ) {
				echo '<em> (' . wp_kses_post( $site_name ) . ')</em>';
			}
		}
?>
</div>
	<?php
	if ( $cite ) {
		if ( $embed_html ) {
			if ( ! get_the_title() ) {
					echo '<div class="e-content p-name">' .  $embed_html . '</div>'; } else {
					echo '<div class="e-content">' . $embed_html . '</div>';
					}
		} elseif ( array_key_exists( 'summary', $cite ) ) {
			echo sprintf( '<blockquote class="e-summary">%1s</blockquote>',  $cite['summary']  );
		}
	}

	// Close Response.
	?>
