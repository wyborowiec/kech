jQuery(document).ready(function() {
    jQuery("#post").submit(function( event ) {
		var valid = true;
		jQuery("[nonempty]").each(function(){
			if (!this.value){
				valid = false;
				if (!jQuery(this).hasClass("required-label")){
					jQuery(this).after("<label for='meta-text' style='color: red'>Pole wymagane</label>");
					jQuery(this).addClass("required-label");
				}
				this.focus();
			}
		});
		if (!valid){
			event.preventDefault();
		}
	});
	jQuery('.datepicker').datetimepicker({lang:'pl', timepicker:false, format:'d.m.Y'});
	jQuery('.timepicker').datetimepicker({lang:'pl', datepicker:false, format:'H:i'});
	/*jQuery(document).ready(function() {
		jQuery('#upload_image_button').click(function() {
			window.send_to_editor = function(html) {
				imgurl = jQuery('img',html).attr('src');
				jQuery('#upload_image').val(imgurl);
				tb_remove();
			}
			//http://localhost/wordpress/wp-admin/post.php?post=148&action=edit#
			tb_show('', 'post.php?post=148&action=edit#');
			return false;
		});
	});*/
});