<?php
//get the first name
$first_name = Input::get('first_name');
$last_name = Input::get ('last_name');
$email = Input::get ('email');
$subject = Input::get ('subject');
$message = Input::get ('message');
$date_time = date("F j, Y, g:i a");
$userIpAddress = Request::getClientIp();
?> 

<p>
First name: <?php echo ($first_name); ?> <br>
Last name: <?php echo($last_name);?> <br>
Email address: <?php echo ($email);?> <br>
Subject: <?php echo ($subject); ?><br>
Message: <?php echo ($message);?><br>
Date: <?php echo($date_time);?><br>
User IP address: <?php echo($userIpAddress);?><br>
 
</p>