@extends('layouts.backend')
@section('content')
    {{--*/ $first_tab = 'active' /*--}}
    {{--*/ $second_tab = $third_tab = $fourth_tab = $fifth_tab = $sixth_tab = $seventh_tab = $eighth_tab = $ninth_tab = '' /*--}}    
@if(Session::has('tab_line_drawings'))   
    {{--*/ $fourth_tab = 'active' /*--}}    
@elseif(Session::has('care_symbols'))
    {{--*/ $ninth_tab = 'active' /*--}}
@endif

<div class="row">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="{{$first_tab}}"><a href="#tab_information" data-toggle="tab">Information</a></li>
                @if(isset($product->id))
                    @if(isset($line))
                        @if($line['parent_category_id'] == 1 || $line['parent_category_id'] == 70  )
                            <li class="{{$second_tab}}"><a href="#tab_seo" data-toggle="tab">SEO</a></li>
                            <li class="{{$third_tab}}"><a href="#tab_images" data-toggle="tab">Images</a></li>
                            <li class="{{$sixth_tab}}"><a href="#tab_attributes" data-toggle="tab">Attributes</a></li>
                            <li class="{{$seventh_tab}}"><a href="#tab_attributes_price" data-toggle="tab">Attributes Price</a></li>
                        @else
                            <li><a href="#tab_seo" data-toggle="tab">SEO</a></li>
                            <li><a href="#tab_images" data-toggle="tab">Images</a></li>
                            <li><a href="#tab_attributes" data-toggle="tab">Attributes</a></li>
                            <li><a href="#tab_attributes_price" data-toggle="tab">Attributes Price</a></li>
                        @endif
                        @if($line['parent_category_id'] == 2)
                        @endif
                    @endif
                @endif
                
                <li class="pull-right"><a href="<?php echo URL::to('/'); ?>/backend/productlist/<?php if(isset($product->id)){ echo $product->parent_category_id;}else { echo $category;}?>" class="text-muted"><i class="fa fa-chevron-left"></i> Go Back</a></li>
                
            </ul>
            <div class="tab-content">
                <div class="tab-pane {{$first_tab}}" id="tab_information">
                    @include('backend.products.create.tab_information')
                </div><!-- /.tab-pane -->
                @if(isset($product->id))
                <div class="tab-pane {{$second_tab}}" id="tab_seo">
                    @include('backend.products.create.tab_seo')
                </div><!-- /.tab-pane -->
                <div class="tab-pane {{$third_tab}}" id="tab_images">
                    @include('backend.products.create.tab_image')
                </div><!-- /.tab-pane -->                 
                                              
                <div class="tab-pane {{$sixth_tab}}" id="tab_attributes">
                    @include('backend.products.create.tab_attributes')
                </div><!-- /.tab-pane -->
                <div class="tab-pane {{$seventh_tab}}" id="tab_attributes_price">
                    @include('backend.products.create.tab_attributes_price')
                </div><!-- /.tab-pane -->
                            
                @endif
            </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
</div>
@stop

@section('javascript')

$(document).ready(function(){ 
    $(function() {
        $("#drag-drop ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
            var order = $(this).sortable("serialize"); 
            $.post('{{URL::route("backend.products.image.position")}}', order, function(theResponse){
                
            });                                                              
        }                                 
        });
    });

    $(function() {
        $("#line-position ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
            var order = $(this).sortable("serialize"); 
            $.post('{{URL::route("backend.products.line.position")}}', order, function(theResponse){
                
            });                                                              
        }                                 
        });
    });
     $(function() {
        $("#pdf-position ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
            var order = $(this).sortable("serialize"); 
            $.post('{{URL::route("backend.products.pdf.position")}}', order, function(theResponse){
                
            });                                                              
        }                                 
        });
    });

    $(function() {
        $("#drag-drop-care-symbols ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
            var order = $(this).sortable("serialize"); 
            $.post('{{URL::route("backend.products.caresymbols")}}', order, function(theResponse){
                
            });                                                              
        }                                 
        });
    });


}); 
@if(Session::has('tab'))
function getParameterByName(name) {
name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
results = regex.exec(location.search);
return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var url = "{{Session::get('tab')}}";
if (url) {
$('.nav-tabs a[href=#'+url+']').tab('show');
}
@endif
@if ($product->parent_category_id > 0)
$('#catgory_selects').hide();
$('#parent_category').prop('disabled',true);
$('#real_category').prop('disabled',true);
$('#child_category').prop('disabled',true);
@else
$('#click_for_select').hide();
@endif
$('#hide_real_category').hide();
$('#hide_child_category').hide();

@if (json_encode($tree) != null)
var $category_json = {{json_encode($tree)}}
$('#parent_category').change(function(){

if($(this).val() != ""){
$('#real_category').prop('disabled',false);
if(typeof $category_json[$(this).find(':selected').data('count')].children != "undefined"){
$('#real_category').html('<option value="">Choose A Category</option>');
$.each($category_json[$(this).find(':selected').data('count')].children, function(i,v){
$('#real_category').append('<option value="'+v.id+'" data-count="'+i+'">'+v.name+'</option>');
});
$('#hide_real_category').show();
$('#child_category').html('');
$('#hide_child_category').hide();
}
}else{
$('#real_category').html('');
$('#hide_real_category').hide();
$('#child_category').html('');
$('#hide_child_category').hide();
$('#real_category').prop('disabled',true);
$('#child_category').prop('disabled',true);
}
});
$('#real_category').change(function(){
if($(this).val() != ""){
$('#child_category').prop('disabled',false);
if(typeof $category_json[$('#parent_category').find(':selected').data('count')].children[$(this).find(':selected').data('count')].children != "undefined"){
$('#child_category').html('<option value="">Choose A Child Category</option>');
$.each($category_json[$('#parent_category').find(':selected').data('count')].children[$(this).find(':selected').data('count')].children, function(i,v){
$('#child_category').append('<option value="'+v.id+'" data-count="'+i+'">'+v.name+'</option>');
});
$('#hide_child_category').show();
}
}else{
$('#child_category').html('');
$('#hide_child_category').hide();
$('#child_category').prop('disabled',true);
}
});
$('#click_to_change_category').click(function(){
if($('#catgory_selects:visible').length == 0){
$('#catgory_selects').show();
$('#parent_category').prop('disabled',false);
$('input[name="can_update_category"]').val(true);
}else{
$('#catgory_selects').hide();
$('#parent_category').prop('disabled',true);
$('#real_category').prop('disabled',true);
$('#child_category').prop('disabled',true);
$('input[name="can_update_category"]').val('');
}
});
@endif
$(window).load(function () {
$('#parent_category').trigger("change");
});


    $(document).delegate(".numbersonly","keydown",function(e){
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, donot do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
    
    Dropzone.autoDiscover = false;
    var imageDropzone = new Dropzone("#images");
    imageDropzone.on("queuecomplete", function(file) {
      setTimeout(
      function() 
      {
        //do something special
        location.href='{{URL::route("backend.products.edit",$product->id)}}'
      }, 2000);
      
    }); 
	var limageDropzone = new Dropzone("#line_images");
    limageDropzone.on("queuecomplete", function(file) {
      setTimeout(
      function() 
      {
        //do something special
        location.href='{{URL::route("backend.products.edit",$product->id)}}'
      }, 2000);
      
    }); 
	var attachDropzone = new Dropzone("#attachments");
    attachDropzone.on("queuecomplete", function(file) {
      setTimeout(
      function() 
      {
        //do something special
        location.href='{{URL::route("backend.products.edit",$product->id)}}'
      }, 2000);
      
    });       
@stop