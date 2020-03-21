<?php
	header('Content-type: application/xml');
	echo "<"."?xml version=\"1.0\" encoding=\"utf-8\"?".">";
?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:media="http://search.yahoo.com/mrss/"  xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
    <channel>
    <title>KECH Pszczyna</title> 
	<description><![CDATA[Kościół Ewangelicznych Chrześcijan w Pszczynie]]></description>
    <link>http://pszczyna.kech.pl</link>
	<webMaster>kontakt@pszczyna.kech.pl</webMaster>
	<managingEditor>kontakt@pszczyna.kech.pl</managingEditor>
    <atom:link href="http://pszczyna.kech.pl/podcast" rel="self" type="application/rss+xml" />        	
	<itunes:author>KECH Pszczyna</itunes:author>
	<itunes:owner>
		<itunes:name>KECH Pszczyna</itunes:name>
		<itunes:email>kontakt@pszczyna.kech.pll</itunes:email>
	</itunes:owner>	
	<itunes:category text="Religion &amp; Spirituality">
		<itunes:category text="Christianity" />
	</itunes:category>
	<itunes:category text="Society &amp; Culture" />
	<itunes:explicit>no</itunes:explicit>
	<itunes:keywords><![CDATA[Kościół,Ewangelicznych,Chrześcijan,Ewangeliczny,Kościół,KECH,Pszczyna,kazania]]></itunes:keywords>		
    <image>
        <title>KECH Pszczyna</title>
        <link>http://pszczyna.kech.pl</link>
        <url>http://pszczyna.kech.pl/podcast/logo_1400px.jpg</url>
    </image>
    <language>pl</language>
<?php

	// $url = "http://localhost/podcast/get.php";
	$add = "";
	// $add = "domowa.pl/";
	$url = "http://".$add."pszczyna.kech.pl/podcast/get.php";
	
	$handle = curl_init();
	curl_setopt($handle, CURLOPT_URL, $url);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	$json = curl_exec($handle);
	curl_close($handle);
	echo $output;
	
	
	// echo $json;
	
	$obj = array();
	if($json != "") {
		$obj = json_decode($json);
	}
		
?>	
    <pubDate>Sun, 18 Dec 2016 22:00:00 +0100</pubDate>
    <lastBuildDate><?php echo date('D, d M Y H:i:s O', $obj->modify_time); ?></lastBuildDate>
    <ttl>15</ttl>
    <copyright><![CDATA[Copyright (C) <?php echo date("Y"); ?> KECH Pszczyna ]]></copyright> 
<?php

	if($json != "") {
		$items = $obj->all;
		for($ia = 0; $ia < count($items); $ia++) {
		
			$title = trim($items[$ia]->title);
			$date = date('D, d M Y H:i:s O', $items[$ia]->time);
			$description = $items[$ia]->artist;

			if(strpos($items[$ia]->link, ".mp3") <= 0) {
				continue;
			}
		
			if($items[$ia]->type == 'kazanie') {
				// $date = str_replace(".", "-", $items[$ia]->date);
				// $date = strtotime($date. " 10:00");
				// if(substr_count(date("d.m.Y", $date), "1970") > 0) continue;
				// $date = DateTime::createFromFormat('d.M.Y', $date);
			
				$miesiace = array( 'styczeń', 'luty', 'marzec', 'kwiecień', 'maj', 'czerwiec', 'lipiec', 'sierpień', 'wrzesień', 'październik', 'listopad', 'grudzień' );

				$miesiac = $miesiace[date('n', $items[$ia]->time) - 1];
				
				$title .= " (".date("j", $items[$ia]->time);
				$title .= " ".$miesiac." ";
				$title .= date("Y", $items[$ia]->time).")";
			
				// $title .= $miesiac; // " (".date("d " . $miesiac . " Y", $items[$ia]->time).")";
				// $description = $items[$ia]->title;
												
				
				// $date = date('D, d M Y H:i:s O', $date);
			}

			$title = trim($title);
			$description = trim($description);
			
			$keywords = str_replace("-", ",", $items[$ia]->type);
			
			echo "<item>\n";
			echo "  <title><![CDATA[".$title."]]></title>\n";
			echo "  <description><![CDATA[".$description."]]></description>\n";
			echo "  <itunes:summary><![CDATA[".$description."]]></itunes:summary>\n";
			echo "  <link>http://pszczyna.kech.pl</link>\n";
			echo "  <pubDate>".$date."</pubDate>\n";
			echo "  <guid isPermaLink=\"true\">".$items[$ia]->link."</guid>\n";
			echo "  <enclosure url=\"".$items[$ia]->link."\" length=\"3600000\" type=\"audio/mpeg\" />\n";
			echo "  <itunes:image href=\"".$items[$ia]->pic."\"/>\n";
			// echo "  <itunes:category text=\"News &amp; Politics\" />\n";
			echo "  <itunes:keywords>".$keywords."</itunes:keywords>\n";		
			echo "</item>\n";	
		}
	}

?>	
    </channel>
</rss>