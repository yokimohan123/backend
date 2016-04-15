   <div class="footer-container">
            <footer>
                <div class="social">
                    <ul>
                        <li>
                            <a href="<?php echo $footer[0]['link']; ?>" target="_blank">
                                <img src="{{URL::to('/')}}/images/facebook.png" alt="Facebook">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $footer[3]['link']; ?>" target="_blank">
                                <img src="{{URL::to('/')}}/images/twitter.png" alt="Twitter">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $footer[4]['link']; ?>" target="_blank">
                                <img src="{{URL::to('/')}}/images/instagram.png" alt="Instagram">
                            </a>
                        </li>
                    </ul>
                </div>
                <!--social-->
                <div class="privacy-policy">
                    <ul>
                        <li><a href="{{URL::to('/')}}/terms-and-condition">Terms &amp; Conditions</a>
                        </li>
                        <li><a href="{{URL::to('/')}}/private-policy">Privacy Policy</a>
                        </li>
                        <li><a href="{{URL::to('/')}}/contactus">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <!--privacy-policy-->
            </footer>
        </div>
    </div>
    <!--container-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="{{URL::to('/')}}/js/lib/jquery-1.10.2.min.js"></script>
<script src="{{URL::to('/')}}/js/lib/query.browser.js"></script>
<script src="{{URL::to('/')}}/js/modernizr.custom.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/js/lib/slick.min.js"></script>
<!-- <script src="{{URL::to('/')}}/js/lib/jquery.hoverizr.min.js"></script> -->
<script type="text/javascript" src="{{URL::to('/')}}/js/icheck.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/js/collection.js"></script>
<script src="{{URL::to('/')}}/js/imagesloaded.pkgd.min.js"></script>
<script src="{{URL::to('/')}}/js/masonry.pkgd.min.js"></script>
<script src="{{URL::to('/')}}/js/classie.js"></script>
<script src="{{URL::to('/')}}/js/cbpGridGallery.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/js/lib/jquery.cycle2.min.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/js/lib/lightbox.min.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/js/lib/jquery.jqzoom-core.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/js/all.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/js/jquery.cycle2.min.js"></script>
<script src="{{URL::to('/')}}/js/product-details.js"></script>

<script>
    new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>

