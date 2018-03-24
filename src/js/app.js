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
$('.close-error').on('click', function(e){
  e.preventDefault();
  $('.error-popup').addClass('inactive');
});

$(document).on('ready', function(){
  if(typeof currentPageCategory !== 'undefined'){
    var rubriekenFilters = document.querySelectorAll('.fieldset_container input');
    var currentPageCategoryWithUnderscore = currentPageCategory.split(' ').join('_');
    var inputSelected = document.querySelectorAll("#" + currentPageCategoryWithUnderscore);
    uncheckAllInput(rubriekenFilters);
    inputSelected.forEach(function(e){
      e.checked = true;
    });
    var allInput = document.querySelectorAll('input');
    rubriekenFilter(allInput);
    allInput.forEach(function(el){
      el.addEventListener('change', function(e){
        rubriekenFilter(allInput);
      });
    });
    var resetButton = document.querySelector('button.reset-filter');
    resetButton.addEventListener('click', function(){
      uncheckAllInput(allInput);
      rubriekenFilter(allInput);
    });

    var toggleButtons = document.querySelectorAll('.navigation-results a');
    toggleButtons.forEach(function(item){
      item.addEventListener('click', function(e){
        e.preventDefault();

        removeActiveToggle();
        var className = e.target.classList[0];
        e.target.classList.add('active');
        var sections = document.querySelectorAll('.results section');
        sections.forEach(function(s){
          if(!s.classList.contains('no-result')){
            s.classList.remove('active');
          }
        });
        var selected;
        switch (className) {
          case "request":
          selected = document.querySelector('section.request_section');
            break;
          case "profiles":
          selected = document.querySelector('section.featured_profile');
            break;
          case "adds":
          selected = document.querySelector('section.add_section');
            break;
        }
        selected.classList.add('active');
        rubriekenFilter(allInput);
      });
    });
  }
});
function removeActiveToggle(){
  var toggleSections = document.querySelectorAll('.navigation-results a');
  for(var i = 0; i < toggleSections.length; i++){
    toggleSections[i].classList.remove('active');
  }
}
function uncheckAllInput(inputs){
  for(var i = 0; i < inputs.length; i++){
    inputs[i].checked = false;
  }
}
function removeAllSections(){
  var sections = document.querySelectorAll('.results article');
  sections.forEach(function(e){
    e.classList.remove('active');
  });
}
function rubriekenFilter(elements){
  var allChecked = [];
  elements.forEach(function(e){
    if(e.checked === true){
      allChecked.push(e);
    }
  });
  var selectedElements = [];
  var toggleSections = document.querySelectorAll('.navigation-results a');
  allDataCategory.forEach(function(item){
    var name = item.category.split(' ').join('_');
    allChecked.forEach(function(checked){
      if(checked.id == name){
        toggleSections.forEach(function(toggle){
          var toggleClass = toggle.classList;
          var activeToggle;
          toggleClass.forEach(function(toggleC){
            if(toggleC === 'active'){
              console.log(toggle.classList[0]);
              activeToggle = toggle.classList[0];
            }
          });
          var newFilter;
          switch (activeToggle) {
            case "request":
            newFilter = "Opdracht";
              break;
            case "profiles":
            newFilter = "Advertentie";
              break;
            case "adds":
            newFilter = "Advertentie";
              break;
          }
          if(newFilter === item.key){
            selectedElements.push(item.id);
          }
        });
      }
    });
  });
  removeAllSections();
  var noResult = document.querySelector('.no-result');
  if(selectedElements.length < 1){
    if(allChecked.length < 1){
      var allSection = document.querySelectorAll('.results article');
      allSection.forEach(function(item){
        item.classList.add('active');
      });
    }
    else{
      noResult.classList.add('active');
    }
  }
  else{
    noResult.classList.remove('active');
  }
  selectedElements.forEach(function(el){
    var element = document.querySelectorAll('.id' + el);
    element.forEach(function(item){
      item.classList.add('active');
    });
  });
}
