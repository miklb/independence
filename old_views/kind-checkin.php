<?php
/*
 * Checkin Template
 *
 */

$meta = new Kind_Meta( get_the_ID() );
$cite = $meta->get_cite();
$url = $meta->get_url();
$embed = self::get_embed( $meta->get_url() );

?>

<div class="response p-checkin">
	<div class="kind-heading">
			<span class="icon is-medium">
				<?xmlversion="1.0"encoding="UTF-8"?><svgwidth="28px"height="32px"viewBox="001416"version="1.1"xmlns="http://www.w3.org/2000/svg"xmlns:xlink="http://www.w3.org/1999/xlink"><gid="Octicons"stroke="none"stroke-width="1"fill="none"fill-rule="evenodd"><gid="milestone"fill="#000000"><pathd="M8,2L6,2L6,0L8,0L8,2L8,2ZM12,7L2,7C1.45,71,6.551,6L1,4C1,3.451.45,32,3L12,3L14,5L12,7L12,7ZM8,4L6,4L6,6L8,6L8,4L8,4ZM6,16L8,16L8,8L6,8L6,16L6,16Z"id="Shape"></path></g></g></svg>
			</span>
			<?php
			if( ! $embed ) {
				if ( ! array_key_exists( 'name', $cite ) ) {
				$cite['name'] = self::get_post_type_string( $url );
	}
	if ( isset( $url ) ) {
		echo sprintf( '<a href="%1s" class="p-name u-url">%2s</a>', $url, $cite['name'] );
	} else {
		echo sprintf( '<span class="p-name">%1s</span>', $cite['name'] );
	}
}
?>
</div>


<?php
