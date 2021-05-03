<?php
/*
Template Name: Kontakt
*/

get_header();
define("RECAPTCHA_V3_ACTION", 'send_email');
$send = isset($_POST['kech_msg']);
$message = "";
if ($send) {
	$token = $_POST['token'];
	$action = $_POST['action'];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	$arrResponse = json_decode($response, true);
	//echo $response."<br>";

	// verify the response
	if($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
	    send_mail();
			$message = "<p>Wiadomość została wysłana. Dziękujemy.</p>";
	} else {
			$message = "<p>Wystąpił błąd, wiadomość nie została wysłana.</p>";
	}
}

?>
<script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo RECAPTCHA_V3_KEY ?>"></script>
<div class="content_padding">
	<?php echo $message; ?>
	<div class="contact_info">
		<h1>KONTAKT</h1>
		<h2>Kościół Ewangelicznych Chrześcijan w Pszczynie</br>
		Dom Katechetyczny</h2>
		<p>
			Ul. Dworcowa 20 B</br>
			43-200 Pszczyna
		</p>
		<p>Nabożeństwa: Niedziela, godz. 10.00</p>
		<p>Numer konta: <b>67 1020 2528 0000 0002 0141 8060</b></p>
		<p>Inspektor Danych Osobowych Kościoła Ewangelicznych Chrześcijan w RP<br/>E-mail: InspektorDanych@kech.pl</p>
		<p><a href="http://www.pszczyna.kech.pl/wp-content/uploads/2018/05/Regulamin-ODO-w-KECh-16.04.2018.pdf">Regulamin ODO w KECh</a></p>
		<p><a href="http://www.pszczyna.kech.pl/wp-content/uploads/2018/05/INSTRUKCJA-ODO-w-KECh.pdf">Instrukcja ODO w KECh</a></p>
		<iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=pszczyna%20dworcowa%2020&key=<?php echo GOOGLE_MAP_KEY ?>"></iframe>
	</div>
	<div class="contact_form">
		<h1>FORMULARZ KONTAKTOWY</h1>
		<div class="contact_form_content">
			<?php
				if (false) { ?>
					<p>Dziękujemy, wiadomość została wysłana.</p>
				<?php
				} else {
				?>
					<form action="<?php the_permalink(); ?>" method="post" id="contactForm">
						<span class="contact_form_content_label">Imię i nazwisko:</span>
						<input class="contact_form_content_input" type="text" name="kech_name" id="kech_name"/>
						<span class="contact_form_content_label">E-mail:</span>
						<input class="contact_form_content_input" type="text" name="kech_email" id="kech_email"/>
						<span class="contact_form_content_label">Telefon:</span>
						<input class="contact_form_content_input" type="text" name="kech_tel" id="kech_tel"/>
						<span class="contact_form_content_label">Temat:</span>
						<input class="contact_form_content_input" type="text" name="kech_subject" id="kech_subject"/>
						<span class="contact_form_content_label">Wiadomość:</span>
						<textarea name="kech_msg" id="kech_msg"></textarea>
						<span class="contact_form_content_label2">Wyślij kopię do siebie:</span>
						<input type="checkbox" name="kech_to_self" id="kech_to_self"/>
						<input class="contact_form_content_button" type="submit" value="Wyślij" ></input>
					</form>
					<script>
			    	$('#contactForm').submit(function(event) {
			        event.preventDefault();
			        grecaptcha.ready(function() {
			            grecaptcha.execute('<?php echo RECAPTCHA_V3_KEY ?>', {action: '<?php echo RECAPTCHA_V3_ACTION ?>'}).then(function(token) {
			                $('#contactForm').prepend('<input type="hidden" name="token" value="' + token + '">');
			                $('#contactForm').prepend('<input type="hidden" name="action" value="<?php echo RECAPTCHA_V3_ACTION ?>">');
			                $('#contactForm').unbind('submit').submit();
			            });;
			        });
			  		});
  				</script>
			<?php
				}
			?>
		</div>
	</div>
	<div class="clear_left"></div>
</div>

<?php

get_footer();

?>
