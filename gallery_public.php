<?php
    require_once "use_session.php";	
	require_once "../../../cnf.php";
    //require_once "fnc_general.php";
	require_once "fnc_gallery.php";
	
	$privacy = 2;
    
    $page = 1;
    $limit = 10;
    $photo_count = count_photos($privacy);
    //kontrollime, mis lehel oleme ja kas selline leht on võimalik
    if(!isset($_GET["page"]) or $_GET["page"] < 1){
        $page = 1;
    } elseif(round($_GET["page"] - 1) * $limit >= $photo_count){
        $page = ceil($photo_count / $limit);
    } else {
        $page = $_GET["page"];
    }
	
	
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $_SESSION["firstname"] ." " .$_SESSION["lastname"]; ?> teeb veebi</title>
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<link rel="stylesheet" type="text/css" href="styles/gallery.css">
</head>
<body>
	<header>
		<img id="banner" src="../../media/pic/rif21_banner.png" alt="RIF21 bänner">
		<h1><?php echo $_SESSION["firstname"] ." " .$_SESSION["lastname"]; ?> arendab veebi</h1>
		<details>
			<summary>Selle lehe mõte</summary>
			<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat materjali!</p>
		</details>
		
		<hr>
	</header>
	
	<nav>
		<h2>Olulised lingid</h2>
		<ul>
			<li><a href="home.php">Avaleht</a></li>
			<li><a href="?logout=1">Logi välja!</a></li>
			<li><a href="https://www.tlu.ee/haapsalu">Tallinna Ülikooli Haapsalu kolledž</a></li>
			
		</ul>
	</nav>
	<main>
	<section>
			

		<h2>Avalike fotode galerii</h2>
		<p>
			<?php
				//Eelmine leht | Järgmine leht
				//<span>Eelmine leht</span> | <span><a href="?page=2">Järgmine leht</a></span>
				if($page > 1){
					echo '<span><a href="?page=' .($page - 1) .'">Eelmine leht</a></span>';
				} else {
					echo "<span>Eelmine leht</span>";
				}
				echo " | ";
				if($page * $limit < $photo_count){
					echo '<span><a href="?page=' .($page + 1) .'">Järgmine leht</a></span>';
				} else {
					echo "<span>Järgmine leht</span>";
				}
			?>
		</p>
		<div class="gallery">
			
			<?php echo read_public_photo_thumbs($privacy, $page, $limit); ?>
		</div>
	</section>
	<?php
		require_once "pagefooter.php";
	?>