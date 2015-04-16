<?php
    include 'includes/_header.php';
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="css/contact_form.css" />
<script src="js/contact_form.js"></script>          
           <div>
<div>
<div id="mainform">
<h2>Any Questions Just Send Us a Message</h2>
<!-- Required Div Starts Here -->
<form id="form">
<h3>Contact Us</h3>
<p id="returnmessage"></p>
<label>Name: <span>*</span></label>
<input type="text" id="name" placeholder="Name"/>
<label>Email: <span>*</span></label>
<input type="text" id="email" placeholder="Email"/>
<label>Contact No: <span>*</span></label>
<input type="text" id="contact" placeholder="10 digit Mobile no."/>
<label>Message:</label>
<textarea id="message" placeholder="Message......."></textarea>
<input type="button" id="submit" value="Send Message"/>
</form>
</div>
 </div>
                
            </div><!--.content-wrapper end -->
<?php
include 'includes/_footer.php';
?>

