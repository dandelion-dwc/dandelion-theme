$(window).ready(function(){
  $(window).scroll(function() {
    if ($(window).scrollTop() > 100) {
      $('header').addClass('scrolled');
    } else {
      $('header').removeClass('scrolled');
    }
  });

  $("#js_headerMenuOpen").click(function() {
    $("#js_headerMenu").addClass('active')
    $("#js_headerMenuClose").addClass('active')
  });
  $("#js_headerMenuClose").click(function() {
    $("#js_headerMenu").removeClass('active')
    $("#js_headerMenuClose").removeClass('active')
  });
});
