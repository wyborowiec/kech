<div class="left_right_padding box_tag">
	<div class="box_tag_caption">Najpopularniejsze tagi:</div>
	<div class="box_tag_content">
	<?php 
		//print_r(get_tags()); 
		/*foreach (get_tags() as $tag_obj){
			echo " $tag_obj->name ";
		}*/
		echo " Chyłka Bassara ";
	?>
	</div>
</div>

<div class="box_search left_right_padding">
<form>
	<input type="text" />
	<input type="submit" value="Szukaj >" />
</form>
</div>

</div>
<?php wp_footer(); ?>
</body>
</html>

