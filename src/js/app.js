//nav element
$ = jQuery;
$('main').on('click', function(e){
  $('.navigation li').removeClass('active');
  $('header').removeClass('active');
  $('.navigation').removeClass('active');
});
$('.discover_head').on('click', openMenu);
$('.dropdown-url').on('click', openMenu);
$('.about_head').on('click', openMenu);
//open menu and close the rest
function openMenu(e){
  e.preventDefault();
  var elem = this.previousSibling;
  if(elem.parentElement.classList.contains('active')){
    $('.navigation li').removeClass('active');
    $('header').removeClass('active');
    $('.navigation').removeClass('active');
    $('.second-menu-back').removeClass('active');
  }
  else{
    $('.navigation li').removeClass('active');
    $('.second-menu-back').addClass('active');
    $('header').addClass('active');
    $('.navigation').addClass('active');
    elem.parentElement.classList.add('active');
  }
}

$(window).scroll(function(){
  var heightWindow = window.innerHeight;
  if($(window).scrollTop() > (heightWindow*40/100)){
    $('header').addClass('scroll');
  }
  else{
    if(!$('.navigation').hasClass('active')){
      $('header').removeClass('scroll');
    }
  }
});

$('.menu-mobile').on('click', function(e){
  e.preventDefault();
  $('.menu-mobile').toggleClass('active');
  $('ul.navigation').toggleClass('active');
  $('.second-menu-back').removeClass('active');
  if($('li.discover').hasClass('active')){
    $('li.discover').removeClass('active');
    $('.navigation li').removeClass('active');
  }
  if($('li.about').hasClass('active')){
    $('li.about').removeClass('active');
    $('.navigation li').removeClass('active');
  }
});
$('.second-menu-back').on('click', function(){
  $('.navigation li').removeClass('active');
  this.classList.remove('active');
});

$('.go-back').on('click', function(e){
  e.preventDefault();
  window.history.back();
});
