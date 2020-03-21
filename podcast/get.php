<?php

session_write_close();

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$result = array();

$last_modify_time = 0;

$url = "http://www.pszczyna.kech.pl/category/kazania/";

$items = read_source($url); 

$result["modify_time"] = $last_modify_time;
$result["all"] = $items;

//var_dump($result);

echo json_encode($result);

function read_source($url) {
	
	global $last_modify_time;
	
	// $html = file_get_contents($url);
	
	$handle = curl_init();
	curl_setopt($handle, CURLOPT_URL, $url);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	$html = curl_exec($handle);
	curl_close($handle);
	//echo $output;
	
	
	if(trim($html) == "") {
		return "";
	}
	
	$html = str_replace("\n", "", $html);
	$html = str_replace("\r", "", $html);
	
	$html_arr = explode('<h1>Kazania</h1>', $html);
	$html_arr = explode("<div id='hideoverflow'>", $html_arr[1]);
	$html = $html_arr[0];
	// $html = str_replace("</div>", "", $html);
	
	$html = trim($html);
	
	// echo $html;
	
	$html_arr = explode('<div class="kazania_list">', $html);
	
	$tmpArr = array();
	
	$preTime = time();
	
	foreach($html_arr as $item) {
		//for($ia = 0; $ia < 10; $ia++) {
		//	$item = $html_arr[$ia];
			
		// echo $item . "\r\n";
		// <strong>2019.02.03</strong>: tytuł: <a href="https://url.org/wp-content/uploads/2019/02/2019-02-03_Iz_51_9-16_Jarmulak.mp3">Księga Izajasza 51,9-16; B. Nazwisko</a></p>
		
		// $html = strip_tags($html);
		
		
		/*
		
	<div class="kazania_list">
		<div class="item_title" >
		Czesław Bassara - Ja będę radował się w Panu (Hab. 3,18)		</div>
		<div class="item_details">
			<div class="kazania_date">
				Data: 2020-03-15			</div>
			<div id="1399" class="kazania_button">
				<a class="follow_link2 play_button" href=""><img class="kazania_icon" id="1399" src="http://www.pszczyna.kech.pl/wp-content/themes/kech/pics/odtworz.png"/> Odtwórz</a>
			</div>
			<div class="kazania_button">
				<a class="follow_link2" href="http://www.pszczyna.kech.pl/wp-content/uploads/2020/03/Czesław-Bassara-Ja-będę-radował-się-w-Panu.mp3" download><img src="http://www.pszczyna.kech.pl/wp-content/themes/kech/pics/pobierz.png"/> Pobierz</a>
			</div>
			<div class="kazania_clear"></div>
		</div>
		<div id="1399" class="kazania_player">
			<!--[if lt IE 9]><script>document.createElement('audio');</script><![endif]-->
<audio class="wp-audio-shortcode" id="audio-1399-1" preload="none" style="width: 100%;" controls="controls"><source type="audio/mpeg" src="http://www.pszczyna.kech.pl/wp-content/uploads/2020/03/Czesław-Bassara-Ja-będę-radował-się-w-Panu.mp3?_=1" /><a href="http://www.pszczyna.kech.pl/wp-content/uploads/2020/03/Czesław-Bassara-Ja-będę-radował-się-w-Panu.mp3">http://www.pszczyna.kech.pl/wp-content/uploads/2020/03/Czesław-Bassara-Ja-będę-radował-się-w-Panu.mp3</a></audio>		</div>
	</div>		
		
		
		
		
		*/
		
		$item_arr = explode('Data:', $item, 2);
		
		if(count($item_arr) < 2) continue;
		
		$date_str = fromTagByAttrName($item, "class", "kazania_date");
		$date_arr= explode(':', $date_str);
		$date = trim($date_arr[1]);
		if($last_modify_time == 0) $last_modify_time = strtotime($date." 10:00");;
		
		$link_arr = explode('type="audio', $item, 2);
		$link_arr = explode('>', $link_arr[1], 2);  
		$link = trim(strip_tags($link_arr[1]));
		// $link_arr = explode('<a href="',  $link);
		// $fname = $link_arr[count($link_arr) - 1];
		
		$title_all = fromTagByAttrName($item, "class", "item_title");
		
		$title_arr= explode('-', $title_all);
		$artist = trim($title_arr[0]);
		$title = trim($title_arr[1]);
		
		$link_arr = explode('/',  $link);
		$fname = $link_arr[count($link_arr) - 1];
		if(strpos($fname, ".mp3") < 0) continue; // only mp3
	
		$id = ""; 
		$type = "kazanie";
		$time = strtotime($date." 10:00");
		
		$link_img = "http://pszczyna.kech.pl/podcast/icon_mp3.png";
		if($artist == "Czesław Bassara OFF" ) {
			$link_img = "http://pszczyna.kech.pl/podcast/czbassara_mp3.png";
		}
		
		$obj = (object) array('id' => $id, 'title' => $title, 'link' => $link, 'artist' => $artist, 'fname' => $fname, 'pic' => $link_img, 'type' => $type, 'time' => $time);

		array_push($tmpArr, $obj);
		
		// var_dump([$date, $url, $title]);
		
	}
	
	
	return $tmpArr ;

}


function fromTagByAttrName($html, $attrName, $attrValue) {
	$item_arr = explode($attrName.'="'.$attrValue.'', $html, 2);
	$item_arr = explode('>', $item_arr[1], 2);  
	$item_arr = explode('<', $item_arr[1], 2);  
	$value = trim(strip_tags($item_arr[0]));
	return $value;
}



