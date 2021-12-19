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

  // var slider = document.getElementById('salary-slider');
  // noUiSlider.create(slider, {
  //  start: [0, 100000],
  //  connect: true,
  //  step: 1000,
  //  tooltips:true,
  //  orientation: 'horizontal', // 'horizontal' or 'vertical'
  //  range: {
  //    'min': 0,
  //    'max': 100000
  //  },
  //  format: wNumb({
  //    decimals: 0
  //  })
  // });
  // var slider = document.getElementById('salary-slider2');
  // noUiSlider.create(slider, {
  //  start: [0, 100000],
  //  connect: true,
  //  step: 1000,
  //  tooltips:true,
  //  orientation: 'horizontal', // 'horizontal' or 'vertical'
  //  range: {
  //    'min': 0,
  //    'max': 100000
  //  },
  //  format: wNumb({
  //    decimals: 0
  //  })
  // });

  window.onscroll = function() {myFunction()};
  var header = document.getElementById("sortsec");
  var sticky = header.offsetTop - 85;

  var body = document.body,
    html = document.documentElement;

var height = html.offsetHeight ;
  function offsetBottom(el, i) { i = i || 0; return $(el)[i].getBoundingClientRect().bottom }
  function myFunction() {
      // console.log(offsetBottom('#sortsec'));
      // console.log(window.pageYOffset);
      var fh = document.getElementById('footer').offsetHeight + 85;
        // console.log(window.pageYOffset - fh);
        // console.log(height - 937);
        // console.log(jsh);
    if (window.pageYOffset > sticky) {
      header.classList.add("sticky");
      header.classList.remove("stickybtm");
    }else {
      header.classList.remove("sticky");
      header.classList.add("stickybtm");
    }
    if(window.pageYOffset > height - 600 - fh){
      header.classList.remove("sticky");
      header.classList.add("stickybtm");
    }
    else{
      header.classList.add("sticky");
      header.classList.remove("stickybtm");
    }
  }