<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
<!-- <title>AdminLTE | Log in</title> -->    
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo URL::to('/'); ?>/template/lte/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo URL::to('/'); ?>/template/lte/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo URL::to('/'); ?>/template/lte/css/adminlte.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header">Remind Password</div>
            
            @if (Session::has('error'))
            {{ trans(Session::get('reason')) }}
            @elseif (Session::has('success'))
            An email with the password reset has been sent.
            @endif

            {{ Form::open(array('route' => 'password.request')) }}
            <div class="body bg-gray">
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Email"/>
                    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                </div>
                <button type="submit" class="btn bg-olive btn-block">Submit</button>
            </div>
            {{ Form::close() }}

        </div>
        <!-- jQuery 2.0.2 -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo URL::to('/'); ?>/template/lte/js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>