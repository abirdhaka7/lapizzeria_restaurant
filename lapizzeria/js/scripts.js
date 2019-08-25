var map;
function initMap() {

    var lating = {
        lat: parseFloat( options.latitude ) ,
        lng: parseFloat( options.longitude )
    };

map = new google.maps.Map(document.getElementById('map'), {
    center: lating,
    zoom: parseInt( options.zoom )
});

var marker = new google.maps.Marker({
    position: lating,
    map: map,
    title:  'La Pizzeria'
})

   
}

$ = jQuery.noConflict();

$(document).ready(function(){
   
   //Menu Button
    $('.mobile-menu a').on('click', function(){
        $('nav.site-nav').toggle('slow');
    });

    //Show the mobile menu
    var breakpoint = 768;
    $(window).resize(function(){ 
        boxAdjustment();
        if($(document).width()>= breakpoint){
            $('nav.site-nav').show();
        }else{
            $('nav.site-nav').hide();
        }
    });

    boxAdjustment();


    //Fluid box plugin
    jQuery('.gallery a').each(function(){
        jQuery(this).attr({'data-fluidbox': ''});
    });

    if(jQuery('[data-fluidbox]').length > 0 ){
        jQuery('[data-fluidbox]').fluidbox();
    }


    //Adapt map height
    var map = $('#map');
    if(map.length > 0 ){
        if($(document).width() >= breakpoint ){
            display_map(0);
        }else{
            display_map(300);
        }
    }
    
    $(window).resize(function(){
        if($(document).width() >= breakpoint){
            display_map(0);
        } else{
            display_map(300);
        }
    });



});

function boxAdjustment(){
    var images = $('.box-image');
    if(images.length > 0){
        var imageHeight = images[0].height; 
        var boxes = $('.content-box');     
        $(boxes).each(function(i, element){
        $(element).css({'height': imageHeight + 'px'});
        });

    }
    
}

function display_map(value){
    if(value == 0 ){

        var locationSection = $('.location-reservation');
        var locationHeight = locationSection.height();
        $('#map').css({'height': locationHeight });

    }else{
        $('#map').css({'height': value });
    }
} 