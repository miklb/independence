<?php
/**
 * Quote Kind Photo.
 *
 * @package independence
 */

?>

	<?php
	$mf2_post = new MF2_Post( get_the_ID() );
	$cite     = $mf2_post->fetch();
	if ( ! $cite ) {
	$cite = array();
	}
	
	$author = array();
	if ( isset( $cite['author'] ) ) {
			$author = Kind_View::get_hcard( $cite['author'] );
	}
	$url = '';
	if ( isset( $cite['url'] ) ) {
			$url = $cite['url'];
	}
	$photos   = get_attached_media( 'image', get_the_ID() );
	$site_name = Kind_View::get_site_name( $cite );
	$title     = Kind_View::get_cite_title( $cite );
?>
<div class="kind-heading">
		<span class="icon is-medium">
			<?xml version="1.0" encoding="UTF-8"?> <svg width="32px" height="32px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <g id="Octicons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="device-camera" fill="#000000"> <path d="M15,3 L7,3 C7,2.45 6.55,2 6,2 L2,2 C1.45,2 1,2.45 1,3 C0.45,3 0,3.45 0,4 L0,13 C0,13.55 0.45,14 1,14 L15,14 C15.55,14 16,13.55 16,13 L16,4 C16,3.45 15.55,3 15,3 L15,3 Z M6,5 L2,5 L2,4 L6,4 L6,5 L6,5 Z M10.5,12 C8.56,12 7,10.44 7,8.5 C7,6.56 8.56,5 10.5,5 C12.44,5 14,6.56 14,8.5 C14,10.44 12.44,12 10.5,12 L10.5,12 Z M13,8.5 C13,9.88 11.87,11 10.5,11 C9.13,11 8,9.87 8,8.5 C8,7.13 9.13,6 10.5,6 C11.87,6 13,7.13 13,8.5 L13,8.5 Z" id="Shape"></path> </g> </g> </svg>
		</span>
		<span>A post on</span>
		<span class="p-publication">
			<?php if ( $site_name ) {
				echo $site_name;
			} else {
				echo 'Instagram';
			}
			?>
		</span>
</div>
<?php
if ( $photos && ! has_post_thumbnail( get_the_ID() ) && empty( $src_urls ) )  {
	// TODO: update gallery output for bulma columns id:4 gh:19
	echo gallery_shortcode(
		array(
			'id'      => get_the_ID(),
			'size'    => 'large',
			'columns' => 1,
			'link'    => 'file',
		)
	);
} else {
	if ( $embed ) {
		echo sprintf( '<blockquote class="e-summary">%1s</blockquote>', $embed );
	}
}