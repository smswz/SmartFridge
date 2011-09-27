<?php echo doctype( 'html5' ); ?>
<meta charset=utf-8>
<html lang=en>
<head>
	<title>Smart Fridge Admin Panel</title>
	
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css"/>
	<?php
			echo link_tag( 'http://fonts.googleapis.com/css?family=Droid Sans&subset=latin' );
	?>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

	<script>
		//for IE
		document.createElement('header');
		document.createElement('footer');

		$(document).ready(function(){
				$('#add_item').click(function(){
					$('#add_item').toggle();
					$("#add_new_item").slideDown('slow');
			});

			$('#add').click(function() {

				var item_data = {
					name : $('#new_item_name').val(),
					quantity : $('#new_item_name').val()
				};

				$.ajax({
				   type: "POST",
				   url: "<?php echo site_url('items/add_item'); ?>",
				   data: item_data,
				   success: function( msg ) {
						//alert(msg);
						
						if( msg ) {
							$( 'div.return_message' ).html( '<h3>Item Already Exist</h3><p>Please update the quantity instead</p>' );
							$( 'div#fancyModal' ).addClass( "show" ).delay(2000).slideUp('fast');
						}else{
							$( 'div.return_message' ).html( '<h3>Item Added</h3>' );
							$( 'div#fancyModal' ).addClass( "show" ).delay(2000).slideUp('fast');
   
						}
				   }//end success function
				 });

				//return false;
			});//end click function

			$('#cancel').click(function() {			

				$('#add_new_item').slideUp('slow');
				$('#add_item').toggle('slow');
			});


			$('.delete').click(function() {
					var temp = (this.id).split(',');
					var item_data = {
						id : temp[0],
						name : temp[1]
					};

					//alert(fridge_data.id);

					$.ajax({
					   type: "POST",
					   url: "<?php echo site_url('item/remove_item'); ?>",
					   data: fridge_data,
					   success: function(){
								$( 'div.return_message' ).html( '<h3>Item Removed</h3>' );
								$( 'div#fancyModal' ).addClass( "show" ).delay(2000).slideUp('fast');
					   }
					 });

			});
			//remove the div and hide the dropdown box that notifies the user that a new fridge was added
			$("#closeFancy").click(function() {
				$("div#fancyModal").removeClass("show");
				return false;
			});

		});
	</script>
	
	
</head>
<body>
	<header>
	</header>
	<div id="content">
	<h1>Item List for <?php echo '<span style="color: #BBDB68; ">' . $fridge_name . '</span>'; ?></h1>
		
		<table border="0" cellpadding="4" cellspacing="0" id="item_data_table">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Quantity</th>
			<th>Added</th>
			<th>Current Amount</th>
			<th>Total</th>
			<th>Remove</th>
			</tr>

		<?php foreach( $items as $values ):
			echo '<tr><td>' . $values->id . '</td>';
			echo '<td>' . $values->name . '</td>';
			echo '<td>' . $values->quantity . '</td>';
			echo '<td>' . $values->date_added . '</td>';
			echo '<td>' . $values->current_amount . '</td>';
			echo '<td>' . $values->total . '</td>';
			echo '<td>'. anchor('items/delete_item/'. $values->id . '/' . $fridge_id .'/'. $fridge_name, '<img src="' . base_url( 'images/delete.png' ) . '">'); 		
			echo '</td></tr>';
		endforeach; ?>
		</table>	
	
	<form id="add_new_item" method="post">
		<fieldset id="fridge-details">	
			
			<label for="name">Item Name:</label>
			<input type="text" name="name" value="" id="new_item_name" /> 	
			<label for="name" style="padding-left: 24px;">Quantity:</label>
			<input type="text" name="quantity" value="" id="new_item_quantity" />	
		</fieldset><!--end user-details-->
		
		<input type="button" value="Add Item" name="button" id="add" class="submit" />
		<a href="#" id="cancel">(Cancel)</a>
	</form>
	<a href="#" id="add_item">Add An Item</a>
	
	
	<div id="fancyModal" class="modal">
		<img src="<?php echo base_url('images/lightbulb.png');?>" id="lightbulb"/>
			<div class="return_message">
				<!-- data generated by javascript based on return values of ajax -->
			</div>
			
			<!--<input type="button" value="Ok" class="submit" id="closeFancy" /> -->
		</div>
		<!-- <a href="" id="showFancyModal" class="super green button"><span>Show the Fancy Modal</span></a> -->
		
		<div id="fridge_deleted_notifier">
			<h3></h3>
		</div><!-- fridge_deleted_notifier -->
	</div><!-- content -->
	<footer>
	</footer>
</body>
</html>