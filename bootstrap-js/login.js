// jquery code to hide h1
$(document).ready(function () {
  $(".right").animate({
    top: '18px',  
    AnimationEffect: 'linear',
  }, 700);
  $(".right").animate(
    {
      top: "8px",
      AnimationEffect: 'linear',
    },
    100
  );
  $(".right").animate(
    {
      top: "18px",
      AnimationEffect: "linear",
    },
    300
  );
  $(".left img ").animate({
    transform: '',
  }, 1000
  );



});
