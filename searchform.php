<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<input type="search" placeholder="Szukany tekst" value="<?php echo get_search_query() ?>" name="s"/>
	<input type="submit" value="Szukaj &rsaquo;" />
</form>