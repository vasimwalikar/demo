<?php
if(isset($_POST['submit'])):
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
		//your site secret key
        $secret = 'InsertSiteSecretKey';
		//get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
		
		
        if($responseData->success):
			//contact form submission code
			$first_name = !empty($_POST['first_name'])?$_POST['first_name']:'';
            $last_name = !empty($_POST['last_name'])?$_POST['last_name']:'';
            $email = !empty($_POST['email'])?$_POST['email']:'';
            $phone = !empty($_POST['phone'])?$_POST['phone']:'';
            
            $message = !empty($_POST['message'])?$_POST['message']:'';
            
            $response = $enquiryObj->AddEnquiry($first_name, $last_name, $email, $phone, $message);
			
            $succMsg = 'Your contact request have submitted successfully.';
			$name = '';
			$email = '';
			$message = '';
        else:
            $errMsg = 'Robot verification failed, please try again.';
        endif;
    else:
        $errMsg = 'Please click on the reCAPTCHA box.';
    endif;
else:
    $errMsg = '';
    $succMsg = '';
	$name = '';
	$email = '';
	$message = '';
endif;
?>
<html>
    <head>
      <title>Using new Google reCAPTCHA with PHP by CodexWorld</title>
       <script src="https://www.google.com/recaptcha/api.js" async defer></script>
       <link href="css/style.css" rel='stylesheet' type='text/css' />
    </head>
    <body>
    <div class="registration">
		<h2>Contact Form</h2>
		<div class="avtar"><img src="images/color.jpg" /></div>
        <?php if(!empty($errMsg)): ?><div class="errMsg"><?php echo $errMsg; ?></div><?php endif; ?>
        <?php if(!empty($succMsg)): ?><div class="succMsg"><?php echo $succMsg; ?></div><?php endif; ?>
		<div class="form-info">
			<form action="" method="POST">
				<input type="text" class="text" value="<?php echo !empty($name)?$name:''; ?>" placeholder="Your full name" name="name" >
                <input type="text" class="text" value="<?php echo !empty($email)?$email:''; ?>" placeholder="Email adress" name="email" >
                <textarea type="text" placeholder="Message..." required="" name="message"><?php echo !empty($message)?$message:''; ?></textarea>
				<div class="g-recaptcha" data-sitekey="InsertYourSiteKey"></div>
				<input type="submit" name="submit" value="SUBMIT">
			</form>
		</div>			
		<div class="clear"> </div>
	</div>
  </body>
</html>