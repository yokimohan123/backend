<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>WD Shop - Login Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/admin/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/admin/font-awesome/css/font-awesome.min.css" />

        <script type="text/javascript" src="<?php echo URL::to('/'); ?>/admin/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="<?php echo URL::to('/'); ?>/admin/js/bootstrap.min.js"></script>
    </head>
    <body class="colored">

        <div class="container">
            <!-- Interactive Login - START -->
            <div class="container">
                <div class="row">
                    <div id="contentdiv" class="contcustom">
                        <span class="fa fa-spinner bigicon"></span>
                        <h2>Login</h2>
                        <div>
                            <form method="POST" action="">
                                <input id="username" type="text" placeholder="Email" name="email" onkeypress="check_values();">
                                <input id="password" type="password" placeholder="Password" name="password" onkeypress="check_values();">
                                <button id="button1" class="btn btn-default wide hidden"><span class="fa fa-check med"></span></button>
                                <span id="lock1" class="fa fa-lock medhidden redborder"></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">


                function check_values() {
                    if ($("#username").val().length != 0 && $("#password").val().length != 0) {
                        $("#button1").removeClass("hidden").animate({left: '250px'});
                        ;
                        $("#lock1").addClass("hidden").animate({left: '250px'});
                        ;
                    }
                }


            </script>            
            <!-- Interactive Login - END -->

        </div>

    </body>
</html>