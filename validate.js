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
	jQuery('.datepicker').datetimepicker({lang:'pl', timepicker:false, format:'Y-m-d'});
	jQuery('.timepicker').datetimepicker({lang:'pl', datepicker:false, format:'H:i'});
});