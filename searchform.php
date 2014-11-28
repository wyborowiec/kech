<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<input type="hidden" value="" name="category_name" id="category_name" />
		<input type="hidden" value="all" name="post_status" id="post_status" />
	<input type="hidden" value="any" name="post_type" id="post_type" />
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Szukany tekst', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
		
		
	</label>
	
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
</form>