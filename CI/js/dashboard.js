
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
<link rel="stylesheet" href="http://localhost:8888/SmartFridge/CI/css/style.css" type="text/css">
		
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
