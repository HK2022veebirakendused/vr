<?php
	function create_filename($photo_name_prefix, $file_type){
		$timestamp = microtime(1) * 10000;
		return $photo_name_prefix .$timestamp ."." .$file_type;
	}
	
	function create_image($file, $file_type){
		$temp_image = null;
		if($file_type == "jpg"){
			$temp_image = imagecreatefromjpeg($file);
			echo "korras!";
		}
		if($file_type == "png"){
			$temp_image = imagecreatefrompng($file);
		}
		if($file_type == "gif"){
			$temp_image = imagecreatefromgif($file);
		}
		return $temp_image;
	}
	
	function resize_photo($src, $w, $h){
		//originaalsuurus
		$image_w = imagesx($src);
		$image_h = imagesy($src);
		$new_w = $w;
		$new_h = $h;
		
		//kas laiuse või kõrguse järgi
		if($image_w / $w > $image_h / $h){
			$new_h = round($image_h / ($image_w / $w));
		} else {
			$new_w = round($image_w / ($image_h / $h));
		}
		
		//uue suurusega image
		$temp_image = imagecreatetruecolor($new_w, $new_h);
		//kuhu imagesse, kust imagest, kuhu x, kuhu y, kust x , kust y, kuhu kui laialt, kuhu kui kõrgelt, kust kui laialt, kust kui kõrgelt
		imagecopyresampled($temp_image, $src, 0, 0, 0, 0, $new_w, $new_h, $image_w, $image_h);
		return $temp_image;
	}
	
	function save_image($image, $target, $file_type){
		$notice = null;
		if($file_type == "jpg"){
			if(imagejpeg($image, $target, 95)){
				$notice = "salvestamine õnnestus!";
			} else {
				$notice = "salvestamisel tekkis tõrge!";
			}
		}
		if($file_type == "png"){
			if(imagepng($image, $target, 6)){
				$notice = "salvestamine õnnestus!";
			} else {
				$notice = "salvestamisel tekkis tõrge!";
			}
		}
		if($file_type == "gif"){
			if(imagegif($image, $target)){
				$notice = "salvestamine õnnestus!";
			} else {
				$notice = "salvestamisel tekkis tõrge!";
			}
		}
		return $notice;
	}
	
	function store_photo_data($file_name, $alt, $privacy){
		$notice = null;
		$conn = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("INSERT INTO vr22_photos (userid, filename, alttext, privacy) VALUES (?, ?, ?, ?)");
		echo $conn->error;
		$stmt->bind_param("issi", $_SESSION["user_id"], $file_name, $alt, $privacy);
		if($stmt->execute()){
		  $notice = "Foto lisati andmebaasi!";
		} else {
		  $notice = "Foto lisamisel andmebaasi tekkis tأµrge: " .$stmt->error;
		}
		
		$stmt->close();
		$conn->close();
		return $notice;
	}
	
	
	
	
	
	
	