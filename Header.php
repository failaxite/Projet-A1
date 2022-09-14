<!DOCTYPE html>
<html lang="en">
	<head>
		<title>InSpace</title>
		<meta charset="UTF-8" />
		<link href="https://www.cssscript.com/demo/sticky.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" href="assets/css/test.css" />
		<?php
			if(isset($appJs) && !empty($appJs) && $appJs === true){ //si il y a $appjs = true sur une page
				echo '<script src="assets/js/app.js" defer></script>'; // activation du script app.js
			}
		?>
		<meta name="format-detection" content="telephone-no" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
		/>
	</head>