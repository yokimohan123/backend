
<html>
    <head>
        <title>WD Shop Admin</title>
        <meta charset='utf-8'>
        <!-- bootstrap 3.0.2 -->
        <link href="{{URL::to('/')}}/template/lte/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="{{URL::to('/')}}/template/lte/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="{{URL::to('/')}}/template/lte/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="{{URL::to('/')}}/template/lte/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="{{URL::to('/')}}/template/lte/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="{{URL::to('/')}}/template/lte/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="{{URL::to('/')}}/template/lte/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="{{URL::to('/')}}/template/lte/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

        <link href="{{URL::to('/')}}/template/lte/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/template/lte/css/datepicker/datepicker.css" rel="stylesheet">
        <!-- Theme style -->
        <link href="{{URL::to('/')}}/template/lte/css/adminlte.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue wysihtml5-supported">
        <!-- header logo: style can be found in header.less -->
  
        <header class="header">
            <a href="{{URL::to('/')}}" class="logo">
                WD Shop
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo Session::get('username');?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="{{URL::to('/')}}/template/lte/img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p><?php echo Session::get('username');?></p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{URL::to('/')}}/backend/users/index" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{URL::to('/')}}/backend/logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header> 
     
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{URL::to('/')}}/template/lte/img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">

                            <p>Hello, <?php echo Session::get('username');?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="{{URL::to('/')}}/backend/dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-home"></i>
                                <span>Home Page</span>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>
                            <ul class="treeview-menu" style="display: none;">
                                <li><a href="{{URL::to('/')}}/backend/home_slider" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Home Page Slider</a></li>
<!--                                <li><a href="#" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Our Products</a></li>
                                <li><a href="#" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Below Block</a></li>-->
                            </ul>
                        </li>
                        <li>
                            <a href="{{URL::to('/')}}/backend/collection">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Collection</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::to('/')}}/backend/aboutdesigner">
                                <i class="fa fa-female"></i>
                                <span>Designer</span>
                            </a>
                        </li> 
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-barcode"></i>
                                <span>Shop</span>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>
                            <ul class="treeview-menu" style="display: none;">
                                <!-- <li><a href="#" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Countries</a></li>                                    
                                <li><a href="#" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>States</a></li>
                                <li><a href="#" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Taxes</a></li>
                                <li><a href="#" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Tax Rules</a></li> -->
                                <li><a href="{{URL::to('/')}}/backend/categories" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Categories</a></li>
                                <li><a href="{{URL::to('/')}}/backend/products" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Products</a></li>
                                <li><a href="{{URL::to('/')}}/backend/attributes" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Attributes</a></li>
                                <li><a href="{{URL::to('/')}}/backend/attribute_values" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Attribute Values</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{URL::to('/')}}/backend/press">
                                <i class="fa fa-video-camera"></i>
                                <span>Press</span>
                            </a>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-gears"></i>
                                <span>Miscellaneous</span>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>
                            <ul class="treeview-menu" style="display: none;">
                                <li><a href="#" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Catalogue</a></li>                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-pagelines"></i>
                                <span>Pages</span>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>
                            <ul class="treeview-menu" style="display: none;">                                
                                <li><a href="{{URL::to('/')}}/backend/private-policy" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Private Policy</a></li>
                                <li><a href="{{URL::to('/')}}/backend/terms-and-condition" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Terms and Condition</a></li>
                            </ul>
                        </li>  
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-cogs"></i>
                                <span>Settings</span>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>
                            <ul class="treeview-menu" style="display: none;">
                                <!-- <li><a href="{{URL::to('/')}}/backend/general" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>General</a></li> -->
                                <li><a href="{{URL::to('/')}}/backend/socialicon" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Social Icons</a></li>
                                <!-- <li><a href="{{URL::to('/')}}/backend/addressbook" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Address Book</a></li> -->
                                <!-- <li><a href="{{URL::to('/')}}/backend/meta" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>SEO</a></li> -->
                            </ul>
                        </li>

                        <!-- user management start -->
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>User Management</span>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>
                            <ul class="treeview-menu" style="display: none;">
                                <li><a href="{{URL::to('/')}}/backend/usermanagement/show_user" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Show User</a></li>
                            </ul>
                        </li> 
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-list"></i>
                                <span>Order Management</span>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>
                            <ul class="treeview-menu" style="display: none;">
                                <li><a href="{{URL::to('/')}}/backend/ordermanagment/orders" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Orders</a></li>
                            </ul>
                        </li>     
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-gift"></i>
                                <span>Coupon</span>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>
                            <ul class="treeview-menu" style="display: none;">
                                <li><a href="{{URL::to('/')}}/backend/coupon-code" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Coupon code</a></li>
                            </ul>
                        </li>                    
                        <!-- <li class="treeview">
                            <a href="#">
                                <i class="fa fa-home"></i>
                                <span>Catalog</span>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>
                            <ul class="treeview-menu" style="display: none;">
                                <li><a href="{{URL::to('/')}}/backend/categories" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Categories</a></li>
                                <li><a href="{{URL::to('/')}}/backend/products" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Products</a></li>
                                
                        </li> -->
                        <!-- user management ends  --> 
                                               
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                </section>

                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
 
        <!-- jQuery 2.0.2 -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <!--<script src="{{URL::to('/')}}/template/lte/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>-->
        <!-- Bootstrap -->
        <script src="{{URL::to('/')}}/template/lte/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="{{URL::to('/')}}/template/lte/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="{{URL::to('/')}}/template/lte/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="{{URL::to('/')}}/template/lte/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="{{URL::to('/')}}/template/lte/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="{{URL::to('/')}}/template/lte/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{URL::to('/')}}/template/lte/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="{{URL::to('/')}}/template/lte/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{URL::to('/')}}/template/lte/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="{{URL::to('/')}}/template/lte/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="{{URL::to('/')}}/template/lte/js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <script src="{{URL::to('/')}}/template/lte/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="{{URL::to('/')}}/template/lte/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="{{URL::to('/')}}/template/lte/js/dropzone.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="{{URL::to('/')}}/template/lte/js/application.js" type="text/javascript"></script>
        <script src="{{URL::to('/')}}/template/lte/js/script.js" type="text/javascript"></script>
        <script type="text/javascript">
$(function() {
    $(".textarea").wysihtml5();
    @yield('javascript')
});

    $( document ).ready(function() {
        $('.offer-price-check').on('ifUnchecked', function(event){
            $(".enter-offer-price").hide();
        }); 
        $('.offer-price-check').on('ifChecked', function(event){
            $(".enter-offer-price").show();
        });
    });   

        </script>
       
    </body>
</html>
