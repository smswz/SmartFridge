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
				$('#add_fridge').click(function(){
					$('#add_fridge').toggle();
					$("#add_new_fridge").slideDown('slow');
			});

			$('#add').click(function() {

				var fridge_data = {
					name : $('#new_fridge_name').val(),
				};

				$.ajax({
				   type: "POST",
				   url: "<?php echo site_url('dashboard/add_fridge'); ?>",
				   data: fridge_data,
				   success: function( msg ) {
						//alert(msg);
						
						if( msg ) {
							$( 'div.return_message' ).html( '<h3>Fridge Already Exist</h3><p>Please try a different name</p>' );
							$( 'div#fancyModal' ).addClass( "show" ).delay(2000).slideUp('fast');
						}else{
							$( 'div.return_message' ).html( '<h3>Fridge Added</h3>' );
							$( 'div#fancyModal' ).addClass( "show" ).delay(2000).slideUp('fast');
   
						}
				   }//end success function
				 });

				//return false;
			});//end click function

			$('#cancel').click(function() {			

				$('#add_new_fridge').slideUp('slow');
				$('#add_fridge').toggle('slow');
			});


			$('.delete').click(function() {
					var temp = (this.id).split(',');
					var fridge_data = {
						id : temp[0],
						name : temp[1]
					};

					//alert(fridge_data.id);

					$.ajax({
					   type: "POST",
					   url: "<?php echo site_url('dashboard/remove_fridge'); ?>",
					   data: fridge_data,
					   success: function(){
								$( 'div.return_message' ).html( '<h3>Fridge Removed</h3>' );
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
	<h1>Active Fridge List</h1>
		
		<table border="0" cellpadding="4" cellspacing="0" id="fridge_data_table">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Remove</th>
			</tr>

		
		
		<?php foreach( $fridges as $values ):
		 	echo '<tr><td>';
			echo $values->id;
			echo '</td>';
			echo '<td>';
			echo anchor('items/get_items_list/'. $values->id .'/'. $values->name, $values->name);
			echo '</td>';
			echo '<td><a class="delete" href="#" id="'. $values->id . ',' . $values->name .'" ><img src="' . base_url( 'images/delete.png' ) . '"</a></td></tr>';
		endforeach; ?>
		</table>	
		
		<!-- <input type="hidden" name="delete_fridge" id="delete_fridge" value="'. $values->id .'" /> -->
	
	<form id="add_new_fridge" method="post">
		<fieldset id="fridge-details">	
			
			<label for="name">Fridge Name:</label>
			<input type="text" name="name" value="" id="new_fridge_name" /> 		
		</fieldset><!--end user-details-->
		
		<input type="button" value="Add Fridge" name="button" id="add" class="submit" />
		<a href="#" id="cancel">(Cancel)</a>
	</form>
	<a href="#" id="add_fridge">Add A Fridge</a>
	
	
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