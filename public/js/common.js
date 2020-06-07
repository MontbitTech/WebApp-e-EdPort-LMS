$(document).click(function(e) {
  if (!$(e.target).is('header, .btn-menu, .leftmenu-section, header *, .leftmenu-section *')) {
    $('body').removeClass('menu-active');
  }
});

/*Loading element hide after page ready*/ 
$(document).ready(function(){
  $('.loading').fadeOut();
});


/*Initialize Tooltip*/ 
$(function () {
  $('[data-toggle="tooltip"]').bsTooltip()
});


/*Menu Open and Close*/
$(document).on('click', '.menu-bars', function(){
  $('body').toggleClass('menu-open');
});
$(document).on('click', '.close-profile,.fullbody-cover', function(){
  $('body').removeClass('menu-open');
});
 

/* Help Button Pause for 30 Sec*/
$(document).on('click', '.header-help', function(){
  var helpPause = `<svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_pause"></use></svg> Help!`;
  var helpNormal = `<svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_help"></use></svg> Help!`;
  $(this).addClass('active').html(helpPause);
  //$.fn.notifyMe('error',15,'Your help message send to support team!');
  setTimeout(()=>{
    $(this).removeClass('active').html(helpNormal);
  },10000);
}); 




/*Remove Below Code On Production*/ 
/* Active Page  Indication After Page Load */
$(document).ready(function(){
  var loc = window.location.href;
  var output  = loc.split('/').pop().split('.').shift();
  if (output=='index' || output===''){ 
    $('.nav-link[href="index.php"]').parent().addClass('active');
  }
  if (output=='assignments'){
    $('.nav-link[href="assignments.php"]').parent().addClass('active');
  }
  if (output=='quiz'){
    $('.nav-link[href="quiz.php"]').parent().addClass('active');
  }
  if (output=='report'){
    $('.nav-link[href="report.php"]').parent().addClass('active');
  }
});
