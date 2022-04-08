<?php
	require_once "fnc_general.php";
	
	$author_name = "Andrus Rinde";
	
	//piltide kataloog
	$photo_dir = "hkphotos/";
	$all_files = read_dir_content($photo_dir);
	//var_dump($all_files);
	$allowed_photo_types = ["image/jpeg", "image/png"];
	$photo_files = check_if_photo($all_files, $photo_dir, $allowed_photo_types);
	
	//näitame üht juhuslikku fotot!
	$photo_count = count($photo_files);
	//echo $photo_count;
	$random_num = mt_rand(0, $photo_count - 1);
	$photo_html = "\n" .'<img src="' .$photo_dir .$photo_files[$random_num] .'" alt="Haapsalu kolledž"  class="photoframe">' ."\n";
	
	$full_time_now = date("d.m.Y H:i:s");
	$weekday_now = date("N");
	//echo $weekday_now;
	$weekday_names_et = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	//echo $weekday_names_et[$weekday_now - 1];
	$day_category = "lihtsalt päev";
	if($weekday_now <= 5){
		$day_category = "kooli- või tööpäev";
	} else {
		$day_category = "normaalsete inimeste puhkepäev";
	}
	
	$semester_begin = new DateTime("2022-1-31");
	$semester_end = new DateTime("2022-6-30");
	$semester_duration = $semester_begin->diff($semester_end);
	//echo $semester_duration;
	$semester_duration_days = $semester_duration->format("%r%a");
	//echo $semester_duration_days;
	$from_semester_begin = $semester_begin->diff(new DateTime("now"));
	$from_semester_begin_days = $from_semester_begin->format("%r%a");
	
	if($from_semester_begin_days > 0){
		if($from_semester_begin_days <= $semester_duration_days){
			$semester_meter = "\n" .'<p>Semester edeneb: <meter min="0" max="' .$semester_duration_days .'" value="' .$from_semester_begin_days .'"></meter>.</p>' ."\n";
		} else {
			$semester_meter = "\n <p>Semester on lõppenud!</p> \n";
		}
	} elseif($from_semester_begin_days === 0) {
		$semester_meter = "\n <p>Semester algab täna!</p> \n";
	} else {
		$semester_meter = "\n <p>Semestri alguseni on jäänud " . (abs($from_semester_begin_days) + 1) ." päeva!</p> \n";
	}
	
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $author_name; ?> teeb veebi</title>
    <link rel="stylesheet" type="text/css" href="styles/general.css">
</head>
<body>
	<header>
		<img id="banner" src="../../media/pic/rif21_banner.png" alt="RIF21 bänner">
		<h1><?php echo $author_name; ?> arendab veebi</h1>
		<details>
			<summary>Selle lehe mõte</summary>
			<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat materjali!</p>
		</details>
		
        <hr>
	</header>
    
    <nav>
        <h2>Olulised lingid</h2>
        <ul>
            <li><a href="https://www.tlu.ee/haapsalu">Tallinna Ülikooli Haapsalu kolledž</a></li>
            
        </ul>
    </nav>
        
	<main>
		<section>
			<h2>Natuke aja kohta</h2>
			<p>Lehe avamise hetk: <?php echo $weekday_names_et[$weekday_now - 1] .", " .$full_time_now .", on " .$day_category; ?>.</p>
			<?php echo $semester_meter; ?>
			
		</section>
		<section>
			<h2>Vaated Haapsalu kolledžile</h2>
			<?php echo $photo_html; ?>
			<figure>
				<img src="../../media/photos/HK_600x400/IMG_3238.JPG" alt="TLÜ Haapsalu kolledži hoone" class="photoframe">
				<figcaption>Vaade TLÜ Haapsalu kolledži hoonele Lihula poolt</figcaption>
			</figure>
			<figure>
				<img src="../../media/photos/HK_600x400/IMG_4761.JPG" alt="TLÜ Haapslau kolledži arvutiklass 205" class="photoframe">
				<figcaption>Vaade TLÜ Haapsalu kolledži arvutiklassi</figcaption>
			</figure>
		</section>
<?php
	require_once "pagefooter.php";
?>
