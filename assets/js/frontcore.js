$(function(){
   /*************************************
    * Responsive Menu
    ************************************/
   $('body').append('<div class="mobile-menu-overlay"><div class="close-trigger"><i class="fa fa-close"></i></div></a></div>');
    
   $('.mobile-menu-trigger, .close-trigger').click(function(e){
      e.preventDefault();
      $('body').toggleClass('showMainMenu');
   });
});
