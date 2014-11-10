$(document).ready(function () {
    $('.sf-menu').superfish();

    $('.scroll-eventos').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2
    });
    
    $('#s, #s-small').on('change',function(){
        $('#search-form').submit();
    });
});