<script type="text/javascript">
    $(".homepage_banner_slider").click(function() {
        var burl = $(this).attr('data-link');
        if(burl != '') {
            location.href=burl;
        }
    });

    $("#add_to_cart").click(function(e){
        $.ajax({
            type: 'POST',
            url: "{{URL::to('/')}}/cart/add",
            data: $('#product_cart').serialize(),
            dataType: 'json',
            success: function(data) {
                $('#cart_success').show();
                var price = "CART - " + data.count + " item - $"+data.cart_price;
                console.log(price);
                $('#cart-price').html(price);
                $('.cart_hover').html(data.data);
            }
        });
    });
    $(".add-to-cart").click(function(e){
        var product_id = $('#product_id').val();
        var quantity = $('#quantity').val();
        $.ajax({
            type: 'POST',
            url: "{{URL::to('/')}}/cart/add",
            data: {'product_id':product_id,'quantity':quantity},
            dataType: 'json',
            success: function(data) {
                $('#cart_success').show();
                var price = "CART - " + data.count + " item - $"+data.cart_price;
                console.log(price);
                $('#cart-price').html(price);
                $('.cart_hover').html(data.data);
            }
        });
    });

    // Shipping address add ajax
    $(".shipping_submit").click(function(e){
        var name = $('#name').val();
        var email = $('#email').val();
        var address = $('#change_adr').val();
        var town = $('#change_town').val();
        var zip = $('#change_zip').val();
        var country = $('#change_country').val();
        // var option = $('input[name=address]:checked').val();
        var option = $('#change_adrs').val();

        if(address == ''){
            $('#shipping_adr').show();
            $('#shipping_town').hide();
            $('#shipping_zipcode').hide();
            $('#shipping_country').hide();
            return false;
        }else if( town == '' ){
            $('#shipping_adr').hide();
            $('#shipping_town').show();
            $('#shipping_zipcode').hide();
            $('#shipping_country').hide();
            return false;
        }else if( zip == ''){
            $('#shipping_adr').hide();
            $('#shipping_town').hide();
            $('#shipping_zipcode').show();
            $('#shipping_country').hide();
            return false;
        }else if(country == ''){
            $('#shipping_adr').hide();
            $('#shipping_town').hide();
            $('#shipping_zipcode').hide();
            $('#shipping_country').show();
            return false;
        }
        $.ajax({
            type: 'POST',
            url: "{{URL::to('/')}}/cart/shipping",
            data: {'name':name,'email':email,'address':address,'town':town,'country':country,'zip':zip,'option':option},
            dataType: 'json',
            success: function(data) {
                if(data == "success"){
                    window.location.href ="{{URL::to('/')}}/cart/payment";
                }else if(data == "email_exist"){
                    $("#email_exist").show()
                    $("#plz_login").hide()
                    $("#select_shipping").hide()
                }else if(data == "plz_login"){
                    $("#email_exist").hide()
                    $("#select_shipping").hide()
                    $("#plz_login").show()
                }else if(data == "select_shipping"){
                    $("#select_shipping").show()
                    $("#plz_login").hide()
                    $("#email_exist").hide()
                }else if(data == "invalid"){
                    $("#select_shipping").hide()
                    $("#plz_login").hide()
                    $("#email_exist").hide()
                    $("#invalid").show()
                }
            }
        });
    });

    $(function() {       
        $('input').iCheck({
          checkboxClass: 'icheckbox_minimal',
          radioClass: 'iradio_minimal'
        });
        // Shopping cart checkout tab change
        $('#profile').on('ifChecked', function() {
            $('.profile_address').show();
            $('#shp_adr').hide();
            $("#select_shipping").hide()
            $("#plz_login").hide()
            $("#email_exist").hide()
            $("#invalid").hide()
            console.log("checked");
        }).on('ifUnchecked', function() {
            $('#shp_adr').show();
            $('.profile_address').hide();
            $("#select_shipping").hide()
            $("#plz_login").hide()
            $("#email_exist").hide()
            $("#invalid").hide()
            console.log("un checked");
        })

        // Payment checkout 
        $('#creditcard').on('ifChecked', function() {
            $('.payment_credit').show();
            $('.payment_paypal').hide();
        }).on('ifUnchecked', function() {
            $('.payment_paypal').show();
            $('.payment_credit').hide();
        })
        $('#cash').on('ifChecked', function() {
            $('.payment_credit').hide();
            $('.payment_paypal').hide();
        })

    });
   
    $('#goto-page').on('change',function(event){
        page = $('#goto-page').val();                            
        $.ajax({
            type: 'GET',
            url: "<?php echo URL::to('/');?>/shop?page=" + page,
            dataType: 'json',
            success: function(data) {
                window.location.href = "<?php echo URL::to('/');?>/shop?page=" + page;
            }
        });
    });


//-------------- shop dress-info add to cart ------------------------//
    $('.dress-hover').hide();
    $('.dress-details').mouseover(function(){
        $(this).find('.dress-info-hover').stop(true,true).animate({marginTop:'-54px'});
        $(this).find('.dress-out').hide();
        $(this).find('.dress-hover').show();
    }).mouseleave(function(){
        $(this).find('.dress-info-hover').animate({marginTop:'20px'});
        $(this).find('.dress-out').show();
        $(this).find('.dress-hover').hide();
    });
    $('.dress-details').hover(function(){
        $(this).find('.in-colors').slideToggle();
    })

    
 $(function() {
            $(".image-collection .commom-loop").each(function(){
                 $(this).hide();
            });
            $('.gallery-collections img').on( "click", function(e) {
                e.preventDefault();
                $('.gallery-collections, .slick-navigation').hide();
                $('.back-collections').show();
                var id = $(this).attr('data-related'); 
                $(".nav-foor").hide();
                $(".image-collection .commom-loop").each(function(){
                    $("#"+id).next(".nav-foor").show();
                    $(this).hide();
                    if($(this).attr('id') == id) {
                        $(this).show();
                    }
                });
            });  
            $('.back-collections').click(function () {
                $('.gallery-collections, .slick-navigation').show();    
                $('.image-collection .commom-loop, .nav-foor').hide();
                $(this).hide();
            })  
        })



</script>

</body>
</html>
