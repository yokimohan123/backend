<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="HandheldFriendly" content="true">
<title>Dima Ayad</title>
<link rel="stylesheet" href="{{URL::to('/')}}/css/reset-normalize.css">
<link href="{{URL::to('/')}}/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="{{URL::to('/')}}/css/slick.css">
<link  href="{{URL::to('/')}}/css/component.css" rel="stylesheet">
<link  href="{{URL::to('/')}}/css/minimal.css" rel="stylesheet">   
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/jquery.jqzoom.css">
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/lightbox.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
    <div class="header-container">
            <div class="header">
                <div id="logo">
                    <a href="{{URL::to('/')}}">
                        <img src="{{URL::to('/')}}/images/logo-dima-ayad.png" alt="Dima Ayad" width="250">
                    </a>
                </div>
                <div id="cart"><a href="{{URL::to('/')}}/cart/view" id="cart-price">CART - {{Cart::count();}} item - $ {{Cart::total();}}</a>
                    <div class="cart_hover" id="cart_item_old">
                        @if(count($cart_items)>0)
                            @foreach($cart_items as $items)
                                <div class="cart_hover_top">
                                    <img src="{{URL::to('/')}}/uploads/products/original/{{$items['id']}}/{{$items['options']['image']}}" width="96px" height="97px">
                                    <ul>
                                        <li>{{$items['name']}}</li>
                                        <li>QTY: {{$items['qty']}}</li>
                                        <li>${{$items['price']}}</li>
                                    </ul>
                                </div>
                            @endforeach
                        @endif
                        <div class="cart_hover_bottom">
                            <a href="{{URL::to('/')}}/cart/view" id="cart_view">
                                <input type="button" name="cart_hover_submit" value="VIEW BAG">
                            </a>
                        </div>
                        
                    </div>
                    <div class="search">
                                    {{-- */$search_url = URL::route('categories.shop');/* --}}                    
                        <form action="{{$search_url}}" method="get" name="search" id="search">
                            <input type="text" value="" name="search_term" placeholder="search">
                            <button type="submit" value="" name="go"><i class="fa fa-search"></i></button>
                        </form>
                        </div>
                </div>
            </div>
            <!--header-->                
        </div>        
    <div class="container">
        
    </div>

    <div class="nav-container">
        <div class="navbar-mobile">
            <ul>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <nav>
            <ul id="nav">
                <li><a href="{{URL::to('/')}}/">home</a>
                </li>
                <li><a href="{{URL::to('/')}}/frontend/collection">collection</a>
                </li>
                <li><a href="{{URL::to('/')}}/designer">designer</a>
                </li>
                <li>
                    <a href="{{URL::to('/')}}/shop" class="">shop</a>
                    <div class="submenu-lv1">
                        <div class="sb-collections">
                            <h5>collections</h5>
                            <ul>
                                @foreach($menucategory as $menucategories)
                                    <li>
                                        <a href="<?php echo URL::to('/'); ?>/shop/{{$menucategories->slug}}">{{$menucategories->name}}</a>                
                                    </li>
                                @endforeach                                
                            </ul>
                        </div>
                        <!--sb-collections-->
                        <div class="sb-all">
                            <h5>all</h5>
                            <ul>
                                @foreach($menusubcategories as $menusub_cat)
                                    @if($menusub_cat->parent_id != 0)                
                                        <li>
                                            <a href="<?php echo URL::to('/'); ?>/shop/{{$menusub_cat->slug}}">{{ $menusub_cat->name }}</a>
                                        </li>
                                    @endif
                                @endforeach                               
                            </ul>
                        </div>
                        <!--sb-all-->
                        <div class="sb-sales">
                            <a href="{{URL::to('/')}}/sales">sales</a>
                        </div>
                        <div class="sb-exclusives">
                            <a href="#">exclusives</a>
                        </div>
                    </div>
                </li>
                <li><a href="{{URL::to('/')}}/frontend/press">press</a>
                </li>
                
            </ul>
        </nav>
    </div>
    <!--nav-container-->