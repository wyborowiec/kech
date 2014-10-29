jQuery(document).ready(function() {
    jQuery("#post").submit(function( event ) {
		alert( "Handler for .submit() called." );
		event.preventDefault();
	})
});