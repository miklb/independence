<form class="navbar-item" role="search" method="get" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="field has-addons">
	 	<p class="control">
			<input class="input" name="s" id="search" type="search" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Find it now!">
		</p>
		<p class="control">
		<button class="button is-info" type="submit">
		Search
		</button>
	</p>
	</div>
</form>
