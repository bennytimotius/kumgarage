<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>KUM Garage | Profil</title>
<link rel="icon" href="<?php echo base_url('assets/images/icon.png') ?>" type="image/png" sizes="16x16">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="<?php echo base_url("assets/css/style.css") ?>" rel="stylesheet" type="text/css" media="all"/>
<link href="<?php echo base_url("assets/css/materialize.css") ?>"  rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.9.0.min.js") ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/move-top.js") ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/easing.js") ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/materialize.js") ?>"></script>

</head>
<body>
	 <div class="wrap">
        <div class="header">  	
		 <div class="header_image">
		   <img src="<?php echo base_url("assets/images/header.jpg") ?>" alt="" />
		   				<div class="header_desc">
				 			 <div class="logo">
				 				<a href="<?php echo base_url() ?>"><img src="<?php echo base_url("assets/images/logo.png") ?>" alt="" /></a>
							 </div>							
		     		    </div>			
		 		</div>				
              <div class="header-bottom">
		          <div class="menu">
					    <ul>
							<li><a href="<?php echo base_url() . 'user' ?>">Home</a></li>
							<li><a href="<?php echo base_url().'user/about' ?>">About</a></li>
							<li><a href="<?php echo base_url().'user/services' ?>">Services</a></li>
							<li><a href="<?php echo base_url().'user/booking' ?>">Booking</a></li>
							<li><a href="<?php echo base_url('login/logout'); ?>">Logout</a></li>
							<li class="active"><a href="<?php echo base_url().'user/viewProfile' ?>"><?php echo "Welcome, " . $this->session->userdata('nama') . " !" ?></a></li>
							<div class="clear"></div>
						</ul>
					</div>
		        <div class="social-icons">						
		                <ul>
		                    <li><a class="facebook" href="#" target="_blank"> </a></li>
		                    <li><a class="twitter" href="#" target="_blank"></a></li>
		                    <li><a class="googleplus" href="#" target="_blank"></a></li>
		                    <li><a class="rss" href="#" target="_blank"></a></li>
		                    <div class="clear"></div>
		                </ul>
		 		    </div>
		 		    <div class="clear"></div>
               </div>
             </div>
         </div>	
   <div class="wrap">
   	 <div class="main">
	    <div class="content">
	    	<h2>Edit Photo</h2>
	    	 <div class="section group">
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<?php echo form_open_multipart('user/updatePhoto/'); ?>
					    <form method="post" >
					    	<div>
							 	<span><label for="userfile">Photo</label></span>
							 	<img src="<?php echo base_url() . $pic; ?>" width="25%" height="25%">
							 	<span><input type="file" name="userfile" size="20" class="button"/></span>
							 	<input type="hidden" name="is_submit" value="1" />
							</div>
					    	<div>
						   		<span><input type="submit" value="Update"></span>
						  </div>
					    </form>
					<?php echo form_close(); ?>
				  </div>
  				</div>					    	   
      </div>
     </div> 
    </div>  

	    <div class="content">
	    <h2>Edit Profile</h2>
	    	 <div class="section group">
				<div class="col span_2_of_3">

				  <div class="contact-form">

				  <?php echo form_open_multipart('user/updateProfile/'); ?>
					    <form method="post" >
					    	<div>
						    	<span><label>Username</label></span>
						    	<span><input name="username" type="text" class="textbox" value=<?php echo $this->session->userdata('nama'); ?> autocomplete="off"></span>
						    </div>
					    	<div>
						    	<span><label>Nama</label></span>
						    	<span><input name="name" type="text" class="textbox" value="<?php echo $name; ?>" autocomplete="off"></span>
						    </div>
						   <div>
						    	<span><label>Password</label></span>
						    	<span><input name="password" type="text" class="textbox" placeholder="Insert New Password" autocomplete="off"></span>
						    </div>
						    <div>
						    	<span><label>Email</label></span>
						    	<span><input name="email" type="text" class="textbox" value="<?php echo $email; ?>" autocomplete="off"></span>
						    </div>
						    <div>
						    	<span><label>Nomor</label></span>
						    	<span><input name="nomor" type="number" class="textbox" value="<?php echo $nomor; ?>" autocomplete="off"></span>
						    </div>
						   <div>
						   		<span><input type="submit" value="Update"></span>
						  </div>
					    </form>
					    <?php echo form_close(); ?>
				  </div>
  				</div>					    	   
      </div>
     </div> 
    </div>  

  <div class="wrap">
   <div class="footer">
   	 <div class="footer_grides">
	      <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
					
				</div>
				<div class="col_1_of_4 span_1_of_4 timmings">
					<h3>Business Timmings</h3>
					          <ul>
						            <li>Monday : <span>9am - 5pm</span></li>
						     		<li>Tuesday : <span>9am - 5pm</span></li>					     			
						     		<li>Wednesday : <span>9am - 5pm</span></li>
						     		<li>Thursday : <span>9am - 5pm</span></li>					     		
						     		<li>Friday : <span>9am - 5pm</span></li>
						     		<li>Satuarday: <span>9am - 5pm</span></li>
						     		<li>Sunday : <span>Undefinite opening time (Occasionaly)</span></li>
						   	   </ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<div class="company_address">
				     	<h3>Location</h3>
						    	<p>Jl. Airlangga No. 103,</p>
						   		<p>Mataram, NTB</p>
						   		
				   		<p>Phone:(0370) 6608555</p>
				 	 	<p>Email: <span>zenabirg350@gmail.com</span></p>
				   		<p>Follow on: <span><a href="https://www.youtube.com/channel/UC98wIsRDWrqB8F91dTzNN4g">Youtube</a></span>
				   </div>
					  <div class="contact_info">
					    	  <div class="map">
							   	    <iframe width="300" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1038.5244962848178!2d116.1001561!3d-8.5935536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf64cbc3f429%3A0x9d26db67e31a1251!2sKUM+Garage!5e0!3m2!1sid!2sid!4v1494616123149"></iframe>
							  </div>
      				</div>      			
				 </div>
			  </div>		
			</div>
	    </div>
     </div>
		 <div class="copy_right">
		 	 <div class="wrap">
				<p>Benedict Timotius Christian - 5215100055 Institut Teknologi Sepuluh Nopember</p>
			 </div>
		</div>	
		<!------------ scroll Top ------------>
	 <script type="text/javascript">
		$(document).ready(function() {
			$().UItoTop({ easingType: 'easeOutQuart' });			
		});
	</script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
	<!------------ End scroll Top ------------>
  </div>   
</body>
</html>

