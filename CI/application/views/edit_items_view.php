<?php echo doctype( 'html5' ); ?>
<meta charset=utf-8>
<html lang=en>
<head>
	<title>Smart Fridge Admin Panel</title>
	
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css"/>
	<?php echo link_tag( 'http://fonts.googleapis.com/css?family=Droid Sans&subset=latin' ); ?>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

	<script>
		//for IE
		document.createElement( 'header' );
		document.createElement( 'footer' );
	</script>
	
</head>
<body>
	<header>
	</header>
	<div id="content">
		<form id="edit_item" method="post">
			<fieldset id="item-details">	
				<label for="name">Item Name:</label>
				<input type="text" name="name" value="<?php echo $name; ?>" id="edit_name" /> 	
				<label for="name">Current Amount:</label>
				<input type="text" name="name" value="<?php echo $name; ?>" id="edit_current_amt" />
				<label for="name">Total to Date:</label>
				<input type="text" name="name" value="<?php echo $name; ?>" id="edit_total" />
			</fieldset><!--end item-details-->
		
			<input type="button" value="Submit Changes" name="button" id="submit_item_changes" class="submit" />
		</form>
		<div class="go_back"><?php echo anchor('item/cancel/' . $fridge_id . '/' . $fridge_name, ' Cancel'); ?></div><!-- end go_back -->
	</div><!-- content -->
	<footer>
	</footer>
</body>
</html>