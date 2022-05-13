<?php
	require_once "use_session.php";	
	require_once "../../../cnf.php";
	require_once "fnc_news.php";
	//require_once "fnc_general.php";
	//$_POST
	//$_GET
	//var_dump($_POST);
	//echo $_POST["newsInput"];
	$amount = 5;
	$author_name = "Andrus Rinde";	
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $_SESSION["firstname"] ." " .$_SESSION["lastname"] ?> teeb veebi</title>
    <link rel="stylesheet" type="text/css" href="styles/general.css">
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
			<h2>Uudised</h2>
			<?php echo read_news($amount); ?>
		</section>
<?php
	require_once "pagefooter.php";
?>
