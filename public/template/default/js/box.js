 $(document).ready(function() {
        $( "#accordion" ).accordion();
        
        $( "#slider-range-min" ).slider({
          range: "min",
          value: 1,
          min: 1,
          max: 100,
          slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.value );
          }
        });
        $( "#amount" ).val( "$" + $( "#slider-range-min" ).slider( "value" ) );
     
});