$(document).ready(function(){

  $('#menu').click(function(){
      $('.navbar').toggleClass('nav-toggle');
  });

  $('#login').click(function(){
      $('.login-form').addClass('popup');
  });

  $('.login-form form .fa-times').click(function(){
      $('.login-form').removeClass('popup');
  });

  $(window).on('load scroll',function(){

      $('.navbar').removeClass('nav-toggle');

      $('.login-form').removeClass('popup');

  });

});