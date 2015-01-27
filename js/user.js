jQuery(document).ready(function() {
    jQuery(".kazania_button").click(function(){
		jQuery("#" + this.id + ".kazania_player").slideToggle("slow");
		jQuery(".mejs-time-rail").width("755");
		jQuery(".mejs-time-total").width("745");
		var src = jQuery("#" + this.id + ".kazania_icon").attr("src");
		var patt = /odtworz.png/;
		var res;
		if (patt.test(src)) {
			res = src.replace(/[a-z]+\.png/, "player.png");
		} else {
			res = src.replace(/[a-z]+\.png/, "odtworz.png");
		}
		jQuery("#" + this.id + ".kazania_icon").attr("src", res);
	});
	jQuery(".play_button").click(function(event){
		event.preventDefault();
	});
	
});