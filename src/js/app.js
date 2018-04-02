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
    var filterSystem = {
      init: function(){
        this.findActiveToggle();
        this.mobileVersion();
        this.loadFirstFilter();
        this.resetFilter();
        var tabNavigation = document.querySelectorAll('.navigation-results a');
        for(var i = 0; i < tabNavigation.length; i++){
          tabNavigation[i].addEventListener('click', function(e){
            e.preventDefault();
            filterSystem.removeActive(tabNavigation);
            e.target.classList.add('active');
            filterSystem.findActiveToggle();
          });
        }
      },
      findActiveToggle: function(){
        var tabNavigation = document.querySelectorAll('.navigation-results a');
        for(var i = 0; i < tabNavigation.length; i++){
          if(tabNavigation[i].classList.contains('active')){
            this.activeToggle = tabNavigation[i].classList[0];
          }
        }
        var sectionSelected;
        var labels;
        switch (this.activeToggle) {
          case 'profiles':
            sectionSelected = document.querySelector('.results .featured_profile');
            labels = document.querySelectorAll('.rubic label .add');
            break;
          case 'request':
            sectionSelected = document.querySelector('.results .request_section');
            labels = document.querySelectorAll('.rubic label .req');
            break;
          case 'adds':
            sectionSelected = document.querySelector('.results .add_section');
            labels = document.querySelectorAll('.rubic label .add');
            break;
        }
        var allSections = document.querySelectorAll('.results section');
        filterSystem.removeActive(allSections);
        var allLabels = document.querySelectorAll('.rubic label span');
        filterSystem.removeActive(allLabels);

        labels.forEach(function(label){
          label.classList.add('active');
        });

        sectionSelected.classList.add('active');
        filterSystem.rubriekenFilter();
      },
      loadFirstFilter: function(){
        var rubriekenFilters = document.querySelectorAll('.fieldset_container input');
        this.uncheckAllInput(rubriekenFilters);
        var currentPageCategoryWithUnderscore = currentPageCategory.split(' ').join('_');
        var inputSelected = document.querySelectorAll("#" + currentPageCategoryWithUnderscore);
        inputSelected.forEach(function(e){
            e.checked = true;
        });
        var allInputFields = document.querySelectorAll('.rubic input');
        for(var i = 0; i < allInputFields.length; i++){
          allInputFields[i].addEventListener('change', function(){
            filterSystem.rubriekenFilter();
          });
        }
        this.rubriekenFilter();
      },
      rubriekenFilter: function(){
        var allInputFields = document.querySelectorAll('.rubic input');
        var activeInputFields = [];
        for(var i = 0; i < allInputFields.length; i++){
          if(allInputFields[i].checked){
            activeInputFields.push(allInputFields[i]);
          }
        }
        var activeArticles = [];
        var keyWord;
        switch (this.activeToggle) {
          case 'profiles':
            keyWord = 'Advertentie';
            break;
          case 'request':
            keyWord = 'Opdracht';
            break;
          case 'adds':
            keyWord = 'Advertentie';
            break;
        }
        if(activeInputFields.length > 0){
          for(var l = 0; l < allDataCategory.length; l++){
            var element = allDataCategory[l];
            if(keyWord == element.key){
              var categorySplitted = element.category.split(' ').join('_');
              activeInputFields.forEach(function(active){
                if(active.id == categorySplitted){
                  activeArticles.push(element.id);
                }
              });
            }
          }
          var allArticles = document.querySelectorAll('article');
          this.removeActive(allArticles);
          if(activeArticles.length > 0){
            var noResult = document.querySelector('.no-result');
            noResult.classList.remove('active');
            for(var i = 0; i < activeArticles.length; i++){
              var id = activeArticles[i];
              var element = document.querySelectorAll('.id' + id);
              element.forEach(function(e){
                e.classList.add('active');
              });
            }
          }
          else{
            var noResult = document.querySelector('.no-result');
            noResult.classList.add('active');
          }
        }
        else{
          var noResult = document.querySelector('.no-result');
          noResult.classList.remove('active');
          var allArticles = document.querySelectorAll('article');
          for(var i = 0; i < allArticles.length; i++){
            allArticles[i].classList.add('active');
          }
        }
      },
      toggleSections: function(){

        this.rubriekenFilter();
      },
      resetFilter: function(){
        var resetButton = document.querySelector('.reset-filter');
        var self = this;
        var allInput = document.querySelectorAll('input');
        resetButton.addEventListener('click', function(e){
          e.preventDefault();
          self.uncheckAllInput(allInput);
          self.rubriekenFilter();
        })
      },
      removeActive: function(elements){
        for (var i = 0; i < elements.length; i++){
          elements[i].classList.remove('active');
        }
      },
      addActive: function(element){
        element.classList.add('active');
      },
      uncheckAllInput: function(inputs){
        for(var i = 0; i < inputs.length; i++){
          inputs[i].checked = false;
        }
      },
      mobileVersion: function(){
        var filterButton = document.querySelectorAll('.mobile a');
        filterButton.forEach(function(button){
          button.addEventListener('click', function(item){
            var form = document.querySelector('.filter form');
            form.classList.toggle('open');
            filterButton.forEach(function(e){
              e.classList.add('active');
            });
            item.target.classList.remove('active');
          });
        });
      },
      activeToggle: '',
    }
    filterSystem.init();
  }
});

if(document.body.classList.contains('gebruiker')){
  var tabs = document.querySelectorAll('.navigation-results a');
  tabs.forEach(function(el){
    el.addEventListener('click', function(e){
      e.preventDefault();
      tabs.forEach(function(all){
        all.classList.remove('active');
      });
      e.target.classList.add('active');
      var activeClass = e.target.classList[0];
      console.log(activeClass);
      var activeSection;
      switch (activeClass) {
        case 'profile':
          activeSection = document.querySelector('.results section.profile');
          break;
        case 'request':
          activeSection = document.querySelector('.results section.request_section');
          break;
        case 'adds':
          activeSection = document.querySelector('.results section.add_section');
          break;
        case 'review':
          activeSection = document.querySelector('.results section.review');
          break;
      }
      var allSections = document.querySelectorAll('.results section');
      console.log(activeSection);
      allSections.forEach(function(section){
        section.classList.remove('active');
      });
      activeSection.classList.add('active');
    });
  });
}
