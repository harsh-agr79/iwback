$(document).ready(function(){
    $('.sidenav').sidenav();
  });

  $('.carousel.carousel-slider').carousel({
    fullWidth: true,
    indicators: true
  });
function autoplay() {
    $('.carousel').carousel('next');
    setTimeout(autoplay, 6500);
}
autoplay()   

$(document).ready(function(){
    $('.modal').modal();
  });

  $('.dropdown-trigger').dropdown({
      constrainWidth: false,
      coverTrigger:false,
  });
  $(document).ready(function(){
    $('select').formSelect();
  });

  // $(document).ready(function(){
  //   $('.fixed-action-btn').floatingActionButton();
  // });

  var slider = document.getElementById('salary-slider');
  noUiSlider.create(slider, {
   start: [0, 100000],
   connect: true,
   step: 1000,
   tooltips:true,
   orientation: 'horizontal', // 'horizontal' or 'vertical'
   range: {
     'min': 0,
     'max': 100000
   },
   format: wNumb({
     decimals: 0
   })
  });
  var slider = document.getElementById('salary-slider2');
  noUiSlider.create(slider, {
   start: [0, 100000],
   connect: true,
   step: 1000,
   tooltips:true,
   orientation: 'horizontal', // 'horizontal' or 'vertical'
   range: {
     'min': 0,
     'max': 100000
   },
   format: wNumb({
     decimals: 0
   })
  });

window.onscroll = function() {myFunction()};

var header = document.getElementById("sort");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}