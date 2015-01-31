<?php
/*
Template Name: Kontakt
*/

get_header(); ?>

<div class="content_padding">
	<div class="contact_info">
		<h1>KONTAKT</h1>
		<h2>Kościół Ewangelicznych Chrześcijan w Pszczynie</br>
		Dom Katechetyczny</h2>
		<p>
			Ul. Dworcowa 20 B</br>
			43-200 Pszczyna
		</p>
		<p>Nabożeństwa: Niedziela, godz. 10.00</p>
		<p>Numer konta: 67 1020 2528 0000 0002 0141 8060</p>
		<div id="googleMap" style="width:430px;height:330px;"></div>
	</div>
	<div class="contact_form">
		<h1>FORMULARZ KONTAKTOWY</h1>
		<div class="contact_form_content">
			<form method="get" action="<?php echo home_url( '/' ); ?>">
				<span class="contact_form_content_label">Imię i nazwisko:</span>
				<input class="contact_form_content_input" type="text" name="name"/>
				<span class="contact_form_content_label">E-mail:</span>
				<input class="contact_form_content_input" type="text" name="email"/>
				<span class="contact_form_content_label">Telefon:</span>
				<input class="contact_form_content_input" type="text" name="tel"/>
				<span class="contact_form_content_label">Temat:</span>
				<input class="contact_form_content_input" type="text" name="subject"/>
				<span class="contact_form_content_label">Wiadomość:</span>
				<textarea name="msg" ></textarea>
				<span class="contact_form_content_label2">Wyślij kopię do siebie:</span>
				<input type="checkbox" name="to_self" />
				<input class="contact_form_content_button" type="submit" value="Wyślij" />
			</form>
		</div>
	</div>
	<div class="clear_left"></div>
</div>

<?php

get_footer();

?>