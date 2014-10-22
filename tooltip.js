// JavaScript Document
$(function(){
    
   $("*[rel=tooltip]").hover(function(e){
         var title = $(this).attr('title');
         $(this).data('titleText', title).removeAttr('title');
         $("body").append('<div class="tooltip">'+title+'</div>');
           
         $('.tooltip').css({
                     top : e.pageY - 50,
                     left : e.pageX + 20
                     }).fadeIn();
       
   }, function(){
      $(this).attr('title', $(this).data('titleText'));
      $('.tooltip').remove();
   }).mousemove(function(e){
      $('.tooltip').css({
                     top : e.pageY - 50,
                     left : e.pageX + 20
                     })
   })
    
});