jQuery(document).ready(function() {
    jQuery(".kazania_button").click(function(){
		jQuery("#" + this.id + ".kazania_player").slideToggle("slow");
		var mtl = jQuery(".mejs-time-rail").width("755");
		var mtl = jQuery(".mejs-time-total").width("745");
	});
	
});