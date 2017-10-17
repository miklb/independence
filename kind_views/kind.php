<?php
/*
  Default Template
 *	The Goal of this Template is to be a general all-purpose model that will be replaced by customization in other templates
 */

$kind = get_post_kind_slug( get_the_ID() );
$meta = new Kind_Meta( get_the_ID() );
$author = Kind_View::get_hcard( $meta->get_author() );
$cite = $meta->get_cite();
$photo = $meta->get_photo();
$site_name = Kind_View::get_site_name( $meta->get_cite(), $meta->get_url() );
$title = Kind_View::get_cite_title( $meta->get_cite(), $meta->get_url() );
$rsvp = $meta->get( 'rsvp' );

$embed_html = self::get_embed( $meta->get_url() );

if($embed_html !== '') {
	$dom = new DOMDocument;
	$dom->loadHTML($embed_html, LIBXML_HTML_NOIMPLIED);

	$nodelinks = $dom->getElementsByTagName('a');
	$links = iterator_to_array($nodelinks);
	$count = count( $links );
	$i = 0;

	foreach ( $links as $link ) $i++; {
		if( $i == $count ) {
			$link->setAttribute("class", "u-url");
		}
	};
	$embed_html = $dom->saveHTML();
}


// Add in the appropriate type
switch ( $kind ) {
	case 'like':
		$type = 'p-like-of';
		break;
	case 'favorite':
		$type = 'p-favorite-of';
		break;
	case 'repost':
		$type = 'p-repost-of';
		break;
	case 'reply':
	case 'rsvp':
		$type = 'p-in-reply-to';
		break;
	case 'tag':
		$type = 'p-tag-of';
		break;
	case 'bookmark':
		$type = 'p-bookmark-of';
		break;
	case 'listen':
		$type = 'p-listen';
		break;
	case 'watch':
		$type = 'p-watch';
		break;
	case 'game':
		$type = 'p-play';
		break;
	case 'wish':
		$type = 'p-wish';
		break;
	case 'read':
		$type = 'p-read-of';
		break;
	case 'quote':
		$type = 'u-quotation-of';
		break;
	default:
		$type = '';
		break;
}
?>

<section class="h-cite response <?php echo $type; ?> ">
<header>
<?php echo Kind_Taxonomy::get_icon( $kind );
if( ! $embed_html ) {
	if ( $title ) {
		echo $title;
	}
	if ( $author ) {
		echo ' ' . __( 'by', 'indieweb-post-kinds' ) . ' ' . $author;
	}
	if ( $site_name ) {
		echo '<em>(<span class="p-publication">' . $site_name . '</span>)</em>';
	}
	if ( in_array( $kind, array( 'jam', 'listen', 'play', 'read', 'watch' ) ) ) {
		$duration = $meta->get_duration();
		if ( $duration ) {
			echo '(' . __( 'Duration: ', 'indieweb-post-kinds' ) . '<span class="p-duration">' . $duration . '</span>)';
		}
	}
}
?>
</header>
<?php
if ( $cite ) {
	if ( $embed_html ) {
		echo '<div class="e-summary">' . $embed_html . '</div>';
	} else if ( array_key_exists( 'summary', $cite ) ) {
		echo sprintf( '<blockquote class="e-summary">%1s</blockquote>', $cite['summary'] );
	}
}

if ( $rsvp ) {
	echo 'RSVP <span class="p-rsvp">' . $rsvp . '</span>';
}

if ( $photo ) {
	echo 'hey, it works';
}

// Close Response
?>
</section>

<?php
