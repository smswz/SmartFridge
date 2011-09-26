<?php echo doctype( 'html5' ); ?>
<meta charset=utf-8>
<html lang=en>
<head>
	<title>Smart Fridge Admin Panel</title>
	
	<?php 	//echo link_tag( 'css/style.css' ); 
			echo link_tag( 'http://fonts.googleapis.com/css?family=Droid Sans&subset=latin' );
	?>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

	<style>
		* { margin: 0px; padding: 0px; font-family: 'Droid Sans', sans-serif;}
	
	body { 
		margin: 0 auto; 
		background: #f5f5f5; 	
		color: #555;	 
		width: 800px; 
				
		/* make reference to the Yanone Kaffeesatz font */
		font-family: 'Yanone Kaffeesatz', arial, sans-serif;
	}
	
	h1 { 
		color: #555; 
		margin: 0 0 20px 0; 
	}	
		
	label {	
		font-size: 20px;
		color: #666; 
	}
	
	#content { 
		float: left;
		border: 1px solid #ddd; 
		padding: 30px 40px 20px 40px; 
		margin: 75px 0 0 0;
		width: 715px;
		background: #fff;
				
		/* -- CSS3 - define rounded corners for the form -- */	
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px; 		
		
		/* -- CSS3 - create a background graident -- */
		background: -webkit-gradient(linear, 0% 0%, 0% 40%, from(#EEE), to(#FFFFFF)); 
		background: -moz-linear-gradient(0% 40% 90deg,#FFF, #EEE); 
		
		/* -- CSS3 - add a drop shadow -- */
		-webkit-box-shadow:0px 0 50px #ccc;
		-moz-box-shadow:0px 0 50px #ccc; 
		box-shadow:0px 0 50px #ccc;		 		
	}	

	#add_new_fridge {
		margin: 20px 0 0 107px;
		display: none;
	}
	
	#add_fridge{
		color: #666;
		margin-left: 107px;
	}
	
	#add_fridge a:hover {
		color: #000;
	}
	
	#add_fridge:visited {
		color: #ddd;
	}
	
	#cancel {
		margin: 25px 0 0 12px;
		font-size: 10px;
		color: #666;
		float: left;
	}
	
	fieldset { border: none; }
	
	#fridge-details { 
		float: left;
		width: 370px; 
	}
	
	#user-message { 
		float: right;
		width: 405px;
	}
	
	input, textarea { 		
		padding: 8px; 
		margin: 4px 0 20px 0; 
		background: #fff; 
		width: 200px; 
		font-size: 14px; 
		color: #555; 
		border: 1px #ddd solid;
		
		/* -- CSS3 Shadow - create a shadow around each input element -- */ 
		-webkit-box-shadow: 0px 0px 4px #aaa;
		-moz-box-shadow: 0px 0px 4px #aaa; 
		box-shadow: 0px 0px 4px #aaa;
		
		/* -- CSS3 Transition - define what the transition will be applied to (i.e. the background) -- */		
		-webkit-transition: background 0.3s linear;
		-webkit-transition: -webkit-box-shadow 0.3s linear;
		-webkit-transition: border 0.3s linear;
	}
	
	textarea {		
		width: 390px; 
		height: 175px; 		 		
	}
	
	input:hover, textarea:hover { 
		background: #eee; 
		border-color: #BBDB68;
		-webkit-box-shadow: #BBDB68;

	}
		
	input.submit { 	
		width: 130px; 
		color: #eee; 
		text-transform: uppercase; 
		float: left;
		margin: 5px 0 0 0px;
		background-color: #18a5cc;
		border: none;
		
		/* -- CSS3 Transition - define which property to animate (i.e. the shadow)  -- */
		-webkit-transition: -webkit-box-shadow 0.3s linear;
		
		/* -- CSS3 - Rounded Corners -- */
		-moz-border-radius: 4px; 
		-webkit-border-radius: 4px;
		border-radius: 4px; 
						
		/* -- CSS3 Shadow - create a shadow around each input element -- */ 
		background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#BBDB68), to(#94B737)); 
		background: -moz-linear-gradient(25% 75% 90deg,#0a85a8, #18a5cc);		
	} 
	
	input.submit:hover { 		
		-webkit-box-shadow: 0px 0px 20px #555;
		-moz-box-shadow: 0px 0px 20px #aaa; 
		box-shadow: 0px 0px 20px #555;	
		cursor:  pointer; 
	} 	
	
	table {
		overflow:hidden;
		border:1px solid #d3d3d3;
		background:#fefefe;
		width:70%;
		margin:5% auto 20px;
		-moz-border-radius:5px; /* FF1+ */
		-webkit-border-radius:5px; /* Saf3-4 */
		border-radius:5px;
		-moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
		-webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
	}
	
	th, td {padding:18px 28px 18px; text-align:center; }
	
	th {padding-top:22px; text-shadow: 1px 1px 1px #fff; background:#e8eaeb;}
	
	td {border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0; -webkit-transition: background 0.3s linear;}
	
	tr {background:#f6f6f6; -webkit-transition: background 0.3s linear;}
	td:hover {background:#f5f5f5;}
	
	tr.odd-row td {background:#f6f6f6;}
	
	td.first, th.first {text-align:left}
	
	td.last {border-right:none;}
	
	/*
	Background gradients are completely unnessary but a neat effect.
	*/
	
	td {
		background: -moz-linear-gradient(100% 25% 90deg, #fefefe, #f9f9f9);
		background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f9f9f9), to(#fefefe));
	}
	
	tr.odd-row td {
		background: -moz-linear-gradient(100% 25% 90deg, #f6f6f6, #f1f1f1);
		background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f1f1f1), to(#f6f6f6));
	}
	
	th {
		background: -moz-linear-gradient(100% 20% 90deg, #e8eaeb, #ededed);
		background: -webkit-gradient(linear, 0% 0%, 0% 20%, from(#ededed), to(#e8eaeb));
	}
	
	/*
	I know this is annoying, but we need dditional styling so webkit will recognize rounded corners on background elements.
	Nice write up of this issue: http://www.onenaught.com/posts/266/css-inner-elements-breaking-border-radius
	
	And, since we've applied the background colors to td/th element because of IE, Gecko browsers also need it.
	*/
	
	tr:first-child th.first {
		-moz-border-radius-topleft:5px;
		-webkit-border-top-left-radius:5px; /* Saf3-4 */
	}
	
	tr:first-child th.last {
		-moz-border-radius-topright:5px;
		-webkit-border-top-right-radius:5px; /* Saf3-4 */
	}
	
	tr:last-child td.first {
		-moz-border-radius-bottomleft:5px;
		-webkit-border-bottom-left-radius:5px; /* Saf3-4 */
	}
	
	tr:last-child td.last {
		-moz-border-radius-bottomright:5px;
		-webkit-border-bottom-right-radius:5px; /* Saf3-4 */
	}
	
	#fancyModal {
		display: block; width: 560px;
		margin: 0 auto;
		position: absolute; top: -260px; left: 270px;
		padding: 50px 20px 20px;
		border: solid 1px #999;
		background: -webkit-gradient(linear, left top, left bottom, from(rgb(255,255,255)), to(rgb(230,230,230)));
		-webkit-box-shadow: 0px 3px 6px rgba(0,0,0,0.25);
		-webkit-border-bottom-left-radius: 6px;
		-webkit-border-bottom-right-radius: 6px;
		-webkit-transition: -webkit-transform 0.6s ease-out;
		-webkit-transform: translateY(-570px);
	}
	#closeFancy {
		float: right;
	}

	div#fancyModal h3, div#fancyModal p { text-shadow: 0px 1px 1px #fff; color: rgba(0,0,0,0.75); padding-bottom: 20px }
	div.modal a.button { float: right; overflow: hidden; }
	#fancyModal.show { -webkit-transform: translateY(250px); -moz-transform: translatey(250px); }
	
	div#fancyModal h3 {
		padding-left: 180px;
	}
	
	div#fancyModal p {
		padding-left: 177px;
	}
	#lightbulb {
		position: absolute;
		top: 20px;
		padding-left: 20px;
	}
	
	</style>
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
		
		<table border="0" cellpadding="4" cellspacing="0">
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
			echo $values->name;
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