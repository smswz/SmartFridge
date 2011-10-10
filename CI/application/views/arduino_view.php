<?php echo doctype( 'html5' ); ?>
<meta charset=utf-8>
<html lang=en>
<head>
	<title>Smart Fridge Test Page</title>
	
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css"/>
	<?php echo link_tag( 'http://fonts.googleapis.com/css?family=Droid Sans&subset=latin' ); ?>	
</head>
<body>
	<header>
	</header>
	<div id="content">
		<?php 
			if(isset($egg) && $egg == TRUE){
				echo "Fridge ID: " . $fridge_id . "<br />Egg ID: " . $egg_id . "<br />Total Eggs: " . $egg_total . "<br />";
			}else {
				echo "Fridge ID: " . $fridge_id . "<br />Temp ID: " . $temp_id . "<br />Temp: " . $temp . "<br />";
			}
	 	?>
	</div><!-- content -->
	<footer>
	</footer>
</body>
</html>